@extends('layouts.master')

@push('styles')
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Fontawesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
  integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Custom css -->
<link rel="stylesheet" href="{{ asset('css/custom/layouts/dashboard.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/countdown.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/bgDashboard.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/swiper.css') }}" type="text/css">
@endpush

@section('content')
<section class="text-light">
  <div class="wm2 wm-border2 dark wow fadeInDown text-uppercase">inspace 2022</div>
  <img class='di-small2 d-flex' src='..\images-event\ins.webp' alt='IMG'>
  <div class="container">
    <div class="row">

      <div class="container" id="dashboard">
        <div class="row p-0">
          <div class="col-lg-9 p-0">
            <!-- Countdown Timer -->
            <div class="d-flex mb-3 rounded" id="countdownContainer">
              <div class="swiper countdownSwiper rounded">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <span class='titleTimer'>deadline ui/ux competition tahap 1</span>
                    <div class='countdownTimer'>
                      <div class='countdown'>
                        <span id='daysUIUX'>00</span>
                        <p>days</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='hoursUIUX'>00</span>
                        <p>hours</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='minutesUIUX'>00</span>
                        <p>minutes</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='secondsUIUX'>00</span>
                        <p>seconds</p>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <span class='titleTimer'>deadline business plan competition tahap 1</span>
                    <div class='countdownTimer'>
                      <div class='countdown'>
                        <span id='daysBPC'>00</span>
                        <p>days</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='hoursBPC'>00</span>
                        <p>hours</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='minutesBPC'>00</span>
                        <p>minutes</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='secondsBPC'>00</span>
                        <p>seconds</p>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <span class='titleTimer'>deadline poster competition tahap 1</span>
                    <div class='countdownTimer'>
                      <div class='countdown'>
                        <span id='daysPoster'>00</span>
                        <p>days</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='hoursPoster'>00</span>
                        <p>hours</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='minutesPoster'>00</span>
                        <p>minutes</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='secondsPoster'>00</span>
                        <p>seconds</p>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <span class='titleTimer'>deadline digital animation competition tahap 1</span>
                    <div class='countdownTimer'>
                      <div class='countdown'>
                        <span id='daysDigitalAnimation'>00</span>
                        <p>days</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='hoursDigitalAnimation'>00</span>
                        <p>hours</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='minutesDigitalAnimation'>00</span>
                        <p>minutes</p>
                      </div>
                      <div class='break'> </div>
                      <div class='countdown'>
                        <span id='secondsDigitalAnimation'>00</span>
                        <p>seconds</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button swiper-button-next"></div>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
            </div>

            <!-- Competition Panel -->
            <div class="d-flex flex-column border border-dark rounded p-4 panel">
              <span class="text-uppercase font-weight-bold mb-4" style='letter-spacing: .17em'>
                kompetisi yang diikuti
              </span>

              @forelse($competitionsJoined as $competition)
              <x-items.competition-item :competition="$competition['competition']" :team="$competition['team']"
                :stage="$competition['stage']" />

              @empty

              <div class="align-self-center mt-5">
                Kamu belum mendaftar kompetisi apapun
              </div>

              @endforelse

              <x-buttons.outlined-button label="daftar kompetisi {{ count($competitionsJoined) > 0 ? 'lain' : '' }}"
                class="align-self-center mt-5 mb-4" onclick="window.open('/#section-competitions')" />
            </div>
          </div>

          <!-- Profile panel -->
          <div class="col-lg-3">
            <!-- Announcement Panel -->
            <div class="d-flex flex-column border border-dark rounded py-4 px-2 mb-3 panel">
              <span class="text-uppercase text-center font-weight-bold mb-4" style="letter-spacing: .17em">
                announcement
              </span>
              @php $currentDateTime = \Carbon\Carbon::now(); $sum = 0; @endphp
              @forelse ($announcements as $announcement)
              <x-items.announcement-item title="{{ $announcement['title'] }}"
                message="{{ $announcement['description'] }}"
                datetime="{{ \Carbon\Carbon::parse($announcement['datetime'])->diffForHumans() }}" />
              @empty

              <div class="d-flex flex-column text-center pb-2">
                Seluruh pengumuman acara INSPACE akan ditampilkan disini. Tunggu pengumuman
                selanjutnya ya
              </div>
              @endforelse
            </div>

            <div class="d-flex flex-column align-items-center border border-dark rounded p-4 panel">
              {{-- <input type="file" class="filepond" name="avatar" accept="image/png, image/jpeg" /> --}}
              <img src="{{ asset(auth()->user()->avatar) == 'img/logo/inspace_noyear.webp' ? asset(auth()->user()->avatar) : asset('storage/'.auth()->user()->avatar)  }}" alt="avatar" class="rounded-circle" style="max-width: 150px;">

              <div class="d-flex flex-column mt-4 mb-5 text-center">
                <span class="font-weight-bold">{{ auth()->user()->name }}</span>
                <span class="text-capitalize">{{ auth()->user()->class_major }}</span>
                <span class="text-capitalize">{{ auth()->user()->institution }}</span>

                <div class="mt-2">
                  @if(auth()->user()->is_complete == 1)
                  <x-miscs.badge label="data lengkap" theme="success" />
                  @else
                  <x-miscs.badge label="data belum lengkap" theme="warning" />
                  @endif
                </div>
              </div>

              <x-buttons.outlined-button label="Edit profile"
                onclick="location.href = '{{ route('dashboard.edit-profile') }}'" />
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="wm wm-border dark wow fadeInDown" id="bgText">INSPACE</div> --}}
    </div>
  </div>
