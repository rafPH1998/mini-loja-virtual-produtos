<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LikeController extends Controller
{
    public function __invoke()
    {
        $loggedUser = auth()->user()->id;

        $product = Product::with(['like', 'user'])->findOrFail(request()->id);
        $like = $product->like()
                        ->where('user_id', $loggedUser)
                        ->first();
        if ($like) {
            $like->delete();
            return response()->json([
                'product_id' => $like->product_id, 
                'user_id'    => $loggedUser,
                'deleted'    => true
            ]);
        } else {
            $like = $product->like()->create(['user_id' => $loggedUser]);
            return response()->json([
                'product_id' => $like->product_id, 
                'user_id'    => $loggedUser,
                'created'    => true
            ]);
        }      
    }
}
