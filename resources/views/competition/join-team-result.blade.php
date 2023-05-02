@extends('layouts.master')

@section('content')

<section>
  @if($found && $isAvailable)

  <div class="container-lg border border-dark rounded py-4 text-center" style="width: 35%">
    <div class="col">
      <span class="h4 text-white">Team Found</span>

      <div class="mt-4">
        <img class="img-fluid rounded-circle w-25" src="{{ asset('avatar/team-one.png') }}" alt="team avatar"
          style="border: 4px solid white">
      </div>
    </div>

    <div class="d-flex flex-column mt-3 mb-5">
      <span class="h4 text-white m-0 p-0">{{ $team->name }}</span>
      <small>Led by {{ $team->user->name }} - <span class="text-success"> {{ $available }} slots
          available</span></small>
      <span class="h5 font-weight-normal mt-4">
        Complete the roster by joining the team!
      </span>
    </div>

    <div class="d-flex flex-column align-items-center">
      <form action="{{ route('join-team') }}" method="post">
        @csrf
        <input type="hidden" name="teamId" value="{{ $team->id }}">
        <x-buttons.outlined-button class="mb-3" label="join" />
      </form>
      <x-buttons.text-button label="back" />
    </div>
  </div>

  @elseif($found && !$isAvailable)

  <div class="container-lg border border-dark rounded py-4 text-center" style="width: 35%">
    <div class="col">
      <span class="h4 text-white">Team Full</span>

      <div class="mt-4">
        <img class="img-fluid rounded-circle w-25" src="{{ asset('img/logo/inspace_noyear.webp') }}" alt="team avatar"
          style="border: 4px solid white">
      </div>
    </div>

    <div class="d-flex flex-column mt-3 mb-5">
      <span class="h4 text-white m-0 p-0">{{ $team->name }}</span>
      <small>Led by {{ $team->user->name }} - <span class="text-danger"> 0 slot available</span></small>
      <span class="h5 font-weight-normal mt-4">
        The roster is complete. You may join
        another team or create your own team instead!
      </span>
    </div>

    <div class="d-flex flex-column align-items-center">
      <x-buttons.outlined-button class="mb-3" onClick="location.href='{{ route('competition.store-team', $slug) }}'"
        label="create my own team" />
      <x-buttons.text-button label="back" />
    </div>
  </div>

  @else

  <div class="container-lg border border-dark rounded py-4 text-center" style="width: 35%">
    <div class="col">
      <span class="h4 text-white">Team Not Found</span>

      <div class="mt-4">
        <img class="img-fluid rounded-circle w-25" src="{{ asset('avatar/team-one.png') }}" alt="team avatar"
          style="border: 4px solid white">
      </div>
    </div>

    <div class="d-flex flex-column mt-3 mb-5">
      <span class="h5 font-weight-normal mt-4">
        The team with the corresponding code
        doesnt exist! Recheck the code
        or create your own team instead!
      </span>
    </div>

    <div class="d-flex flex-column align-items-center">
      <x-buttons.outlined-button class="mb-3" onClick="location.href='{{ route('competition.store-team', $slug) }}'"
        label="create my own team" />
      <x-buttons.text-button label="back" onclick="history.back()" />
    </div>
  </div>

  @endif

</section>
@endsection