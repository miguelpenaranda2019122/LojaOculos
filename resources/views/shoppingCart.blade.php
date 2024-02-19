@extends('Layouts.Layout')

@section('content')
<div class="container my-5 bg-light border rounded-4 p-5" id="carrinho">
    <div class="carrinho-card">
        <header class="d-flex gap-3 align-items-center py-3">
            <i class="fa-solid fa-cart-shopping fs-1 ps-3"></i>
            <h1 class="fw-bolder">SHOPPING CART</h1>
        </header>
        <div class="produtos d-flex flex-column align-items-center">
            @forelse ($oculos as $oculo)
            <div class="produto ps-5 pe-5 w-100">
                <img src="{{$oculo->image}}" alt="rayban">
                <p>Marca:<span class="fw-light">{{$oculo->marca}}</span></p>
                <p>Modelo:<span class="fw-light">{{$oculo->modelo}}</span></p>
                <p>Cor:<span class="fw-light">{{$oculo->color}}</span></p>
                <p>Quantidade:<span class="fw-light">{{$oculo->quantity}}</span></p>
                <p>Preço:<span class="fw-light">{{$oculo->price}} €</span></p>
                @if ($oculo->quantity > 1)
                <div class="text-end">
                    <form action="/shoppingcart/{{$oculo->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success d-flex justify-content-center align-items-center">-</button>
                    </form>    
                </div>
                @else
                <div class="text-end">
                    <form action="/shoppingcart/{{$oculo->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success d-flex justify-content-center align-items-center">-</button>
                    </form>    
                </div>
                @endif
            </div>
            @empty
            <div class="produto ps-5 pe-5 w-100">
                <h4 class="text-success w-100 text-center mt-2">O CARRINHO ESTA VAZIO</h4>
            </div>
            @endforelse
            <div class="produto ps-5 pe-5 w-100"></div>
        </div>
        <div class="payment-section d-flex justify-content-between  pe-4" >
            <p>Total Price:<span>{{$totalPrice}} €</span>
                <br>
                @if (session('error'))
                    <ul>
                        <li class="text-center bg-danger text-light rounded rounded-2 w-100 p-3">{{ session('error') }}</li>
                    </ul>
                @endif
            </p>
            <div>
                @auth
                    <form action="/shoopingcart/finish" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-success  py-2 px-3" type="submit">Finish Payment</button>
                    </form>
                    
                @endauth
                @guest
                    <a class="btn btn-outline-success py-2 px-3" href="/login">Faça Login</a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection