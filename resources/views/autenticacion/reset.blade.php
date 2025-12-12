@extends('autenticacion.app')
@section('titulo', 'Sistema - Cambiar Password')
@section('contenido')
<div class="card card-outline card-primary">
  <div class="card-header">
    <a href="/" class="link-dark text-center">
      <h1 class="mb-0"><b>Sistema</b>LTE</h1>
    </a>
  </div>

  <div class="card-body login-card-body">
    <p class="login-box-msg">Cambiar contraseña</p>

    <form action="{{ route('password.update') }}" method="post">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="input-group mb-3">
        <div class="form-floating">
          <input
            id="loginEmail"
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ $email ?? old('email') }}"
            readonly
          />
          <label for="loginEmail">Email</label>
        </div>
        @error('email')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <div class="form-floating">
          <input
            id="loginPassword"
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
          />
          <label for="loginPassword">Nuevo Password</label>
        </div>
        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <div class="form-floating">
          <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror"
          />
          <label for="password_confirmation">Confirmar Password</label>
        </div>
        @error('password_confirmation')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-primary w-100">
            Actualizar
          </button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection
