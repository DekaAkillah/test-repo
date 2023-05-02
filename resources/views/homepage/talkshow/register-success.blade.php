@extends('layouts.master')

@push('styles')
<!-- Fontawesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
  integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<section>
  <div class="col p-5 text-center">
    <h2>Terima kasih telah mendaftar Talkshow INSPACE 2022</h2>
    <div>
      Hai [nama user]! Pembayaranmu akan segera kami konfirmasi, cek email secara berkala ya <br> Untuk informasi
      lebih lanjut mengenai
      Talkshow
      silahkan bergabung di grup whatsapp.
    </div>

    <div class="row justify-content-center mt-5">
      <x-buttons.filled-join-button type="button" label="Join Group"
        onclick="window.open('https://chat.whatsapp.com/D9t7tzkADIGDVE3zAQ913V')" />
    </div>
  </div>
</section>
@endsection
