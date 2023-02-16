<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    
    public function getComments(string|null $filter = 'allComments', $comment)
    {
        return $this->with('user')
                        ->when($filter == 'myComments', fn($query) => $query->where('user_id', '=', auth()->user()->id))   
                        ->where('product_id', '=', $comment)
                        ->paginate(6);

    }

}

