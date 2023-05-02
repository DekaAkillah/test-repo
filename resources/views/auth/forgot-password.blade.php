@extends('layouts.auth')

@section('content')
<form class="login100-form validate-form" action="{{ route('forgot.password.post') }}" method="post">
  @csrf
  <span class="login100-form-title p-b-30 mb-0">
    Forgot your password?
  </span>

  @if(Session::has('success'))
    <div class="text-danger text-center mb-3">{{ Session::get('success') }}</div>
  @endif 

  @if(Session::has('error'))
    <div class="text-danger text-center mb-3">{{ Session::get('error') }}</div>
  @endif 

  <div class="form-group mb-4">
    <x-inputs.outlined-input type="email" placeholder="Email" name="email" id="email" />
    @error('email')
      <div class="invalid-feedback d-block">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="container-login100-form-btn">
    <button type="submit" class="login100-form-btn">
      Kirim link ganti password
    </button>
  </div>

  <div class="text-center mt-4 p-t-15 p-b-20">
    <span class="txt2">
      Back to <a href="/login">Login</a>
    </span>
  </div>
</form>
@endsection