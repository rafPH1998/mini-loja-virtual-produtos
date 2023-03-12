<?php

namespace App\Http\Controllers;

use App\Actions\UploadFile;
use App\Enums\ProductQualityEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Requests\Products\StoreAndUpdateProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct(
        protected User $user, 
        protected Product $product, 
    ) { }

    public function index(Request $request)
    {       
 
        $products = $this->product
                            ->getProducts(
                                filter: $request->get('filter') ?? ''
                            ); 
                            
        $loggedUser = auth()->user();

        if ($request->has('page') || $request->has('filter')) {
            return response()->json(['data' => $products, 'loggedUser' => $loggedUser]);
        }

        if ($request->get('status') !== null) {

            $productsForStatus = $this->product->getLastFiveProductsForStatus(status: $request->get('status') ?? '');                            
            $productNotFound   = $productsForStatus->isEmpty() ? 'Nenhum produto encontrado para esse filtro' : '';
         
            return response()->json([
                'data'          => $productsForStatus,
                'loggedUser'    => $loggedUser,
                'error'         => $productNotFound,
                'qualityStatus' => ProductQualityEnum::cases()
            ], 200);
        }

        return view('products.index', [
            'products' => $products,
        ]);
    }

    protected function create()
    {
        return view('products.add', [
            'qualityStatus' => ProductQualityEnum::cases(),
            'type'          => ProductTypeEnum::cases()
        ]);
    }

    protected function store(StoreAndUpdateProduct $request, UploadFile $uploadFile)
    {
        $data             = $request->validated();
        $user             = auth()->user();
        $data['user_id']  = $user->id; 
        $data['date']     = now()->format('Y-m-d H:i:s');

        $price            = intval($request->price);
        $discountTotal    = $price * intval($request->discount) / 100;
        $data['discount'] = $discountTotal > 0 ? $price - $discountTotal : null;
       
        if ($request->hasFile('image')) {
            $data['image'] = $uploadFile->store($request->image, 'products');
        }

        /** @var User $user */
        $product = $user->products()->create($data);
        
        return response()->json(['data' => $product], 201);
    }

    public function show($id)
    {
        $product = $this->product
                        ->with([
                            'user',
                            'shopping',
                            'like'
                        ])
                        ->findOrFail($id);

        return view('products.show', [
            'product'       => $product,
            'qualityStatus' => ProductQualityEnum::cases()
        ]);
    }

    protected function edit(string $product)
    {
        $productUpdate = $this->product->find($product);

        if (!Gate::authorize('update-product', $productUpdate)) {
            return false;
        }

        return view('products.show', [
            'product' => $product
        ]);
    }

    protected function myProducts()
    {        
        $myProducts = $this->product
                            ->where('user_id', auth()->user()->id)
                            ->with([
                                'user',
                                'comments',
                            ])
                            ->paginate(5);

        $totalCountProduct = $myProducts->total();

        return view('products.myProducts', ['myProducts' => $myProducts, 'totalCountProduct' => $totalCountProduct]);
    }

    protected function update(Request $request, string $id)
    {

    }

    protected function destroy(string $product)
    {
        $myProductDelete = $this->product->findOrFail($product);
        $myProductDelete->delete();

        return response()->json([], 204);
    }
    
}
