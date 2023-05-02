@extends('layouts.auth')

@section('content')
<form class="login100-form validate-form" action="{{ route('authenticate') }}" method="post">
  @csrf
  <span class="login100-form-title p-b-30 mb-0">
    Login
  </span>

  @if(Session::has('success'))
    <div class="text-danger text-center mb-3">{{ Session::get('success') }}</div>
  @endif 

  @if(Session::has('error'))
    <div class="text-danger text-center mb-3">{{ Session::get('error') }}</div>
  @endif 

  <div class="form-group mb-3">
    <x-inputs.outlined-input type="email" value="{{ old('email') }}" name="email" placeholder="Email" />
    @error('email')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <x-inputs.outlined-input name="password" type="password" placeholder="Password" />

    @error('password')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="flex-sb-m w-full p-t-3 p-b-32">
    <div>
      <a href="{{ route('forgot.password.get') }}" class="txt1">
        Forgot Password?
      </a>
    </div>
    @if(session()->has('authError'))
    <div class="text-danger">
      {{ session('authError') }}
    </div>
    @endif
  </div>


  <div class="container-login100-form-btn">
    <button class="login100-form-btn" type="submit">
      Login
    </button>
  </div>

  <div class="text-center p-t-15 p-b-20">
    <span class="txt2">
      or
    </span>
  </div>

  <div class="d-flex justify-content-center">
    <x-buttons.outlined-button type="button" label="Daftar" onclick="location.href = '{{ route('registration') }}'" />
  </div>
</form>
@endsection