@once
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/components/input.css') }}" type="text/css">
@endpush
@endonce

<input {{ $attributes->merge(['class' => 'form-control c-input-stroke']) }}
placeholder="{{ $placeholder }}" />