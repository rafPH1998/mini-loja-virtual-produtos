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

    public function index()
    {
        $products = $this->product
                    ->with('user')
                    ->paginate(5);

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

    public function edit($id)
    {
        $product = $this->product->find($id);

        if (!Gate::authorize('update-product', $product)) {
            return false;
        }

        return view('products.show', compact('product'));

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
