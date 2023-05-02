@extends('layouts.master')

@push('styles')
<!-- Fontawesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
  integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Custom css -->
<link rel="stylesheet" href="{{ asset('css/custom/layouts/dashboard.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/bgDashboard.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/components/stepper.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/components/filepond.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom/countdown.css') }}" type="text/css">
@endpush

@section('content')
<section class="text-light">
  <div class="wm wm-border dark wow fadeInDown text-uppercase" style='font-size: 260px; width: max-content; top: 90px'>
    {{ $competition['team']['name'] }}</div>
  <img class='di-small2 d-flex' src="{{ asset('images-event/ins.webp') }}" alt='IMG'>
  <div class="container p-2" id="dashboard">
    <div class="row">
      <div class="col-lg-9">

        {{-- Banner --}}
        <div class="row border border-dark rounded py-4 align-items-center justify-content-between bg-tint-dark">
          <div class="row px-4 m-0">
            <img src="{{ asset('logo-program') }}/{{ $competition['slug'] }}.webp" alt="avatar" class="rounded-circle"
              style="max-width: 90px; max-height: 90px">

            <div class="col ml-3">
              <span class="h2">{{ $competition['title'] }}</span>
              <div class="row pt-3 pl-3">
                <x-buttons.filled-gradient-button class="mr-3" label="guidebook"
                  onClick="javascript:window.open( '{{ $competition['guidebook_link'] }}', '_blank');" />
                @php
                $slug = $competition['slug'];
                @endphp

                <x-buttons.outlined-button label="lihat kompetisi" onclick="window.open('/competition/{{ $slug }}')" />
              </div>
            </div>
          </div>

          <div class="col" id="cp">
            <div class="mb-2 float-right">
              <span class="text-dark text-uppercase" style="font-size: 14px; letter-spacing: .17em;">
                contact person
              </span>
            </div>

            <div class="float-right">
              <span>
                <a href="#">
                  <i class="fa fa-phone fa-lg mr-2" style="color: #EC167F"></i>
                </a>
                {{ $competition['cp_telp'] }} ({{ strtok($competition['cp_name'], " ") }})
              </span>
            </div>
          </div>
        </div>

        {{-- Main Panel --}}
        <div class="row border border-dark rounded mt-3 p-4 bg-tint-dark">

          @if($competition['slug'] == 'ui-ux-' . $competition['year'])

          @include('dashboard.show-team.competition-forms.ui-ux.index', ['stage' => $competition['stage']['index']])

          @elseif($competition['slug'] == 'bpc-' . $competition['year'])

          @include('dashboard.show-team.competition-forms.bpc.index', ['stage' => $competition['stage']['index']])

          @elseif($competition['slug'] == 'animasi-digital-' . $competition['year'])

          @include('dashboard.show-team.competition-forms.digital-animation.index', ['stage' =>
          $competition['stage']['index']])

          @else

          @include('dashboard.show-team.competition-forms.poster.index', ['stage' => $competition['stage']['index']])

          @endif

        </div>
      </div>

      <div class="col-lg-3">
        <!-- Start Countdown -->
        <div class="col d-flex flex-column justify-content-center border border-dark rounded py-4 p-2"
          style='align-items: center; height: 120px; background: linear-gradient(270deg, #893ff8 0%, #e81580 100%);'>
          <div class="row px-4 m-0 mt-3">
            <span class='titleTimer' style='margin-top: 0'>batas pengumpulan</span>
          </div>
          <div class='countdownTimer' style='font-size: revert'>
            <div class='countdown'>
              <span id='days'>00</span>
              <p>days</p>
            </div>
            <div class='break' style='margin-right: 0'></div>
            <div class='countdown'>
              <span id='hours'>00</span>
              <p>hours</p>
            </div>
            <div class='break' style='margin-right: 0'></div>
            <div class='countdown'>
              <span id='minutes'>00</span>
              <p>minutes</p>
            </div>
            <div class='break' style='margin-right: 0'></div>
            <div class='countdown'>
              <span id='seconds'>00</span>
              <p>seconds</p>
            </div>
          </div>
        </div>
        <!-- Start Countdown -->
        <div class="col d-flex flex-column justify-content-center border border-dark rounded p-2 mt-3 bg-tint-dark">
          <div class="col mt-3 text-center">
            <span class="text-uppercase">seleksi stage</span>
          </div>

          <h1 class="font-weight-bold" style="font-size: 8em">
            {{ $competition['stage']['number'] }}
          </h1>

          <div class="d-flex flex-column mb-4 text-center">
            @php
            $checked = 0;
            $unChecked = 0;
            @endphp
            @foreach ($competition['stage']['todos'] as $todo)
            <x-miscs.todo-checklist :title="$todo['title']" :isChecked="$todo['isChecked']" />
            @php
            if($todo['isChecked']){
            $checked += 1;
            }else{
            $unChecked += 1;
            }
            @endphp
            @endforeach
          </div>

          <div class="col my-3 text-center">
            @if($unChecked == 0)
            <x-miscs.badge label="telah submit" theme="success" />
            @else
            <x-miscs.badge label="data belum lengkap" theme="danger" />
            @endif
          </div>
        </div>

        <div class="d-flex flex-column border border-dark rounded mt-3 p-4 panel">
          <span class="text-uppercase text-center font-weight-bold mb-1" style="letter-spacing: .17em">
            whatsapp group</span>
          <div class="d-flex flex-column text-center mb-2">
            Untuk memudahkan informasi lebih lanjut terkait lomba
          </div>
          <div class="row justify-content-center">
            <x-buttons.filled-join-button type="button" label="Join Group" onclick="window.open(`{{ $competition['group_link'] }}`)" />
          </div>
        </div>

        @if($competition['is_group'] == 1 && $competition['team'] != null)

        <div class=" col border border-dark rounded mt-3 p-4 text-center bg-tint-dark">
          <img
            src="{{ $competition['team']['logo'] == 'img/logo/inspace_noyear.webp' ? asset($competition['team']['logo']) : asset('storage/'.$competition['team']['logo']) }}"
            alt="logo" class="rounded-circle" style="max-width: 120px;  border: 3px solid #EC167F">

          <div class="col p-0 mt-3 mb-5 text-center">
            <span class="h3 font-weight-bold text-uppercase">
              {{ $competition['team']['name'] }}
            </span>

            <div>
              <i class="far far-user"></i>
              <span class="font-weight-light text-grey">
                <i class="fa fa-users mr-1"></i>
                <b>{{ $competition['team']['member'] + 1 }}</b> Members
              </span>
            </div>

            <span class="text-capitalize">
              {{ $competition['team']['leader_institution'] }}
            </span>
          </div>

          <div class="row justify-content-center">
            @php
            $code = $competition['team']['code'];
            $slug = $competition['slug'];
            @endphp

            @if($competition['program_team']['file_stage_1'] != null)
            <x-buttons.outlined-button type="button" label="Edit Member"
              onclick="location.href = '/dashboard/{{ $slug }}/{{ $code }}/edit'" disabled />
            @else
            <x-buttons.outlined-button type="button" label="Edit Member"
              onclick="location.href = '/dashboard/{{ $slug }}/{{ $code }}/edit'" />
            @endif

          </div>
        </div>

        @endif

      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/custom/stepper.js') }}"></script>
<script>
  var countDown = new Date("{{ $competition['stage_1_close_registration'] }}").getTime();
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDown - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    var textDays = document.getElementById("days");
    var textHours = document.getElementById("hours");
    var textMinutes = document.getElementById("minutes");
    var textSeconds = document.getElementById("seconds");
    
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