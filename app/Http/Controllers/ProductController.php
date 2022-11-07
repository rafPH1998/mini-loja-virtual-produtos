<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreAndUpdateProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct(
        protected User $user, 
        protected Product $product)
    { }

    
    public function index(Request $request)
    {
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
                'data' => $productsForStatus
            ]);
        }

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.add');
    }

    public function store(StoreAndUpdateProduct $request)
    {
        $product = auth()->user()
                        ->products()
                        ->create($request->validated());

        return redirect()->route('products.index')
                        ->with('success', "Produto {$product->name} criado!");
    }

    public function show($id)
    {
        $product = $this->product->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(Request $request, $product)
    {

        $productUpdate = $this->product->find($product);

        if (!Gate::authorize('update-product', $productUpdate)) {
            return false;
        }

        return view('products.show', compact('product'));
    }

    public function myProducts()
    {
        $user = auth()->user();
        
        $myProducts = $this->product
                    ->where('user_id', $user->id)
                    ->with('user')
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
