@extends('Layouts.Layout')

@section('content')
    <div class="container detalhes-card my-5 bg-light border-2 border border-success rounded-4 d-flex">
       
        @isset($oculo)
        <div class="w-25 img-oculos d-flex flex-column justify-content-center px-3">
            <img src="{{$oculo->image}}" class="object-fit-contain w-100" alt="rayban">
            <h2 class="text-success text-center">{{$oculo["marca"] . " " . $oculo["modelo"]}}</h1>
            <p class="text-success w-100 text-center fw-light ">By {{ $nameSeller }}</p>
        </div>
        <div class="w-75 py-4 px-5 border-start border-success border-1 description-oculos">
            <h2 class="text-success">Descrição:</h2>
            <p class="text-description text-success fw-light">{{$oculo->description}}</p>
            <ul>
                <li class="text-success fw-light text-description2">Marca: {{$oculo->marca}}</li>
                <li class="text-success fw-light text-description2">Modelo: {{$oculo->modelo}}</li>
                <li class="text-success fw-light text-description2">Cor: {{$oculo->color}}</li>
                <li class="text-success fw-light text-description2">Material: {{$oculo->material}}</li>
                <li class="text-success fw-light text-description2">Tamanho: {{$oculo->tamanho}}</li>
                <li class="text-success fw-light text-description2">Largura da Lente: {{$oculo->largura}} mm</li>
                <li class="text-success fw-light text-description2">Altura da Lente: {{$oculo->altura}} mm</li>
                <li class="text-success fw-light text-description2">Ponte: {{$oculo->ponte}} mm</li>
                <li class="text-success fw-light text-description2">Comprimento da Haste: {{$oculo->comprimento_haste}} mm</li>
            </ul>
            <p class="fw-light text-success text-description2 m-0"><span class="fw-bold me-2">Preço:</span>{{$oculo->price}}€</p>
            <p class="fw-light text-success text-description2"><span class="fw-bold me-2">Stock:</span>{{$oculo->stock}}</p>
            @if (session('error'))
                <div class="w-50">
                    <p class="bg-danger text-light rounded rounded-4 p-2 w-50 text-center">{{ session('error') }}</p>
                </div>
            @endif
            @if ($oculo->stock > 0)
                @auth
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#AddToCart" type="button">Adicionar ao Carrinho</button>
                @endauth
                @guest
                    <a href="/register" class="btn btn-outline-success">Criar Conta para Comprar</a>
                @endguest
            @else
            <p class="text-center bg-danger text-light rounded rounded-2 w-25">SOLD OUT</p>
            @endif
            @if (Auth::user() && Auth::user()->is_admin)
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProduct" type="button">Eliminar Produto</button>
            @endif
        </div>
    </div>
    <h2 class="container text-success text-uppercase w-100 text-center mb-4">Ultimas Reviews</h2>
    <div class="container mb-5 px-0">
        <ul class="list-group overflow-auto border-success border border-2">
            @forelse ($reviews as $review)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto text-success ">
                        <div class="fw-bold mb-2">{{$review->autor}}</div>
                        <strong>Oculos: <span class="fw-light">{{$oculo->marca . " " . $oculo->modelo}}</span></strong>
                        <div class="mt-2"></div>
                        <strong>Pontuação: <span class="fw-light">{{$review->rating}}</span></strong>
                        <p class="fw-light mt-2 text-description">{{$review->comment}}</p>
                    </div>
                    <span class="badge bg-success bg-opacity-75 rounded-pill">{{\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</span>
                </li>
            @empty
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto text-success w-100">
                    <h2 class="fw-lighter text-center w-100 py-4">AINDA NÃO HÁ REVIEWS</h2>
                </div>
            </li>
            @endforelse
        </ul>
        @else
            <div class="d-flex flex-column align-items-center justify-content-center w-100 p-5">
                <h1 class="text-center text-success">Oculos não encontrado</h1>
                <a href="/oculos" class="link-success fw-light ">Voltar aos Oculos</a>
            </div>
        @endisset
    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="deleteProduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-5 border-success text-success">
            <div class="modal-header">
                <h5 class="modal-title subtitle-modal fw-bolder">Eliminar Produto</h5>
                <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form method="POST" action="/oculo/{{$oculo->id}}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group py-2">
                        <label for="name" class="subtitle-moda mb-2l">Tem a certeza que quer eliminar este produto?</label>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <div>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success ms-2">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="AddToCart">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-5 border-success text-success">
            <div class="modal-header">
                <h5 class="modal-title subtitle-modal fw-bolder">Adicionar ao Carrinho</h5>
                <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form method="POST" action="/oculo/{{$oculo->id}}">
                    @csrf
                    <div class="form-group py-2">
                        <label for="quantity" class="subtitle-moda mb-2l">Quantidade:</label>
                        <input type="number" class="form-control" min="1"  max="{{$oculo->stock}}" name="quantity" required>
                        @if ($oculo->stock == 0)
                            <p class="text-danger">* Não há stock suficiente</p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <div>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success ms-2">Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection