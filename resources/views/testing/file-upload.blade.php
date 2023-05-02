@extends('layouts.master')

@section('content')
<section class="text-light">

  <div class="container">
    <form action="{{ route('apiStorePayment') }}" method="post" enctype="multipart/form-data">
      <input type="file" name="paymentProof" />

      <x-buttons.outlined-button type="submit" label="Upload" />
    </form>
  </div>

</section>
@endsection