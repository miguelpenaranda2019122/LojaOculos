<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oculo;
use App\Models\User;
use App\Models\ShoppingCart;
use App\Models\ItemsCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class OculosController extends Controller
{
    //Obter todos os oculos
    function oculos(){
        $oculos = Oculo::all();
        return view('produtos', ['oculos' => $oculos]);
    }

    //Ordenar por precio ascendente
    function oculosByPriceAsc(){
        $oculos = Oculo::orderBy('price', 'asc')->get();
        return view('produtos', ['oculos' => $oculos]);
    }

    //Ordenar por precio descendente
    function oculosByPriceDesc(){
        $oculos = Oculo::orderBy('price', 'desc')->get();
        return view('produtos', ['oculos' => $oculos]);
    }

    //En mi view tengo una barra de busqueda que me permite buscar por marca o modelo, quiero implementarla
    function search(Request $request){
        $search = $request->get('search');
        $oculos = Oculo::where('marca', 'like', '%'.$search.'%')->orWhere('modelo', 'like', '%'.$search.'%')->get();
        return view('produtos', ['oculos' => $oculos]);
    }

    //Obter oculo por id
    function detalhes($id){
        $oculo = Oculo::find($id);
        $seller = $oculo->user_id;
        $nameSeller = User::find($seller)->name;
        $reviews = Review::where('oculo_id', $id)->get();
        $reviewsClone = clone $reviews;
        foreach ($reviewsClone as $review) {
            $user = User::find($review->user_id);
            $review->autor = $user->name;
        }

        return view('detalhes', ['oculo' => $oculo, 'nameSeller' => $nameSeller, 'reviews' => $reviewsClone]);
    }
    // Mostra um formulario para adicionar um oculo desde a View VENDER
    function venta(){
        return view('venta');
    }

    // Criar oculo
    function store(Request $request){
        
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'material' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'tamanho' => 'required',
            'largura' => 'required',
            'altura' => 'required',
            'ponte' => 'required',
            'comprimento_haste' => 'required',
            'image' => 'required'
        ]);

        if (request('stock') > 10){
            return redirect('/vender')->with('error', 'O STOCK NÃO PODE SER SUPERIOR A 10');
        }

        $oculo = new Oculo();
        $oculo->marca = request('marca');
        $oculo->modelo = request('modelo');
        $oculo->color = request('color');
        $oculo->material = request('material');
        $oculo->description = request('description');
        $oculo->price = request('price');
        $oculo->stock = request('stock');
        $oculo->tamanho = request('tamanho');
        $oculo->largura = request('largura');
        $oculo->altura = request('altura');
        $oculo->ponte = request('ponte');
        $oculo->comprimento_haste = request('comprimento_haste');
        $oculo->user_id = request('user_id');

        if($request->has('image')){
            $image = $request->file('image');
            $folder = "/image/oculos/";
            $iname = 'oculo_'.time();
            $fileName = $iname.".".$image->getClientOriginalExtension();
            $storagePath = $folder . $fileName;
            $filePath = "/storage" . $storagePath;

            $image->storeAs($folder, $fileName, 'public');

            $oculo->image = $filePath;
        }
        
        $oculo->save();
        
        return redirect('/vender')->with('success', 'PRODUTO PUBLICADO');
    }

    // Adicionar oculo ao carrinho
    function addToCart(Request $request, $id){

        $cartID = ShoppingCart::where('user_id', Auth::user()->id)->first()->id;
        $product = ItemsCart::where('oculo_id', $id)->where('shopping_cart_id', $cartID)->first();

        //Verifica se o produto já está no carrinho
        if($product){
            $product->quantity += request('quantity');
            $product->save();
            return redirect('/oculos')->with('success', 'PRODUTO ADICIONADO AO CARRINHO');
        }

        $item = new ItemsCart();

        $item->shopping_cart_id = $cartID;
        $item->oculo_id = $id;
        $item->quantity = request('quantity');

        //Verifica que a quantidade pedida é menor ou igual ao stock
        if (request('quantity') > Oculo::find($id)->stock){
            return redirect('/oculo/'.$id)->with('error', 'QUANTIDADE INDISPONIVEL');
        }

        $item->save();
        return redirect('/oculos')->with('success', 'PRODUTO ADICIONADO AO CARRINHO');
    }

    //Editar stock ou preço oculo
    function updateOculo(Request $request){

        $request->validate([
            'stock' => 'required',
            'price' => 'required'
        ]);

        $oculo = Oculo::find(request('id'));
        $oculo->stock = request('stock');
        $oculo->price = request('price');
        $oculo->save();
        return redirect('/profile')->with('oculoUpdated', 'OCULO EDITADO COM SUCESSO');
    }

    // Eliminar oculo com o administrador
    function deleteOculo($id){
        $oculo = Oculo::find($id);
        $items = ItemsCart::where('oculo_id', $id)->get();
        foreach($items as $item){
            $item->delete();
        }
        $oculo->delete();
        return redirect('/administration')->with('success', 'PRODUTO ELIMINADO');
    }

    function deleteOculofromProfile(){
        $oculo = Oculo::find(request('id'));
        $items = ItemsCart::where('oculo_id', request('id'))->get();
        foreach($items as $item){
            $item->delete();
        }
        $oculo->delete();
        return redirect('/profile')->with('oculoDeleted', 'OCULO ELIMINADO COM SUCESSO');
    }
}
