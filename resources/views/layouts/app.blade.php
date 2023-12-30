<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if (env('IS_DEMO'))
        <x-demo-metas></x-demo-metas>
    @endif

    <link rel="apple-touch-icon" sizes="76x76" hreff="{{  asset('/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{  asset('/assets/img/favicon.png')}}">
    <title>
        Ekosfera
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{  asset('/assets/css/nucleo-icons.css" rel="stylesheet')}}" />
    <link href="{{  asset('/assets/css/nucleo-svg.css" rel="stylesheet')}}" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
   
    @auth
        @yield('auth')
    @endauth
    @guest
        @yield('guest')
    @endguest
    
    <!--   Core JS Files   -->
    <script src="{{  asset('/assets/js/core/popper.min.js')}}"></script>
    <script src="{{  asset('/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{  asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{  asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{  asset('/assets/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{  asset('/assets/js/plugins/chartjs.min.js')}}"></script>
    <script src="{{  asset('js/app.js') }}"></script>
    <script src="{{  mix('js/app.js') }}"></script>

    <script src="{{ asset('sw.js') }}"></script>
    @stack('dashboard')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
            damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        setTimeout(function() {
            var errorAlert = document.getElementById('alert');
            if (errorAlert) {
                errorAlert.classList.add('fade-out');
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 500); // Adjust the duration of the fade-out animation
            }
        }, 7000);
</script>
   {{-- <script>
    if ('Notification' in window) {
        Notification.requestPermission().then(function (permission) {
            if (permission === 'granted') {
                // Notification permission granted; you can now show notifications.
                // navigator.serviceWorker.ready.then((sw) => {
                //     sw.pushManager.subscribe({
                //         userVisibleOnly: true, // Use a comma, not a semicolon
                //         applicationServerKey: "BC5zel9Joqe0Y2yVTJjDhiElIisJTVHq-_p4rxC3zd60gQSqXzra_7_m7B12axwI42tZIUXYGXhIJ-t5MolKjNY"
                //     }).then((subscription) => {
                    //         // subscription successful
                    //         fetch("/api/push-notification", {
                        //             method: "post",
                        //             body: JSON.stringify(subscription)
                        //         }).then(()); // Alert should be inside a function
                //     });
                // });
            }
        });
    }
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js')
        .then(function (registration) {
            console.log('Service Worker registered with scope:', registration.scope);
        })
        .catch(function (error) {
            console.error('Service Worker registration failed:', error);
        });
    }
    </script> --}}
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{  asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
</body>
</html>
