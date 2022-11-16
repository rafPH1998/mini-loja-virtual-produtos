<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CommentProductRequest;
use App\Models\CommentProduct;
use App\Models\Product;
use App\Notifications\ProductCommented;

class CommentController extends Controller
{
    
    public function __invoke(CommentProductRequest $request)
    {
        $data = $request->validated();
        $idProduct = $request->get('id');

        $product = Product::find($idProduct);

        $loggedUser = auth()->user();

        $data['user_id'] = $loggedUser->id;
        $comment = $product->comments()->create($data);

        $product->user
                ->notify(
                    new ProductCommented($product, $comment)
                );

        return redirect()->route('products.show', [$idProduct])
                        ->with(
                            'comment_success', "Comentário inserido no para produto {$product->name} criado!"
                        );
    }

    public function comments($comment)
    {
         
        $listComments = CommentProduct::with('user')
                                    ->where('product_id', '=', $comment)
                                    ->get();
                                    
        return view('products.comments', [
            'listComments' => $listComments
        ]);
    }

}
