<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchasedController extends Controller
{
    public function store(string $idProduct)
    {

        $product = Product::query()
                    ->with(['user', 'shopping'])
                    ->findOrFail($idProduct);
        
        if (!$this->checkInventory($product)) {
            return redirect()
                        ->route('products.show', $idProduct)
                        ->with('error', 'Sem produto no estoque para compra!');
        }

        \DB::beginTransaction();
    
        try {
            $result        = $this->toggleShopping($product);
            $returnMessage = $result['message'];
            $typeMessage   = $result['type'];
        
            $product->update();
            \DB::commit();
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()
                ->route('products.show', $idProduct)
                ->with('error', 'Ocorreu um erro ao atualizar o estoque.');
        }

        return redirect()
                    ->route('products.show', $idProduct)
                    ->with($typeMessage, $returnMessage); 
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
                'user_id'    => $product->user->id,
                'product_id' => $product->id,
            ]);
            $product->quantity_inventory -= 1;
            
            $message = 'Parabéns! Você adquiriu esse produto!';
            $type    = 'success';
        }

        return ['message' => $message, 'type' => $type];
    }
}
