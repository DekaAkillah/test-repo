@extends('layouts.auth')

@section('content')
<form class="login100-form validate-form" action="#" method="post">
  <span class="login100-form-title p-b-30 mb-0">
    Verify your email
  </span>

  <span style="color: #fff">
    We have sent the verification mail to ali almancie@hotmail.com. If you cannot find the email
    verification mail in the Index folder,please check the Junk/Spam folder

    <br>
    <br>

    If you did not receive the email verification mail please click on the resend button.
  </span>

  <div class="mt-5">
    <x-buttons.outlined-button label="resent verification link" />
  </div>
</form>
@endsection