@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/modal.css') }}" type="text/css">
@endpush
@endonce

<div class="modal fade" id="warningModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content b-none">
      <div class="modal-body rounded">
        <div class="modal-header b-none">
          <h5 class="modal-title" id="warningModalLabel">
            <i class="fa fa-exclamation-triangle mr-2"></i>
            {{ $title }}
          </h5>
        </div>
        <div class="modal-body">
          {{ $message }}
        </div>
        <div class="modal-footer b-none">
          <x-buttons.text-button label="{{ $secondaryLabel }}" onclick="{{ $secondaryAction }}" data-dismiss="modal" />

          @if($usePrimaryButton == "true")

          <x-buttons.outlined-button label="{{ $primaryLabel }}"
            onclick="window.open('{{ $primaryAction }}', '_self')" />

          @endif
        </div>
      </div>
    </div>
  </div>
</div>
