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
    
    public const MAX_NAME_LENGTH = 15;

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
        return now()->diffInDays($this->created_at) <= 2;
    }

    // verifica se o usuario logado já deu like naquele determinado produto
    public function hasLikedByUser($userId): bool
    {
        return $this->like()->where('user_id', $userId)->exists();
    }

    public function takeOneLike(): int
    {
        return $this->like()
                    ->selectRaw('COUNT(*) as total_likes')
                    ->havingRaw('total_likes = 1')
                    ->count();
    }

    public function takeTwoLike(): int
    {
        return $this->like()
                    ->selectRaw('COUNT(*) as total_likes')
                    ->havingRaw('total_likes = 2')
                    ->count();
    }

    public function takeThreeLike(): int
    {
        return $this->like()
                    ->selectRaw('COUNT(*) as total_likes')
                    ->havingRaw('total_likes = 3')
                    ->count();
    }

    public function takeFourLike(): int
    {
        return $this->like()
                    ->selectRaw('COUNT(*) as total_likes')
                    ->havingRaw('total_likes = 4')
                    ->count();
    }

    public function takeFiveLikeAbove()
    {
        return $this->like()
                    ->selectRaw('COUNT(*) as total_likes')
                    ->havingRaw('total_likes >= 5')
                    ->count();
    }

    public function getProducts(string|null $filter = '')
    { 
        $products = $this
                    ->when($filter, function ($query, $filter) {
                        return $query->where('name', 'LIKE', "%{$filter}%");
                    })
                    ->orderBy('created_at', 'DESC')
                    ->with([
                        'user',
                        'comments',
                        'like'
                    ])
                    ->paginate(4);
                    
        return $products;
    }

    public function getLastFiveProductsForStatus(string|null $status = '')
    {
        return Product::query()
                    ->when($status == 'last_registered', fn($query) => $query->orderBy('created_at', 'DESC'))
                    ->when($status == 'cheap', fn($query) => $query->orderBy('price', 'ASC'))
                    ->when($status == 'expensive', fn($query) => $query->orderBy('price', 'DESC'))
                    ->when(in_array($status, [
                            'eletronicos', 
                            'livros', 
                            'jogos',
                            'acessorios', 
                            'roupas', 
                            'perfumaria']
                        ), 
                        function ($query) use ($status) {
                            return $query
                                ->when($status == 'news', fn($query) => $query->where('quality', 'novo'))
                                ->when($status == 'eletronicos', fn($query) => $query->where('type', 'eletronicos'))
                                ->when($status == 'livros', fn($query) => $query->where('type', 'livros'))
                                ->when($status == 'jogos', fn($query) => $query->where('type', 'jogos'))
                                ->when($status == 'acessorios', fn($query) => $query->where('type', 'acessorios'))
                                ->when($status == 'roupas', fn($query) => $query->where('type', 'roupas'))
                                ->when($status == 'perfumaria', fn($query) => $query->where('type', 'perfumaria'));
                        }
                    )
                    ->with([
                        'comments',
                        'user'
                    ])
                    ->paginate(5);
    }

    
}