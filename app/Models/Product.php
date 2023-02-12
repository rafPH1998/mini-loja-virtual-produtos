<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $appends = [
        'format_date',
        'product_name_format'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentProduct::class);
    }

    //um produto pode ter uma compra
    public function shopping(): HasOne
    {
        return $this->hasOne(PurchasedProducts::class);
    }

    protected function date(): Attribute
    {
        Carbon::setLocale('pt_BR');

        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y') . ' (' . Carbon::make($value)->diffForHumans() . ') '       
        );
    }

    //se a data passar de 3 dias depois do cadastro o produto não é mais recente
    protected function formatDate(): Attribute
    {
        return Attribute::make(
            get: fn () => now()->diffInDays($this->created_at) <= 5 ? true : false
        );
    }

    protected function productNameFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => strlen($this->name) >= 12 ? substr($this->name, 0, 10) . '...' : $this->name
        );
    }
    
    public function getProducts(string|null $filter = '')
    {
        $products = $this
                    ->orderBy('created_at', 'DESC')
                    ->when(function ($query) use ($filter) {
                        $query->where('name', 'LIKE', "%{$filter}%");     
                    })
                    ->with('user.comments')
                    ->paginate(8);  
                
        return $products;
    }

    public function getLastFiveProductsForStatus(string|null $status = ''): object
    {
        return Product::query()
                    ->when($status == 'last_registered', fn($query) => $query->orderBy('created_at', 'DESC'))
                    ->when($status == 'cheap', fn($query) => $query->orderBy('price', 'ASC'))
                    ->when($status == 'expensive', fn($query) => $query->orderBy('price', 'DESC'))
                    ->when($status == 'news', fn($query) => $query->where('quality', 'novo'))
                    ->when($status == 'semi_news', fn($query) => $query->where('quality', 'semi_novo'))
                    ->when($status == 'god', fn($query) => $query->where('quality', 'bom'))
                    ->when($status == 'medium', fn($query) => $query->where('quality', 'medio'))
                    ->with([
                        'comments',
                        'user'
                    ])
                    ->get()
                    ->take(5);

    }
    
}