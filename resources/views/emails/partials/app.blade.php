<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('emails.partials.head')

<body>
    <div class="wrapper" style="direction: rtl; text-align: right;">
        <div class="inner-body">

            @yield('containt')

            <div class="divider"></div>
            @include('emails.partials.footer')
        </div>
    </div>
</body>


</html>