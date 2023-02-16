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
        'product_name_format'
    ];

    protected $casts = [
        'is_recent' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    //um produto pode ter uma compra
    public function shopping(): HasOne
    {
        return $this->hasOne(PurchasedProducts::class);
    }
    
    public const MAX_NAME_LENGTH = 12;

    public function getFormattedName(): string
    {
        if (strlen($this->name) >= self::MAX_NAME_LENGTH) {
            return substr($this->name, 0, self::MAX_NAME_LENGTH - 3) . '...';
        }

        return $this->name;
    }
    
    protected function date(): Attribute
    {
        Carbon::setLocale('pt_BR');
        
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y') . ' (' . Carbon::parse($value)->diffForHumans() . ')'     
        );
    }

    public function isRecent(): bool
    {
        return now()->diffInDays($this->created_at) <= 5;
    }
    
   /*  Ao utilizar with('user.comments'), pode haver problemas de desempenho quando o número de produtos aumentar, 
    pois o Eloquent executará uma consulta separada para cada produto para recuperar seus comentários.
    Se você espera ter muitos produtos e comentários, pode ser mais eficiente recuperar os produtos primeiro e, 
    em seguida, seus comentários em uma consulta separada com whereHas; */

    public function getProducts(string|null $filter = '')
    {
        $query = $this->orderBy('created_at', 'DESC');

        if ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        }
    
        $products = $query->paginate(8);
    
        $productIds = $products->pluck('id')->toArray();
    
        $comments = Comment::with('user')
                    ->whereHas('product', function ($query) use ($productIds) {
                        $query->whereIn('id', $productIds);
                    })
                    ->get()
                    ->groupBy('product_id');
    
        foreach ($products as $product) {
            $product->setRelation('comments', $comments->get($product->id, collect()));
        }
    
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