@extends('layouts.master')

@section('content')
<section>
  <div class="row px-5 pt-2">
    <div class="col justify-items-start pt-5">
      <h1 style="text-align: start; letter-spacing: 0.12em; line-height: 1.5em; font-size: 2.5em">
        How to Respond <br>
        The Implementation of <br>
        The <span style="color: rgba(13, 171, 235, 1)">G20 Presidency</span> <br>
        In Indonesia?
      </h1>
      <div class="mt-2">
        <span>
          Deskripsi singkat
        </span>
      </div>
    </div>

    <div class="col">
      <img src="/img/talkshow/poster.png" alt="poster" width="600px">
    </div>
  </div>
</section>

<section class='text-center'>
  <h3 class="text-uppercase">
    more information
  </h3>

  <div class="col">
    <img class="mb-4" src="/img/talkshow/pemateri.png" alt="pemateri" width="250px">
    <h3>
      Aldi Rindana as Speaker
    </h3>
    <span>Head of Program IYD LC East Kalimantan</span>
  </div>

  <div class="d-flex justify-content-around mt-5">
    <div>
      <img src="/img/talkshow/map.png" alt="icon" width="110px">
      <div class="mt-2 font-weight-500" style='letter-spacing: 0.12em
      '>
        Auditorium Lab Terpadu <br>
        Institut Teknologi Kalimantan
      </div>
    </div>

    <div>
      <img src="/img/talkshow/calendar.png" alt="icon" width="110px">
      <div class="mt-2 font-weight-500" style='letter-spacing: 0.12em
      '>
        Minggu, 23 Oktober 2022 <br>
        13:00 WITA - Selesai
      </div>
    </div>
  </div>
</section>

<section class="text-light" id="registerTalkshow">
  <div class="wm wm-border dark wow fadeInDown"></div>
  <div class="container-sm border border-dark rounded mt-4 pt-5 px-5 pb-2">
    <div class="d-flex justify-content-center">
      <h3 class="text-uppercase mb-5" style="letter-spacing: .17em">daftar talkshow</h3>
      {{-- <a href="#" class="text-muted">Gunakan Profil INSPACE</a> --}}
    </div>
    <form class="my-4" action="#" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="">Nama Lengkap</label>
            <x-inputs.outlined-input type="text" value="{{ old('name') }}" placeholder="eg. Vince Sullivan" />
            @error('name')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">No HP</label>
            <x-inputs.outlined-input type="text" name="telephone" value="{{ old('telephone') }}"
              placeholder="eg. 0812345" />
            @error('telephone')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Sekolah/Universitas</label>
            <x-inputs.outlined-input type="text" name="institution" placeholder="eg. Institut Teknologi Kalimantan"
              value="{{ old('institution') }}" />
            <small>*Jika tidak dari keduanya cukup tulis 'umum'</small>
            @error('institution')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Kab./Kota Domisili</label>
            <x-inputs.outlined-input type="text" name="city" placeholder="eg. Balikpapan" value="{{ old('city') }}" />
            @error('city')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="col">
          <div class="mb-3">
            Metode pembayaran
          </div>

          <div>
            <input type="radio" id="pm1" name="payment_method" value="gopay">
            <label for="pm1">GOPAY</label><br>

            <input type="radio" id="pm2" name="payment_method" value="dana">
            <label for="pm2">DANA</label><br>

            <input type="radio" id="pm3" name="payment_method" value="bank tf">
            <label for="pm3">TRANSFER BANK</label>
          </div>

          <div id="recepientContainer" class="mt-3">
            <div id="recepientInfo"></div>
          </div>

          <div class="form-group mt-5">
            <label for="">Bukti pembayaran</label> <br>
            <input type="file" name="bukti_tf">
          </div>
        </div>

      </div>

      <div class="row mt-5 mr-1 justify-content-end">
        <x-buttons.outlined-button class="ml-3" type="submit" label="Daftar" />
      </div>
    </form>
  </div>
</section>
@endsection

@push('scripts')
<script>
  const recepientContainer = document.querySelector('#recepientContainer')

  const paymentMethod = document.querySelector('input[name="payment_method"]')
  const paymentMethodOptions = document.querySelectorAll('input[name="payment_method"]')

  const recepients = [
    {
      'name' : 'Jek',
      'number' : '0812xxx',
      'option' : 'gopay',
      'provider' : 'GOPAY'
    },
    {
      'name' : 'Vince',
      'number' : '0812xxx',
      'option' : 'dana',
      'provider' : 'DANA'
    },
    {
      'name' : 'Rose',
      'number' : '149xxx',
      'option' : 'bank tf',
      'provider' : 'BANK MANDIRI'
    },
  ]

  if (paymentMethod) {
    paymentMethodOptions.forEach((el) => {
    el.addEventListener("change", e => {
      let paymentOption = e.target.value;

      const recepient = recepients.find(({ option }) => option === paymentOption);

      recepientContainer.textContent = ''
      recepientContainer.innerHTML = `
        Silahkan lakukan pembayaran ke: <br>
        <strong id="recepientName">${recepient.name}</strong> <br>
        <strong id="recepientNo">${recepient.number}</strong> <br>
        <strong id="recepientNo">${recepient.provider}</strong> <br>
      `
    })
  })

}
</script>
@endpush
