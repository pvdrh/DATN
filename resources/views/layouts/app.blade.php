<!DOCTYPE html>

@if (\Request::is('rtl'))
    <html dir="rtl" lang="ar">
    @else
        <html lang="en">
        @endif

        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            @if (env('IS_DEMO'))
                <x-demo-metas></x-demo-metas>
            @endif

            <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
            <link rel="icon" type="image/png"
                  href="https://media.istockphoto.com/id/1331186720/vector/dumbbell.jpg?s=612x612&w=0&k=20&c=ztAKf6ZaSrWTBQVW7Nj2yrEbGM0FxitFrze39W-HdMs=">
            <title>@yield('title', 'Hệ thống quản lý phòng GYM')</title>

            <!--     Fonts and icons     -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
            <!-- Nucleo Icons -->
            <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
            <!-- Font Awesome Icons -->
            <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
            <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
            <!-- CSS Files -->
            <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet"/>
            <link id="style" href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                  crossorigin="anonymous">
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </head>

        <body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
        @auth
            @yield('auth')
        @endauth
        @guest
            @yield('guest')
        @endguest

        @if(session()->has('success'))
            <div x-data="{ show: true}"
                 x-init="setTimeout(() => show = false, 4000)"
                 x-show="show"
                 class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
                <p class="m-0">{{ session('success')}}</p>
            </div>
        @endif
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        @stack('rtl')
        @stack('dashboard')
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
        </body>

        </html>
