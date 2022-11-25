<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

use function PHPSTORM_META\type;

class CommentProduct extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y')
        );
    }
    
    public function getComments($comment): object
    {
        $comments =  $this->with('user')
                        ->where('product_id', '=', $comment)
                        ->paginate(6);
              
        return $comments;

    }

}

