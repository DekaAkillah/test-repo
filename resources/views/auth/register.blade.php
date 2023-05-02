@extends('layouts.auth')

@section('content')
<form class="login100-form validate-form" action="{{ route('register') }}" method="post">
  @csrf
  <span class="login100-form-title p-b-30 mb-0">
    Daftar
  </span>

  <div class="form-group mb-3">
    <x-inputs.outlined-input type="text" value="{{ old('name') }}" name="name" placeholder="Nama Lengkap" />
    @error('name')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <x-inputs.outlined-input type="email" value="{{ old('email') }}" name="email" placeholder="Email" />
    @error('email')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <x-inputs.outlined-input type="password" name="password" placeholder="Password" />
    @error('password')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  @if(session()->has('authError'))
  <div class="invalid-feedback d-block">
    {{ session('authError') }}
  </div>
  @endif

  <div class="container-login100-form-btn">
    <button class="login100-form-btn">
      Daftar
    </button>
  </div>

  <div class="text-center p-t-15 p-b-20">
    <span class="txt2">
      Sudah punya akun? <a href="/login">Login</a>
    </span>
  </div>
</form>
@endsection