<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.Landing.meta')

    <title>@yield('title') | SERV</title>

    @stack('before-style')

    @include('includes.Landing.style')

    @stack('after-style')
</head>
<body class="antialiased">

    <div class="relative">
        @include('includes.Landing.header')

        @yield('content')

        @include('includes.Landing.footer')
    </div>


    @stack('before-script')

    @include('includes.Landing.script')

    @stack('after-script')


    {{-- //Modal --}}

    @include('components.Modal.login')
    @include('components.Modal.register')
    @include('components.Modal.register-success')
</body>
</html>
