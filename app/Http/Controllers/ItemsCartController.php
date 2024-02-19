<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oculo;
use App\Models\ShoppingCart;
use App\Models\ItemsCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Historial;

class ItemsCartController extends Controller
{   
    // Mostra os oculos adicionados ao carrinho de compras na View SHOPPINGCART
    function shoppingcart(){
        $cartID = ShoppingCart::where('user_id', Auth::user()->id)->first()->id;
        $items = ItemsCart::where('shopping_cart_id', $cartID)->get();
        $arrayOculos = array();
        $totalPrice = 0;
        
        foreach($items as $item){
            $oculo = Oculo::find($item->oculo_id);
            $oculoClone = clone $oculo;
            $oculoClone->quantity = $item->quantity;
            $totalPrice += $oculo->price * $item->quantity;
            array_push($arrayOculos, $oculoClone);
        }

        return view('shoppingcart', ['oculos' => $arrayOculos, 'totalPrice' => $totalPrice]);
    }
    // Disminui a quantidade de um oculo no carrinho de compras na View SHOPPINGCART 
    function disminuirQuantidade($id){
        $item = ItemsCart::where('oculo_id', $id)->first();
        $item->quantity -= 1 ;
        $item->save();
        return redirect('/shoppingcart');
    }
    // Elimina um oculo do carrinho de compras na View SHOPPINGCART
    function deleteItem($id){
        $item = ItemsCart::where('oculo_id', $id)->first();
        $item->delete();
        return redirect('/shoppingcart');
    }
    // Finaliza a compra dos oculos no carrinho de compras na View SHOPPINGCART e guarda a compra na base de dados
    function finishPurchase(){
        $cartID = ShoppingCart::where('user_id', Auth::user()->id)->first()->id;
        $items = ItemsCart::where('shopping_cart_id', $cartID)->get();

        // Primeiro verificamos se há stock suficiente para todos os produtos
        foreach($items as $item){
            $oculo = Oculo::find($item->oculo_id);
            if($item->quantity > $oculo->stock) {
                return redirect('/shoppingcart')->with('error', 'Não há stock suficiente para o produto ' . $oculo->marca . ' ' . $oculo->modelo . '!');
            }
        }

        // Se houver stock suficiente, então fazemos a compra
        foreach($items as $item){
            $oculo = Oculo::find($item->oculo_id);
            $oculo->stock -= $item->quantity;

            $oculo->save();
            $item->delete();

            //Guardar a compra na base de dados
            $historial = new Historial();
            $historial->oculo_id = $oculo->id;
            $historial->user_id = Auth::user()->id;
            $historial->quantity = $item->quantity;
            $historial->marca = $oculo->marca;
            $historial->modelo = $oculo->modelo;
            $historial->color = $oculo->color;
            $historial->price = $oculo->price;
            $historial->save();
        }
        return redirect('/profile')->with('success', 'Compra efetuada com sucesso!');
    }
}
