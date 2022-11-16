<?php

namespace App\Http\Controllers;

use App\Actions\UploadFile;
use App\Enums\ProductQualityEnum;
use App\Http\Requests\Products\StoreAndUpdateProduct;
use App\Models\CommentProduct;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct(
        protected User $user, 
        protected Product $product,
        protected CommentProduct $commentsProduct
    ) { }

    
    public function index(Request $request)
    {

        $products = $this->product
                        ->getProducts(
                            filter: $request->get('filter') ?? ''
                        );

        $qualityStatus = ProductQualityEnum::cases();

        if ($request->get('status') !== null) {

            $productsForStatus = $this->product
                                        ->getLastThreeProductsForStatus(
                                            status: $request->get('status') ?? ''
                                        );
     
            return response()->json([
                'data' => $productsForStatus
            ]);
        }

        return view('products.index', [
            'products'      => $products,
            'qualityStatus' => $qualityStatus
        ]);
    }

    public function create()
    {
        $qualityStatus = ProductQualityEnum::cases();
        return view('products.add', [
            'qualityStatus' => $qualityStatus
        ]);
    }

    public function store(StoreAndUpdateProduct $request, UploadFile $uploadFile)
    {
        $data = $request->validated();

        if ($request->image) {
            $data['image'] = $uploadFile->store($request->image, 'products');
        }

        $product = auth()->user()
                        ->products()
                        ->create($data);

        return redirect()->route('products.index')
                        ->with('success', "Produto {$product->name} criado!");
    }

    public function show($id)
    {
        $qualityStatus = ProductQualityEnum::cases();

        $product = $this->product
                        ->with('user')
                        ->findOrFail($id);

        return view('products.show', [
            'product'       => $product,
            'qualityStatus' => $qualityStatus
        ]);
    }

    public function edit($product)
    {
        $productUpdate = $this->product->find($product);

        if (!Gate::authorize('update-product', $productUpdate)) {
            return false;
        }

        return view('products.show', [
            'product' => $product
        ]);
    }

    public function myProducts()
    {
        $loggedUser = auth()->user();
        
        $myProducts = $this->product
                    ->where('user_id', $loggedUser->id)
                    ->with([
                        'user',
                        'comments',
                    ])
                    ->paginate(5);

        return view('products.myProducts', compact('myProducts'));
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($product)
    {
        $myProductDelete = $this->product->findOrFail($product);
        $myProductDelete->delete();

        return redirect()
            ->route('products.myProducts')
            ->with('success', "Produto deletado com sucesso!");
    }
}
