@extends('Layouts.Layout')

@section('content')
<div class="container my-5 bg-light border rounded-4 p-5 d-flex flex-column justify-content-center align-items-center">
    <h2 class="text-uppercase text-success">Apoio ao Clientes - Contacta-nos</h2>
    @if (session('success'))
        <div class="w-100 d-flex justify-content-center mt-2" id="Added">
            <p class="text-center bg-success text-light rounded rounded-2 w-25">{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="alert">
            <ul class="d-flex flex-column justify-content-center align-items-center ">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="border border-1 border-success rounded-3 mt-3 w-75">
        <form action="/contactos" method="POST" class="p-5">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-success fw-light">Nome Completo:</label>
                <input type="text" class="form-control border-success" id="name" name="name" placeholder="ex: Miguel Peñaranda" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-success fw-light">Endereço de email:</label>
                <input type="email" class="form-control  border-success" id="email" name="email" placeholder="ex: miguel@gmail.com" required>
            </div>
            <div class="mb-3">
                <label for="assunto" class="form-label text-success fw-light">Assunto:</label>
                <input type="text" class="form-control  border-success" id="assunto" name="assunto" placeholder="ex: Oculos Errados" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label text-success fw-light">Mensagem:</label>
                <textarea class="form-control  border-success" id="message" rows="3" name="message" placeholder="Escreva o problema..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        var successBuy = document.getElementById('Added');
        if (successBuy) {
            setTimeout(() => {
                successBuy.remove();
            }, 3000);
        }
    })
</script>
@endsection