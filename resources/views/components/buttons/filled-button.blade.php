@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/button.css') }}" type="text/css">
@endpush
@endonce

<button {{ $attributes->merge(['class' => 'c-btn-filled px-4 text-uppercase']) }}>
    {{ $label }}
</button>