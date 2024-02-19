<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OculosController;
use App\Http\Controllers\ClientProblemsController;
use App\Http\Controllers\ItemsCartController;
use App\Models\Oculo;
use App\Models\ClientProblems;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Mostra o Home e algumas reviews na view HOME
Route::get('/', [ReviewController::class,'home']);

// Mostra todos os oculos da base de dados na view OCULOS
Route::get('/oculos', [OculosController::class,'oculos']);

// Mostra os detalhes de um oculo na view DETALHES
Route::get('/oculo/{id}', [OculosController::class,'detalhes']);

// Mostra os oculos ordenados por preço ascendente na view OCULOS
Route::get('/oculosByPriceAsc', [OculosController::class,'oculosByPriceAsc']);

// Mostra os oculos ordenados por preço descendente na view OCULOS
Route::get('/oculosByPriceDesc', [OculosController::class,'oculosByPriceDesc']);

// Mostra os oculos de uma marca ou modelo na view OCULOS
Route::get('/search', [OculosController::class,'search']);

//  Adiona um oculo ao carrinho de compras desde a View DETALHES
Route::post('/oculo/{id}', [OculosController::class,'addToCart']);

// Mostra um formulario para editar um oculo desde a View PROFIlE 
Route::put('/updateOculo', [OculosController::class,'updateOculo']);

// Elimina um oculo desde a View PROFILE
Route::delete('/updateOculofromProfile', [OculosController::class,'deleteOculofromProfile']);

// O Administrador pode eliminar um oculo desde a View DETALHES de um oculo
Route::delete('/oculo/{id}', [OculosController::class,'deleteOculo']);

// Mostra um formulario para adicionar um oculo desde a View VENDER
Route::get('/vender', [OculosController::class,'venta']);

// Adiciona um oculo a base de dados desde a View VENDER
Route::post('/vender', [OculosController::class,'store']);

// Mostra um formulario para os clientes enviarem uma mensagem de problemas a que gerencia o site (admin) na View CONTACTOS
Route::get('/contactos', [ClientProblemsController::class,'contactos']);

// Adiciona uma mensagem de problemas a base de dados desde a View CONTACTOS
Route::post('/contactos', [ClientProblemsController::class,'store']);

// Elimina uma mensagem de problemas da base de dados desde a View ADMIN
Route::delete('/solved', [ClientProblemsController::class,'problemSolved']);

// Disminui a quantidade de um oculo no carrinho de compras na View SHOPPINGCART
Route::put('/shoppingcart/{id}',[ItemsCartController::class, 'disminuirQuantidade']);

// Elimina um oculo do carrinho de compras na View SHOPPINGCART
Route::delete('/shoppingcart/{id}',[ItemsCartController::class, 'deleteItem']);

// Finaliza a compra dos oculos no carrinho de compras na View SHOPPINGCART e guarda a compra na base de dados
Route::delete('/shoopingcart/finish',[ItemsCartController::class, 'finishPurchase']);

// Adiciona uma review a base de dados desde a View PROFILE
Route::post('/review', [ReviewController::class,'postReview']);

//Middleware para o perfil do utilizador
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Mostra os oculos adicionados ao carrinho de compras na View SHOPPINGCART
    Route::get('/shoppingcart',[ItemsCartController::class, 'shoppingcart']);   
});

//Middleware para o perfil do admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/administration', function () {
        $oculos = Oculo::all();
        $problems = ClientProblems::all();
        return view('admin', ['oculos' => $oculos, 'problems' => $problems]);
    });
});

require __DIR__.'/auth.php';