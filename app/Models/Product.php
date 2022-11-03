<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y')
        );
    }
    
    public function getProducts(string|null $filter = '', string|null $status = '')
    {

        if ($status === 'last_registered') {
            return $this->orderBy('created_at', 'DESC')->paginate(5);
        }

        if ($status === 'cheap') {
            return $this->orderBy('price', 'ASC')->paginate(5);
        }

        if ($status === 'expensive') {
            return $this->orderBy('price', 'DESC')->paginate(5);
        }

        $products = $this
                    ->when(function ($query) use ($filter) {
                        $query->where('name', 'LIKE', "%{$filter}%");     
                    })
                    ->with('user')
                    ->paginate(5);


        return $products;
    }

    
}
