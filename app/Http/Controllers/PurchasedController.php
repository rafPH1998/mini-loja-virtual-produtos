<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchasedProducts;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class PurchasedController extends Controller
{

    public function __construct(
        protected PurchasedProducts $purchasedProducts, 
    ) { }

    protected function index(HttpRequest $request)
    {        
        $myShoppings = $this->purchasedProducts
            ->getMyPurchaseds(
                filter: $request->get('filter') ?? ''
            );

        return view('products.myShoppings', compact('myShoppings'));
    }
    
    public function store(HttpRequest $request)
    {
        $idProduct = $request->get('id');

        $product = Product::query()
                    ->with(['user', 'shopping'])
                    ->findOrFail($idProduct);
        
        if (!$this->checkInventory($product)) {
            return response()->json(['error' => 'Sem produto no estoque para compra!']);
        }

        \DB::beginTransaction();
        try {
            $result        = $this->toggleShopping($product);
            $returnMessage = $result['message'];
            $typeMessage   = $result['type'];
        
            $product->update();
            \DB::commit();
            
        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json(['error' => $exception->getMessage()]);
        }

        return response()->json([
            $typeMessage    => $returnMessage, 
            'quantity'      => $product->quantity_inventory, 
            'countShopping' => $product->shopping
        ]);
    }

    protected function checkInventory(Product $product): bool
    {
        return $product->quantity_inventory > 0;
    }

    protected function toggleShopping($product): array
    {
        if ($product->shopping) {
            $product->shopping()->delete();
            $product->quantity_inventory += 1;

            $message = 'Você não mais adquire esse produto!';
            $type    = 'warning';
        } else {
            $product->shopping()->create([
                'user_id'    => auth()->user()->id,
                'product_id' => $product->id,
            ]);
            $product->quantity_inventory -= 1;
            
            $message = 'Parabéns! Você adquiriu esse produto!';
            $type    = 'success';
        }

        return ['message' => $message, 'type' => $type];
    }
}
