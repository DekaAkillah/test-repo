@extends('layouts.auth')

@section('content')
<form class="login100-form validate-form" action="{{ route('reset.password.post') }}" method="post">
  @csrf
  <span class="login100-form-title p-b-30 mb-0">
    Reset Password
  </span>
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="form-group mb-3">
    <x-inputs.outlined-input class="@error('email') is-invalid @enderror" type="email" value="{{ old('email') }}"
      name="email" placeholder="Email" />
    @error('email')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <x-inputs.outlined-input class="@error('password') is-invalid @enderror" type="password" value="{{ old('password') }}"
      name="password" placeholder="Password" />
    @error('password')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <x-inputs.outlined-input class="@error('password_confirmation') is-invalid @enderror" type="password" value="{{ old('password_confirmation') }}"
      name="password_confirmation" placeholder="Confirm Password" />
    @error('password_confirmation')
    <div class="invalid-feedback d-block">
      {{ $message }}
    </div>
    @enderror
  </div>


  <div class="container-login100-form-btn">
    <button class="login100-form-btn" type="submit">
      Reset Password
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