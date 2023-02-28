<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchasedProducts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMyPurchaseds(null|string $filter = '')
    {

        return $this->with('product')
                    ->where('user_id', '=', auth()->user()->id)
                    ->whereHas('product', function ($query) use ($filter) {
                        $query->where('name', 'LIKE', "%{$filter}%");
                    })
                    ->paginate(5);

    }

    

}
