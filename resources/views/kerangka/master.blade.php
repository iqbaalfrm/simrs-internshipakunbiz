<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('include.style')
    @yield('css')

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        #app {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .footer-fixed {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: left;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('include.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div> 
            @yield('content')
        </div>
        <footer class="footer-fixed">
            @include('include.footer')
        </footer>
    </div>
    @include('include.script')
    @yield('js')
</body>

</html>
