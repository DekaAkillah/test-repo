@extends('layouts.master')

@push('styles')
<!-- RS5.0 Stylesheet -->
<link rel="stylesheet" href="{{ asset('revolution/css/settings.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('revolution/css/layers.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('revolution/css/navigation.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/rev-settings.css') }}" type="text/css">
@endpush

@section('content')

@include('homepage.sections.hero')
@include('homepage.sections.countdown')
@include('homepage.sections.about')
@include('homepage.sections.competitions')
@include('homepage.sections.talkshow')
@include('homepage.sections.galleries')
@include('homepage.sections.cta')
<!-- @include('homepage.sections.fun-facts') -->
@include('homepage.sections.faq')
@include('homepage.sections.medparts')
{{-- @include('homepage.sections.tickets') --}}

@endsection

@push('scripts')
<!-- RS5.0 Core JS Files -->
<script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js?rev=5.0') }}"></script>
<script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js?rev=5.0') }}"></script>

<!-- RS5.0 Extensions Files -->
<script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>

<script>
  jQuery(document).ready(function() {
      // revolution slider
      jQuery("#slider-revolution").revolution({
          sliderType: "standard",
          sliderLayout: "fullwidth",
          delay: 5000,
          navigation: {
              arrows: {
                  enable: true
              },
              bullets: {
                  enable: false,
                  style: 'hermes'
              },

          },
          parallax: {
              type: "mouse",
              origo: "slidercenter",
              speed: 2000,
              levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
          },
          spinner: "off",
          gridwidth: 1140,
          gridheight: 700,
          disableProgressBar: "on"
      });
    });
</script>
@endpush
