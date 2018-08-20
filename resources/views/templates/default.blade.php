<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body >
<div class="">

    <header class="">
        @include('includes.header')
    </header>

    <div id="main" class="">

            @yield('content')

    </div>

    <footer class="">
        @include('includes.footer')
    </footer>
</div>
        @include('includes.modalAdd')

</body>
</html>