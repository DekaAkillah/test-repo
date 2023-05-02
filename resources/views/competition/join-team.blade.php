@extends('layouts.master')

@section('content')
<section>
  <div class="container-sm border border-dark rounded py-3 px-4" style="width: 35%">
    <div class="row justify-content-center">
      <span class="h4 text-white">Join Existing Team</span>
    </div>

    <form action="{{ route('competition.join-team-result', $program->slug) }}" method="post">
      @csrf
      <div class="form-group my-5">
        <x-inputs.outlined-input class="code" placeholder="Enter team code" name="code" maxlength="6" />
        <small class="text-muted">No idea what the code is? Ask the team member</small>
      </div>

      <div class="d-flex flex-row-reverse">
        <x-buttons.outlined-button label="find" />
      </div>
    </form>
  </div>
</section>
@endsection