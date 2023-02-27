<?php

namespace App\Http\Controllers;

use App\Events\ProductCommentedEvents;
use App\Http\Requests\Products\CommentProductRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Mail\ProductCommented;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function __construct(
        protected Product $product,
        protected Comment $comments
    ) { }

    public function __invoke(CommentProductRequest $request)
    {
        try {
            $data = $request->validated();
            $idProduct = $request->get('id');

            $product = $this->product
                            ->with('comments')
                            ->find($idProduct);

            $data['user_id'] = auth()->user()->id;
            $product->comments()->create($data);
            
            event(new ProductCommentedEvents($product));

            return response()->json(['data' => $product], 201);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'Falha ao enviar email', 'product' => $product]);
        }
    }

    public function comments(Request $request, $comment)
    {   

        $product = $this->product->find($comment);
        if (!$product) {
            return redirect()->back();
        }

        $listComments = $this->comments
                    ->getComments(
                        userAuth: auth()->user()->id,
                        filter  : $request->get('filter') ?? '',
                        comment : $comment
                    );


        if ($request->has('filter')) {
            return response()->json([
                'data'     => $listComments,
                'userAuth' => auth()->user()->id,
                'error'    => $listComments->isEmpty() ? 'Você não tem nenhum comentário inserido!' : '',
            ], 200);
        }
                                    
        return view('products.comments', [
            'listComments' => $listComments,
            'product'      => $product,
        ]);
    }

}

