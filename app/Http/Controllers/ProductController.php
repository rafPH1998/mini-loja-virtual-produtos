<?php

namespace App\Http\Controllers;

use App\Enums\ProductQualityEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Requests\Products\StoreAndUpdateProduct;
use App\Models\CommentProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct(
        protected User $user, 
        protected Product $product, 
        protected CommentProduct $commentsProduct,
    ) { }

    public function index(Request $request)
    {
        $qualityStatus = ProductQualityEnum::cases();
        $type          = ProductTypeEnum::cases();
        
        $products = $this->product
                        ->getProducts(
                            filter: $request->get('filter') ?? ''
                        );

        if ($request->get('status') !== null) {

            $productsForStatus = $this->product
                                        ->getLastFiveProductsForStatus(
                                            status: $request->get('status') ?? ''
                                        );

            return response()->json([
                'data'  => $productsForStatus,
                'error' => count($productsForStatus) == 0 ? 'Nenhum produto encontrado para esse filtro' : ''
            ], 200);
        }

        return view('products.index', [
            'products'      => $products,
            'qualityStatus' => $qualityStatus,
            'type'          => $type,
        ]);
    }

    public function create()
    {
        $qualityStatus = ProductQualityEnum::cases();
        $type          = ProductTypeEnum::cases();

        return view('products.add', [
            'qualityStatus' => $qualityStatus,
            'type'  => $type,
        ]);
    }

    public function store(StoreAndUpdateProduct $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        
        $data['user_id'] = $user->id;

        /** @var User $user */
        $product = $user->products()->create($data);
        
        return response()->json([
            'data' => $product
        ], 201);
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

        return response()->json([], 204);
    }
}
