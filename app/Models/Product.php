<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $appends = [
        'format_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentProduct::class);
    }

    protected function date(): Attribute
    {
        Carbon::setLocale('pt_BR');

        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y') . ' (' . Carbon::make($value)->diffForHumans() . ') '       
        );
    }

    //se a data passar de 8 dias depois do cadastro o produto não é mais recente
    protected function formatDate(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::make($this->created_at)->addDays(5)->format('d/m/Y') >= now()->format('d/m/Y')
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