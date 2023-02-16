<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LikeController extends Controller
{
    public function __invoke()
    {
        $id = request()->id;

        $product = Product::with('like')->findOrFail($id);

        //verificando se o produto ja possui like
        if ($product->like->count() > 0) {
            $product->like()->delete();
            return response()->json(['success' => true], 204);
        } else {
            $product->like()->create([
                'user_id'    => auth()->user()->id,
                'product_id' => $product->id
            ]);
        
            return response()->json(['success' => true], 201);
        }
    }
}
