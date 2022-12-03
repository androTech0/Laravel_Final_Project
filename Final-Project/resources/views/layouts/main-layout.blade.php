<!DOCTYPE html>
<html lang="en">

<head>
    @yield('page-title')
    @include('layouts.main-block.header')
    @yield('stylesheet')
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    @include('layouts.main-block.preloader')
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ URL('/index') }}" class="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
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

    <!-- ***** Content Area Start ***** -->
    @yield('content')

    @include('layouts.main-block.footer')
    <!-- ***** Content Area End ***** -->

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    @include('layouts.main-block.scripts')
    @yield('script')
</body>

</html>
