@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/items.css') }}">
@endpush

<div class="d-flex justify-content-between align-items-center mb-1 member-item-small">
    <span class="h5 font-weight-normal text-uppercase">{{ $name }}</span>

    {{-- <div class="x-button" onclick="alert('Remove this person with id {{ $id }} from the team?')">
        <i class="far fa-times-circle mr-4" style="color: #EC167F"></i>
    </div> --}}
</div>