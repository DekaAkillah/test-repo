@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/button.css') }}" type="text/css">
@endpush
@endonce

<button {{ $attributes->merge(['class' => 'c-btn-join-filled px-4 text-uppercase']) }}>
    <i class="fab fa-whatsapp mr-2" style="color: rgb(107, 228, 107)"></i>
    {{ $label }}
</button>