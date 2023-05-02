@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/button.css') }}" type="text/css">
@endpush
@endonce

<button {{ $attributes->merge(['class' => 'c-btn-gradient-filled px-4 text-uppercase']) }}>
    <i class="fa fa-download mr-2"></i>
    {{ $label }}
</button>