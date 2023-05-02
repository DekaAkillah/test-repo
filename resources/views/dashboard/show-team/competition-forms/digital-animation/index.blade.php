<div class="col">
  {{-- Stepper --}}
  <div class="row">
    <div class="col-12 col-lg-12 ml-auto mr-auto mb-4">
      <div class="multisteps-form__progress">
        <button class="multisteps-form__progress-btn {{ $competition['stage']['index'] >= 0 ? 'js-active' : '' }}" type="button"
          title="payment">
          payment
        </button>
        <button class="multisteps-form__progress-btn {{ $competition['stage']['index'] >= 1 ? 'js-active' : '' }}" type="button"
          title="stage 1">
          stage 1
        </button>
      </div>
    </div>
  </div>

  <div class="col mt-4">
    @if($competition['stage']['index'] == 0)

    @include('dashboard.show-team.universal-forms.payment')

    @elseif($competition['stage']['index'] == 1)

    @include('dashboard.show-team.competition-forms.digital-animation.stages.biodata')

    @endif
  </div>

</div>