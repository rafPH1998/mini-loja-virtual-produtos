<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->collection->map(function ($product) {

            $loggedUser = auth()->user();

            $likedByUser = $product->hasLikedByUser($loggedUser->id);

            return [
                'id'          => $product->id,
                'name'        => $product->name,
                'price'       => $product->price,
                'quality'     => $product->quality,
                'inventory'   => $product->quantity_inventory,
                'type'        => $product->type,
                'discount'    => $product->discount,
                'image'       => $product->image,
                'date'        => $product->date,
                'user'        => $product->user,
                'like'        => $product->like,
                'comments'    => $product->comments,
                'likedByUser' => $likedByUser,
            ];
        });
        
        return [
            'data'    => $data,
            'user_id' => auth()->user()->id, // usuario logado
        ];
    }
}
