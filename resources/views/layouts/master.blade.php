<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo/inspace-logo.webp') }}">
  <title>{{ Request::is('/') ? 'INSPACE 2022' : $title . ' - INSPACE 2022' }} </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="INSPACE 2022 mengangkat tema “Bangkit Perkasa Wujudkan Transformasi Ekosistem Digital
  Guna Mengoptimalkan Penyelenggaraan Presidensi G20 di Indonesia”, yang dimana rangkaian
  dari kegiatan INSPACE ini terdapat lomba yang berupa Poster Competition, UI/UX
  Competition, Business Plan Competition (BPC), Animasi Digital Competition, dan Talkshow
  yang akan menjadi acara puncak sekaligus acara penutup dari INSPACE ini, Peran pemuda
  dapat mendorong dan mewujudkan untuk mewujudkan transformasi ekosistem digital di
  Indonesia. ">
  <meta name="keywords" content="inspace">
  <meta name="author" content="sistem informasi">


  <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->

  <!-- Filepond -->
  <link rel="stylesheet"
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

  <!-- CSS Files
    ================================================== -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/jpreloader.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/plugin.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.transitions.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/jquery.countdown.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/twentytwenty.css') }}" type="text/css">

  <!-- custom background -->
  <link rel="stylesheet" href="{{ asset('css/bg.css') }}" type="text/css">

  <!-- color scheme -->
  <link rel="stylesheet" href="{{ asset('css/colors/magenta.css') }}" type="text/css" id="colors">
  <link rel="stylesheet" href="{{ asset('css/color.css') }}" type="text/css">

  <!-- load fonts -->
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('fonts/elegant_font/HTML_CSS/style.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('fonts/et-line-font/style.css') }}" type="text/css">

  <!-- custom font -->
  <link rel="stylesheet" href="{{ asset('css/font-style.css') }}" type="text/css">

  @stack('styles')
</head>

<body id="homepage">

  <div id="wrapper">

    @include('partials.header')

    <!-- content begin -->
    <div id="content" class="no-bottom no-top">

      @yield('content')

      @include('partials.footer')
    </div>
  </div>


  <div id="de-extra-wrap" class="de_light">
    <span id="b-menu-close">
      <span></span>
      <span></span>
    </span>
    <div class="de-extra-content">
      <h3>Information</h3>
      <p>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
        aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
      </p>

      <div class="spacer10"></div>

      <div class="p-4 border">
        <div class="text-center">
          <h1>485 of 1000</h1>
          <p>Seats available</p>
          <a href="#section-ticket" class="btn-custom btn-fullwidth text-white scroll-to">Get Your Ticket</a>
        </div>
      </div>

      <div class="spacer-single"></div>

      <h3>Where &amp; When?</h3>
      <div class="h6 padding10 pt0 pb0"><i class="i_h3 fa fa-calendar-check-o id-color"></i>March 20th to 25th</div>
      <div class="h6 padding10 pt0 pb0"><i class="i_h3 fa fa-map-marker id-color"></i>Palo Alto, California</div>
      <div class="h6 padding10 pt0 pb0"><i class="i_h3 fa fa-phone id-color"></i>1 200 300 9000</div>
      <div class="h6 padding10 pt0 pb0"><i class="i_h3 fa fa-envelope-o id-color"></i>info@exhibiztheme.com</div>
    </div>
  </div>
  <div id="de-overlay"></div>

  <!-- Javascript Files
    ================================================== -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jpreLoader.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
  <script src="{{ asset('js/easing.js') }}"></script>
  <script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
  <script src="{{ asset('js/jquery.scrollto.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.js') }}"></script>
  <script src="{{ asset('js/jquery.countTo.js') }}"></script>
  <script src="{{ asset('js/video.resize.js') }}"></script>
  <script src="{{ asset('js/validation.js') }}"></script>
  <script src="{{ asset('js/wow.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/enquire.min.js') }}"></script>
  <script src="{{ asset('js/designesia.js') }}"></script>
  <script src="{{ asset('js/jquery.event.move.js') }}"></script>
  <script src="{{ asset('js/jquery.plugin.js') }}"></script>
  <script src="{{ asset('js/jquery.countdown.js') }}"></script>
  <script src="{{ asset('js/countdown-custom.js') }}"></script>
  <script src="{{ asset('js/jquery.twentytwenty.js') }}"></script>

  <!-- Filepond -->
  <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
  </script>
  <script
    src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js">
  </script>
  <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

  @stack('scripts')

  <script>
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
  </script>


</body>

</html>
