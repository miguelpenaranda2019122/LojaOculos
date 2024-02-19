@extends('Layouts.Layout')


@section('content')
    <div class="container my-5 bg-light border rounded-4 p-5 d-flex flex-column justify-content-center align-items-center">
        <h2 class="text-uppercase text-success">Vende os teus Oculos - Trabalha Connosco</h2>
        <div class="border border-1 border-success rounded-3 mt-3 w-75">
            <form action="/vender" method="post" class="p-5" enctype="multipart/form-data">
                @csrf

                @if (session('success'))
                    <div class="w-100 d-flex justify-content-center">
                        <p class="text-center bg-success text-light rounded rounded-2 w-25 p-1">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="w-100 d-flex justify-content-center">
                        <p class="text-center bg-danger text-light rounded rounded-2 w-25 p-1">{{ session('error') }}</p>
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

                @isset(Auth::user()->id)
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @endisset
                <div class="mb-3">
                    <label for="marca" class="form-label text-success fw-light">Marca:</label>
                    <input type="text"  name="marca" class="form-control border-success" placeholder="ex: Ray-Ban" required>
                </div>
                <div class="mb-3">
                    <label for="modelo" class="form-label text-success fw-light">Modelo:</label>
                    <input type="text" name="modelo" class="form-control  border-success" placeholder="ex: Farmyer" required>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label text-success fw-light">Cor:</label>
                    <input type="text" name="color" class="form-control  border-success"  placeholder="ex: Preto" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label text-success fw-light">Descrição:</label>
                    <textarea class="form-control  border-success"  name="description" id="description" rows="3"  placeholder="Escreva uma descrição..." required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label text-success  fw-light">Imagem:</label>
                    <input type="file" class="form-control  border-success file-input" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label text-success fw-light">Material:</label>
                    <input type="text" class="form-control  border-success"  placeholder="ex: Acetato" name="material" required>
                </div>
                <div class="mb-3">
                    <label for="tamanho" class="form-label text-success fw-light">Tamanho:</label>
                    <input type="number" class="form-control  border-success"  placeholder="ex: 50" name="tamanho" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="largura" class="form-label text-success fw-light">Largura da Lente:</label>
                    <input type="number" class="form-control  border-success"  placeholder="ex: 22" name="largura" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="altura" class="form-label text-success fw-light">Altura da Lente:</label>
                    <input type="number" class="form-control  border-success"  placeholder="ex: 40" name="altura" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="ponte" class="form-label text-success fw-light">Ponte:</label>
                    <input type="number" class="form-control  border-success opacity-100 "  placeholder="ex: 22" name="ponte" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="comprimento_haste" class="form-label text-success fw-light">Comprimento das Haste:</label>
                    <input type="number" class="form-control  border-success"  placeholder="ex: 22" name="comprimento_haste" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label text-success fw-light">Stock (10 no máximo):</label>
                    <input type="number" class="form-control  border-success" placeholder="ex: 10" name="stock" min="1" max="10" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-success fw-light">Preço:</label>
                    <input type="number" class="form-control  border-success" placeholder="ex: 10" name="price" min="0" required>
                </div>
                @auth
                    <button type="submit" class="btn btn-success">Publicar Oculo</button>
                @endauth
                @guest
                    <a href="/login" class="btn btn-outline-success">Login</a>
                @endguest
            </form>
        </div>
    </div>
@endsection