@extends('Layouts.Layout')

@section('content')
<div class="container my-5 bg-light border rounded-4 p-5">
    @if (session('success'))
        <div class="w-100 d-flex justify-content-center" id="Added">
            <p class="text-center bg-success text-light rounded rounded-2 w-25 p-1">{{ session('success') }}</p>
        </div>
    @endif
        <form action="/search" method="get">
            <div class="barra_pesquisa">
                <input type="search" name="search" id="search" placeholder="Rayban..." class="barra ps-3 border-success">
                <button type="submit" class="botao-pesquisa text-success">
                    <i class="fa-solid fa-magnifying-glass mx-0 text-success"></i>
                </button>
            </div>
        </form>
    
    
    <h5 class="text-center mt-5 fw-bolder title-pesquisa">OS NOSSOS OCULOS: <small class="fw-light fs-5 text-success text-opacity-75">{{count($oculos)}}</small></h5>
    <div class="d-flex justify-content-center gap-3">
        <form action="/oculosByPriceDesc" method="GET"><button class="btn btn-outline-success mt-4">High to Low Price</button></form>
        <form action="/oculosByPriceAsc" method="GET"><button class="btn btn-outline-success mt-4">Low to High Price</button></form>
    </div>
    <div class="alguns-oculos mt-4 p-1 container ">
        @isset($oculos)
        @foreach ($oculos as $oculo)
            <div class="oculos-pesquisa bg-success bg-opacity-50 border-3  border border-success" data-id="{{$oculo->id}}">
                <div class="top-card h-75 p-2 ">
                    <img src="{{$oculo['image']}}" class="h-100 w-100 object-contain">
                </div>
                <div class="end-card h-25 w-100 bg-light rounded-bottom-2 d-flex flex-column  justify-content-center align-items-center border-top border-success p-2">
                    <h2 class="text-success fw-light m-0" style="font-size: 100%">{{$oculo['marca'] . " " . $oculo['modelo']}}</h2>
                    <p class="text-success fw-light m-0"  style="font-size: 100%">{{$oculo['price'] . "€"}}</p>
                </div>
            </div>
        @endforeach
        @else
            <div class="d-flex align-items-center justify-content-center w-100 p-5">
                <h1 class="text-center text-success">Oculos Esgotados</h1>
            </div>
        @endisset
    </div>
</div>

<script>
    document.querySelectorAll('.oculos-pesquisa').forEach(oculo => {
        oculo.addEventListener('click', () => {
            var oculoID = oculo.getAttribute('data-id');
            window.location.href = "/oculo/" + oculoID;
        })
    });

    
    document.addEventListener('DOMContentLoaded', ()=>{
        var successBuy = document.getElementById('Added');
        if (successBuy) {
            setTimeout(() => {
                successBuy.remove();
            }, 3000);
        }
    });
    
</script>

@endsection