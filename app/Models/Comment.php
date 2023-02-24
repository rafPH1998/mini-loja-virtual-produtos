<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class Comment extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function createdAt(): Attribute
    {
        Carbon::setLocale('pt_BR');

        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y') . ' (' . Carbon::parse($value)->diffForHumans() . ')'     
        );
    }

    public function getComments(string $filter, int $comment, string $userAuth): LengthAwarePaginator
    {
        return $this->when($filter == 'myComments', fn($query) => $query->where('user_id', '=', $userAuth))
            ->where('product_id', '=', $comment)
            ->with('user')
            ->paginate(6);
    }

}

