@extends('Layouts.Layout')

@section('content')
<div class="w-100 d-flex justify-content-center align-items-center " style="height: 75vh;">
    <div class=" d-flex align-items-center gap-5">
        <img src="/assets/error.png" alt="" class="img-error">
        <div>
            <h1 class="text-error">OOPS!</h1>
            <h5 class="text-error2">PAGE NOT FOUND</h5>
            <h1 class="text-error2">ERROR 404</h1>
            <div class="w-100">
                 <a class="btn btn-outline-success  w-100 py-3" href="/">GO BACK</a>
            </div>
        </div>
    </div>
</div>
@endsection