@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/modal.css') }}" type="text/css">
@endpush
@endonce

<div class="modal fade" id="show-{{ $id }}" class="showProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content b-none">
      <div class="modal-body rounded">
        <div class="container-fluid text-center py-4">
          <img src="{{ asset($avatar) }}" alt="avatar" class="border border-4 rounded-circle"
            style="max-width: 150px; border-color: #EC167F">

          <div class="col p-0 mt-4 mb-5 text-center">
            <span class="text-uppercase h3 mb-2">{{ $name }}</span> <br>
            <span class="text-uppercase text-grey">{{ $major }} - {{ $institution }}</span>
          </div>

          <div class="row justify-content-center mt-5">
            <x-buttons.outlined-button label="close profile" data-dismiss="modal" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>