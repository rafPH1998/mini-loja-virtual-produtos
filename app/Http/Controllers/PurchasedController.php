<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchasedProducts;
use Illuminate\Http\Request;

class PurchasedController extends Controller
{
    public function store(string $idProduct)
    {
        $product = Product::findOrFail($idProduct);
        
        //valida e verifica se tem produto em estoque para comprar
        if ($product->quantity_inventory == 0) {
            return redirect()
                    ->route('products.show', $idProduct)
                    ->with('error', 'Sem produto no estoque para compra!');
        }

        // verifica se esta "comprado"
        if ($product->shopping) {
            
            $product->shopping->delete();
            $product->quantity_inventory += 1;
            
            $product->save();
            
            return redirect()
                    ->route('products.show', $idProduct)
                    ->with('warning', 'Você não mais adquire esse produto!'); 
        } else {
            PurchasedProducts::create([
                'user_id'    => auth()->user()->id,
                'product_id' => $product->id
            ]);

            $product->quantity_inventory -= 1;
            $product->save();

            return redirect()
                    ->route('products.show', $idProduct)
                    ->with('success', 'Parabéns! Você adquiriu esse produto!'); 
        }
    }

    // essa funcao vai verificar se o produto esta ou nao como comprado
    public function IsPurchased(string $id)
    {

    }





}
