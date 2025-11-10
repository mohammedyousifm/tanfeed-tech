<!DOCTYPE html>
<html lang="en" dir="rtl">

@include('front.partials.head')

<body class="overflow-x-hidden">



    @include('dashboard.partials.errors')
    @yield('Content')


    @include('front.partials.footer')

</body>

</html>
