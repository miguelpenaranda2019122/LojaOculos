@extends('Layouts.Layout')


@section('content')
<div id="home">
    <div class="background-overlay"></div>
        <div class="content container d-flex align-items-center justify-content-center py-5 container-md gap-5">
            <div class="box w-100 h-100 d-flex flex-md-row flex-column pt-5 bg-success bg-opacity-50">
                <div class="w-75 overflow-scroll p-3 container d-flex flex-column align-items-center">
                    <h1 class="text-center">Bem-vindos à OptiVision: O Seu Destino Predileto para Óculos de Qualidade</h1>
                    <p class="text-content">Na OptiVision, orgulhamo-nos de ser mais do que uma simples loja de óculos; somos um portal integral onde moda e funcionalidade se encontram. O nosso site está desenhado para proporcionar uma experiência de compra e venda de óculos incomparável, unindo a mais recente tecnologia com uma vasta variedade de opções para todos.</p>
                    <p class="text-content">Na OptiVision, acreditamos que encontrar o par de óculos perfeito deve ser uma experiência emocionante e gratificante. Quer esteja à procura de um novo estilo ou a vender um par que já não usa, o nosso site é o lugar onde as suas necessidades encontram soluções de qualidade. Explore a OptiVision hoje e descubra por que somos a melhor escolha para as suas necessidades de óculos!</p>
                    <a href="/oculos" class="btn btn-outline-light btn-lg text-decoration-none">Ver Oculos</a>
                </div>
                <div class="w-50 container my-2"><img src="../assets/oculos.png" alt="" class="img-box2" /></div>
            </div>
        </div>
    </div>
    <h2 class="container text-success text-uppercase w-100 text-center my-4">Ultimas Reviews dos Nossos Oculos</h2>
    <div class="container reviews mb-5 px-0 overflow-scroll" style="height: 39.5vh;">
        <ol class="list-group">
            @foreach ($reviews as $review)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto text-success">
                    <div class="fw-bold mb-2">{{$review->autor}}</div>
                    <strong>Oculos: <span class="fw-light">{{$review->oculo}}</span></strong>
                    <div class="mt-2"></div>
                    <strong>Pontuação: <span class="fw-light">{{$review->rating}}/10</span></strong>
                    <p class="fw-light mt-2 text-description">{{$review->comment}}</p>
                </div>
                <span class="badge bg-success bg-opacity-75 rounded-pill">{{\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</span>
            </li>
            @endforeach
        </ol>
    </div>
@endsection
