<!-- header begin -->
<header class="transparent">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- logo begin -->
        <div id="logo">
          <a href="/">
            <img class="logo" src="{{ asset('img/logo/inspace_noyear.webp') }}" style="width: 5em" alt="">
          </a>
        </div>
        <!-- logo close -->

        <!-- small button begin -->
        <span id="menu-btn"></span>
        <!-- small button close -->

        <!-- <div class="header-extra">
          <div class="v-center">
            <span id="b-menu">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </div>
        </div> -->

        <!-- mainmenu begin -->
        <ul id="mainmenu" class="ms-2">
          <li>
            <a href="{{ \Request::is('/') ? '#section-hero' : url('/#section-hero')}}">
              Home
              <span></span>
            </a>
          </li>
          <li>
            <a href="{{ \Request::is('/') ? '#section-competitions' : url('/#section-competitions')}}">
              Competitions<span></span>
            </a>
          </li>
          <li>
            <a href="{{ \Request::is('/') ? '#section-talkshow' : url('/#section-talkshow')}}">
              Talkshow<span></span>
            </a>
          </li>
          <li>
            <a href="{{ \Request::is('/') ? '#section-about' : url('/#section-about')}}">
              About<span></span>
            </a>
          </li>
          @guest
          <li>
            <a href="{{ route('login') }}">
              Login<span></span>
            </a>
          </li>
          @else
          <li>
            <a href="{{ route('dashboard.index') }}">
              Dashboard<span></span>
            </a>
          </li>
          <li>
            <a href="#" onclick="document.getElementById('logout').submit();">
              Logout<span></span>
            </a>

            <form action="{{ route('logout') }}" method="post" id="logout">
              @csrf
            </form>
          </li>
          @endguest
        </ul>
        <!-- mainmenu close -->



      </div>


    </div>
  </div>
</header>
<!-- header close -->