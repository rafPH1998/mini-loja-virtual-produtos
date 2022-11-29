<?php

namespace App\Http\Controllers;

use App\Events\ProductCommentedEvents;
use App\Http\Requests\Products\CommentProductRequest;
use App\Models\CommentProduct;
use App\Models\Product;
use App\Mail\ProductCommented;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function __construct(
        protected Product $product,
        protected CommentProduct $comments
    ) { }

    public function __invoke(CommentProductRequest $request)
    {
        $data = $request->validated();
        $idProduct = $request->get('id');

        $product = $this->product
                        ->find($idProduct);

        $data['user_id'] = auth()->user()->id;
        $product->comments()->create($data);
        
        event(new ProductCommentedEvents($product));

        return redirect()->route('products.show', [$idProduct])
                        ->with(
                            'comment_success', "Comentário inserido no para produto {$product->name} criado!"
                        );
    }

    public function comments($comment)
    {
        $product = $this->product
                        ->find($comment);

        if (!$product) {
            return redirect()->back();
        }
         
        $listComments = $this->comments
                            ->getComments($comment);
                                    
        return view('products.comments', [
            'listComments' => $listComments,
            'product'      => $product
        ]);
    }

}
