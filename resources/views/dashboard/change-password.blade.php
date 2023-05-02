@extends('layouts.master')

@section('content')
<section>
  <div class="container-sm border border-dark rounded py-3 px-4" style="width: 35%">
    <div class="row justify-content-center mb-4">
      <span class="h4 text-white">Change Password</span>
    </div>

    <form action="{{ route('dashboard.change-password.post') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="">Old Password</label>
        <x-inputs.outlined-input type="password" id="current_password" name="current_password" />
      </div>

      <div class="form-group">
        <label for="">New Password</label>
        <x-inputs.outlined-input type="password" name="password" id="password" />
      </div>

      <div class="form-group">
        <label for="">Confirm New Password</label>
        <x-inputs.outlined-input type="password" name="password_confirmation" id="password_confirmation" />
        <small id="passwordMatchMessage"></small>
      </div>

      <div class="d-flex justify-content-end mt-5">
        <x-buttons.text-button type="submit" label="Back"
          onclick="location.href = '{{ route('dashboard.edit-profile') }}'" />
        <x-buttons.outlined-button label="proceed" />
      </div>
    </form>
  </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush

@push('scripts')
<script>
  const newPassword = document.querySelector('#password')
  const confirmNewPassword = document.querySelector('#password_confirmation')
  const passwordMatchMessage = document.querySelector('#passwordMatchMessage')

  confirmNewPassword.addEventListener('keyup', e => {
    console.log('asd')
    if (newPassword.value != confirmNewPassword.value){
      passwordMatchMessage.classList.remove('text-success')
      passwordMatchMessage.classList.add('text-danger')
      passwordMatchMessage.textContent = 'Password not match!'
    } else {
      passwordMatchMessage.classList.remove('text-danger')
      passwordMatchMessage.classList.add('text-success')
      passwordMatchMessage.textContent = 'Password match!'
    }
  })
</script>

<script src="{{ asset('js/custom/simple-notify.min.js') }}"></script>
<script src="{{ asset('js/custom/toast.js') }}"></script>
<script>
  const checkSession = '{{ Session::has("success") ? "success" : (Session::has("error") ? "error" : "") }}';

  if(checkSession === 'success'){
    successToast('{{ Session::get("success") }}')
  }

  if(checkSession === 'error'){
    errorToast('{{ Session::get("error") }}')
  }

</script>
@endpush
