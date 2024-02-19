@extends('Layouts.Layout')

@section('content')
<div class="container my-5 bg-light border rounded-4 p-5" id="pesquisa">
    <h3 class="text-center fw-bolder text-success text-uppercase pb-2 ">Procurar Produtos Ilegais</h3>
    @if (session('success'))
        <div class="w-100 d-flex justify-content-center" id="deleted">
            <p class="text-center bg-success text-light rounded rounded-2 w-25">{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="alguns-oculos mt-4 p-4 container overflow-scroll" style="height: 80vh">
        @isset($oculos)
        @foreach ($oculos as $oculo)
        <div class="oculos-pesquisa bg-success bg-opacity-50 border-3  border border-success" data-id="{{$oculo->id}}">
            <div class="top-card h-75 p-2 ">
                <img src="{{$oculo->image}}" class="h-100 w-100">
            </div>
            <div class="end-card h-25 w-100 bg-light rounded-bottom-2 d-flex flex-column  justify-content-center align-items-center border-top border-success p-2">
                <h2 class="text-success fw-light m-0" style="font-size: 100%">{{$oculo->marca . " " . $oculo->modelo}}</h2>
                <p class="text-success fw-light m-0 fs-4" style="font-size: 100%">{{$oculo->price}}€</p>
            </div>
        </div>
        @endforeach
        @else
            <div class="d-flex align-items-center justify-content-center w-100 p-5">
                <h1 class="text-center text-success">Não existem oculos</h1>
            </div>
        @endisset
    </div>
</div>
<div class="container my-5 bg-light border rounded-4 p-5">
    <h3 class="text-center fw-bolder text-success text-uppercase pb-2 ">Apoio ao Cliente</h3>
    <div class="container mb-5 px-0">
        <ul class="list-group overflow-auto border-success border border-2">
            @forelse ($problems as $problem)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold mb-2">{{$problem->name}}</div>
                    <strong>Email: <span class="fw-light">{{$problem->email}}</span></strong><br>
                    <strong>Assunto: <span class="fw-light">{{$problem->assunto}}</span></strong>
                    <p class="fw-light mt-2 text-description">{{$problem->message}}</p>
                    <form action="/solved" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$problem->id}}">
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-check"></i></button>
                    </form>
                   
                </div>
                <span class="badge bg-success bg-opacity-75 rounded-pill">{{\Carbon\Carbon::parse($problem->created_at)->format('d/m/Y')}}</span>
            </li>
            @empty
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="w-100">
                    <h3 class="w-100 text-center text-success fw-lighter mt-2">NÃO EXISTEM SOLICITUDES DE APOIO AO CLIENTE</h3>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</div>
<script>
    document.querySelectorAll('.oculos-pesquisa').forEach(oculo => {
        oculo.addEventListener('click', () => {
            var oculoID = oculo.getAttribute('data-id');
            window.location.href = "/oculo/" + oculoID;
        })
    })
    document.addEventListener('DOMContentLoaded', ()=>{
        var deleted = document.getElementById('deleted');
        if (deleted) {
            setTimeout(() => {
                deleted.remove();
            }, 3000);
        }
    })
</script>
@endsection