</section>
@endsection

@push('scripts')
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Countdown JS -->
<script src="{{ asset('js/custom/countdown.js') }}"></script>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".countdownSwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
          
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>

<script>
  FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginFileValidateType,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview,
  FilePondPluginImageCrop,
  FilePondPluginImageResize,
  FilePondPluginImageTransform
);

FilePond.create(
	document.querySelector('.filepond'),
	{
		labelIdle: `Drag & Drop your avatar or <span class="filepond--label-action">Browse</span>`,
    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleButtonRemoveItemPosition: 'center bottom'
	}
);
</script>

<script>
  // Set the date Deadline UIUX
  var closeRegistrationUIUX = '{{ $competitionUIUX->stage_1_close_registration }}';
  var countDownUIUX = new Date(closeRegistrationUIUX).getTime();
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownUIUX - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    var textDays = document.getElementById("daysUIUX");
    var textHours = document.getElementById("hoursUIUX");
    var textMinutes = document.getElementById("minutesUIUX");
    var textSeconds = document.getElementById("secondsUIUX");
    
    // Display the result
    textDays.innerHTML = days < 10 ? "0" + days : days;
    textHours.innerHTML = hours < 10 ? "0" + hours : hours;
    textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
    textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
    }
  }, 1000);
</script>

<script>
  // Set the date Deadline UIUX
  var closeRegistrationBPC = '{{ $competitionBPC->stage_1_close_registration }}';
  var countDownBPC = new Date(closeRegistrationBPC).getTime();
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownBPC - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    var textDays = document.getElementById("daysBPC");
    var textHours = document.getElementById("hoursBPC");
    var textMinutes = document.getElementById("minutesBPC");
    var textSeconds = document.getElementById("secondsBPC");
    
    // Display the result
    textDays.innerHTML = days < 10 ? "0" + days : days;
    textHours.innerHTML = hours < 10 ? "0" + hours : hours;
    textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
    textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
    }
  }, 1000);
</script>

<script>
  // Set the date Deadline Poster
  var closeRegistrationPoster = '{{ $competitionPoster->stage_1_close_registration }}';
  var countDownPoster = new Date(closeRegistrationPoster).getTime();
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownPoster - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    var textDays = document.getElementById("daysPoster");
    var textHours = document.getElementById("hoursPoster");
    var textMinutes = document.getElementById("minutesPoster");
    var textSeconds = document.getElementById("secondsPoster");
    
    // Display the result
    textDays.innerHTML = days < 10 ? "0" + days : days;
    textHours.innerHTML = hours < 10 ? "0" + hours : hours;
    textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
    textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
    }
  }, 1000);
</script>

<script>
  // Set the date Deadline DigitalAnimation
  var closeRegistrationDigitalAnimation = '{{ $competitionDigitalAnimation->stage_1_close_registration }}';
  console.log(closeRegistrationDigitalAnimation)
  var countDownDigitalAnimation = new Date(closeRegistrationDigitalAnimation).getTime();
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDigitalAnimation - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    var textDays = document.getElementById("daysDigitalAnimation");
    var textHours = document.getElementById("hoursDigitalAnimation");
    var textMinutes = document.getElementById("minutesDigitalAnimation");
    var textSeconds = document.getElementById("secondsDigitalAnimation");
    
    // Display the result
    textDays.innerHTML = days < 10 ? "0" + days : days;
    textHours.innerHTML = hours < 10 ? "0" + hours : hours;
    textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
    textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
    }
  }, 1000);
</script>

@endpush