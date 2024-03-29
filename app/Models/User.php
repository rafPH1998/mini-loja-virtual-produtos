<?php

namespace App\Models;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function shopping(): HasMany
    {
        return $this->hasMany(PurchasedProducts::class);
    }

    public function like(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
        );
    }

    
}
