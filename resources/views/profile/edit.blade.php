@extends('Layouts.Layout')


@section('content')
<section>
    @if (session('success'))
        <div class="w-100 d-flex justify-content-center" id="succesBuy">
            <p class="text-center bg-success text-light rounded rounded-2 w-25 mt-5">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('review'))
        <div class="w-100 d-flex justify-content-center" id="succesReview">
            <p class="text-center bg-success text-light rounded rounded-2 w-25 mt-5">{{ session('review') }}</p>
        </div>
    @endif
    @if (session('oculoUpdated'))
        <div class="w-100 d-flex justify-content-center" id="oculoUpdated">
            <p class="text-center bg-success text-light rounded rounded-2 w-25 mt-5">{{ session('oculoUpdated') }}</p>
        </div>
    @endif
    @if (session('oculoDeleted'))
        <div class="w-100 d-flex justify-content-center" id="oculoUpdated">
            <p class="text-center bg-success text-light rounded rounded-2 w-25 mt-5">{{ session('oculoDeleted') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 border border-2 border-success">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/" class="link link-success">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil de Usuario</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div>
            <div class="card mb-4">
                <div class="card-body border border-2 border-success rounded">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 text-success">Nome Completo</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 text-success">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex container justify-content-center gap-5 flex-md-row flex-column">
                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#updatePass" type="button">Update Password</button>
                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#updateProfile" type="button">Update Profile</button>
                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#deleteAccount" type="button">Delete Profile</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                        <div class="card-body border border-2 border-success rounded container">
                            <div class="header-card">
                                <h3 class="text-success w-100 text-center">Os Meus Produtos</h3>
                            </div>
                            <hr>

                            @forelse ($oculos as $oculo)
    
                                <div class="card-oculo">
                                    <h3 class="text-success w-100 text-center mb-3">{{$oculo->marca . " " . $oculo->modelo}}</h3>
                                    <ul class="text-success">
                                        <li><p class="text-success">Fecha da Publicação: <span class="ps-2">{{\Carbon\Carbon::parse($oculo->created_at)->format('d/m/Y')}}</span></p></li>
                                        <li><p class="text-success">Marca: <span class=" ps-2">{{$oculo->marca}}</span></p></li>
                                        <li><p class="text-success">Modelo: <span class=" ps-2">{{$oculo->modelo}}</span></p></li>
                                        <li><p class="text-success">Stock: <span class=" ps-2">{{$oculo->stock}}</span></p></li>
                                        <li><p class="text-success">Preçõ: <span class=" ps-2">{{$oculo->price}}€</span></p></li>
                                    </ul>
                                    <div class="buttons-functions d-flex justify-content-center gap-4">
                                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#updateProduct{{$oculo->id}}" type="button">Update</button>
                                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#deleteProduct{{$oculo->id}}" type="button">Delete</button>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="updateProduct{{$oculo->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border border-5 border-success text-success">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title subtitle-modal fw-bolder">Update Produto</h5>
                                                        <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body container">
                                                        <form method="POST" action="/updateOculo">
                                                            @csrf
                                                            @method('PUT')
                                        
                                                            <div class="form-group py-2">
                                                                <input type="hidden" class="form-control" name="id" value="{{$oculo->id}}" required>
                                                            </div>
                                                            <div class="form-group py-2">
                                                                <label for="stock" class="subtitle-moda mb-2l">Stock:</label>
                                                                <input type="number" class="form-control" min="1" max="10" name="stock" value="{{$oculo->stock}}" required>
                                                            </div>
                                                            <div class="form-group py-2">
                                                                <label for="price" class="subtitle-moda mb-2l">Preço:</label>
                                                                <input type="number" class="form-control" min="1"  name="price" value="{{$oculo->price}}" required>
                                                            </div>
                                                            <div class="d-flex justify-content-between py-2">
                                                                <div>
                                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-success ms-2">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteProduct{{$oculo->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border border-5 border-success text-success">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title subtitle-modal fw-bolder">Eliminar Produto</h5>
                                                        <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body container">
                                                        <form method="POST" action="/updateOculofromProfile">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="form-group py-2">
                                                                <input type="hidden" name="id" class="form-control" value="{{$oculo->id}}">
                                                            </div>
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
                                    </div>
                                </div>
                                <hr> 
                                @empty
                                <h4 class="text-success w-100 text-center fw-light ">Não existem oculos á venda</h4>
                                <hr> 
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                        <div class="card-body border border-2 border-success rounded container">
                            <div class="header-card">
                                <h3 class="text-success w-100 text-center">Historial Compras</h3>
                            </div>
                            <hr>
                            @forelse ($historial as $compra)
                                <h3 class="text-success w-100 text-center mb-2">{{$compra->marca . " " . $compra->modelo}}</h3>
                                <div>
                                    <ul>
                                        <li><p class="text-success">Fecha de Compra: <span class="ps-2">{{\Carbon\Carbon::parse($compra->created_at)->format('d/m/Y')}}</span></p></li>
                                        <li><p class="text-success">Marca: <span class=" ps-2">{{$compra->marca}}</span></p></li>
                                        <li><p class="text-success">Color: <span class=" ps-2">{{$compra->color}}</span></p></li>
                                        <li><p class="text-success">Quantidade: <span class=" ps-2">{{$compra->quantity}}</span></p></li>
                                        <li><p class="text-success">Preço: <span class=" ps-2">{{$compra->price * $compra->quantity}}€</span></p></li>
                                    </ul> 
                                    <div class="w-100 text-center">
                                       
                                        <button class="btn btn-success btn-lg text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#review{{$compra->oculo_id}}" type="button">Escrever review</button>
                                       
                                        <div class="modal fade" tabindex="-1" role="dialog" id="review{{$compra->oculo_id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border border-5 border-success text-success">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title subtitle-modal fw-bolder">Escreva uma Review</h5>
                                                        <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body container">
                                                        <form method="POST" action="/review">
                                                            @csrf
                                                            <div class="form-group py-2">
                                                                <input type="hidden" name="id" value="{{$compra->oculo_id}}" required>
                                                            </div>
                                                            <div class="form-group py-2">
                                                                <label for="rating" class="subtitle-moda mb-2l">Pontuação:</label>
                                                                <input type="number" class="form-control" min="1"  max="10" name="rating" placeholder="ex: 10" required>
                                                            </div>
                                                            <div class="form-group py-2">
                                                                <label for="comment" class="subtitle-moda mb-2l">Descrição:</label>
                                                                <textarea class="form-control  border-success" rows="3" placeholder="Escreva a review..." name="comment" required></textarea>
                                                            </div>
                                                            <div class="d-flex justify-content-between py-2">
                                                                <div>
                                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-success ms-2">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <h4 class="text-success w-100 text-center fw-light ">Ainda não efetuo compras</h4>
                                <hr> 
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    document.addEventListener('DOMContentLoaded', ()=>{
        var successBuy = document.getElementById('succesBuy');
        if (successBuy) {
            setTimeout(() => {
                successBuy.remove();
            }, 3000);
        }
    })

    document.addEventListener('DOMContentLoaded', ()=>{
        var successBuy = document.getElementById('succesReview');
        if (successBuy) {
            setTimeout(() => {
                successBuy.remove();
            }, 3000);
        }
    })
    document.addEventListener('DOMContentLoaded', ()=>{
        var oculoUpdated = document.getElementById('oculoUpdated');
        if (oculoUpdated) {
            setTimeout(() => {
                oculoUpdated.remove();
            }, 3000);
        }
    })
    document.addEventListener('DOMContentLoaded', ()=>{
        var oculoDeleted = document.getElementById('oculoDeleted');
        if (oculoDeleted) {
            setTimeout(() => {
                oculoDeleted.remove();
            }, 3000);
        }
    })
</script>
<x-modals></x-modals>
@endsection



