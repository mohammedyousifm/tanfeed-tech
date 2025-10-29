<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('front.partials.head')


<body class="overflow-x-hidden">


    @include('front.partials.hero')

    @include('front.partials.about')

    @include('front.partials.services')

    @include('front.partials.our-client')

    @include('front.partials.testimonials')

    @include('front.partials.contact')

    @include('front.partials.footer')


    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Fallback background if video fails to load
        const video = document.getElementById('heroVideo');
        video.addEventListener('error', function () {
            document.querySelector('.video-container').style.background = 'linear-gradient(135deg, #1a2a3a, #2a3a4a)';
        });
    </script>
</body>

</html>
