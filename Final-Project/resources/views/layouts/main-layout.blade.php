<!DOCTYPE html>
<html lang="en">
  <head>
    @yield('page-title')
    @include('layouts\header')
    @yield('stylesheet')
  </head>
<body>

   <!-- ***** Preloader Start ***** -->
  @include('layouts\preloader')
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{URL('/index')}}" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    @yield('top-menu')
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  @yield('content')
{{--
  <!-- ***** Main Banner Area Start ***** -->
  @include('layouts/main-banner')
  <!-- ***** Main Banner Area End ***** -->

  @include('layouts/categories')

  @include('layouts/create-banner')

  @include('layouts/currently-market')--}}

  @include('layouts\footer')
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  @include('layouts\scripts')
  @yield('script')
  </body>
</html>
