<div class="col">
  {{-- Stepper --}}
  <div class="row">
    <div class="col-12 col-lg-12 ml-auto mr-auto mb-4">
      <div class="multisteps-form__progress">
        <button class="multisteps-form__progress-btn {{ $stage >= 0 ? 'js-active' : '' }}" type="button"
          title="payment">
          payment
        </button>
        <button class="multisteps-form__progress-btn {{ $stage >= 1 ? 'js-active' : '' }}" type="button"
          title="stage 1">
          stage 1
        </button>
        <button class="multisteps-form__progress-btn {{ $stage >= 2 ? 'js-active' : '' }}" type="button"
          title="technical meeting">
          tech. meeting
        </button>
        <button class="multisteps-form__progress-btn {{ $stage >= 3 ? 'js-active' : '' }}" type="button"
          title="stage 2">
          stage 2
        </button>
        <button class="multisteps-form__progress-btn {{ $stage >= 4 ? 'js-active' : '' }}" type="button"
          title="announcement">
          final day
        </button>
      </div>
    </div>
  </div>

  <div class="col mt-4">
    @if($competition['stage']['index'] == 0)

    @include('dashboard.show-team.universal-forms.payment')

    @elseif($competition['stage']['index'] == 1)

    @include('dashboard.show-team.competition-forms.ui-ux.stages.biodata')

    @elseif($competition['stage']['index'] == 2)

    @include('dashboard.show-team.universal-forms.technical-meeting')

    @elseif($competition['stage']['index'] == 3)

    @include('dashboard.show-team.competition-forms.ui-ux.stages.docs')

    @else

    @include('dashboard.show-team.universal-forms.announcement')

    @endif
  </div>

</div>
