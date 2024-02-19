@extends('Layouts.Layout')


@section('content')
    
<div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-10">
      <div class="card" style="border-radius: 1rem;">
        <div class="row g-0">
          <div class="col-md-6 col-lg-5 d-none d-md-block">
            <img src="/assets/background-login.png" class="img-fluid"/>
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">
              <x-auth-session-status class="mb-4" :status="session('status')" />
              <form method="POST" action="{{ route('login') }}">
                  @csrf

                <div class="d-flex align-items-center mb-3 pb-1">
                  <img src="/assets/logo.png" width="110" height="70" alt="" style="filter: invert(36%) sepia(95%) saturate(377%) hue-rotate(100deg) brightness(94%) contrast(88%);"/>
                  <span class="h1 fw-bold mb-0 ps-1 text-success">OptiVision</span>
                </div>

                <h5 class="text-success text-opacity-75 mb-3 pb-3" style="letter-spacing: 1px;">Inicia Sessão...</h5>
                <div class="form-outline mb-4">
                  <input type="email" id="email" class="form-control form-control-lg" name="email" :value="old('email')" required autofocus autocomplete="username" />
                  <label class="form-label text-success text-opacity-75 pt-1" for="email" :value="__('Email')">Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="password" class="form-control form-control-lg" name="password" required autocomplete="current-password"/>
                  <label class="form-label text-success text-opacity-75 pt-1" for="password" :value="__('Password')">Password</label>
                </div>

                <div class="block mb-4">
                  <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="rounded" name="remember">
                      <span class="ms-2 text-success text-opacity-75">{{ __('Remember me') }}</span>
                  </label>
              </div>
                
                <div class="pt-1 mb-4 d-flex align-items-center gap-4">
                  <button class="btn btn-success btn-lg btn-block w-25" type="submit">Login</button>
                  <x-input-error :messages="$errors->get('email')"/>
                </div>

                <p class="pb-lg-2 text-success text-opacity-75" >Ainda não tens conta? <a href="/register"
                  class="link-success">Regista-te aqui</a>
                </p>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection
    