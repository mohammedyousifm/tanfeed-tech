<section class="py-16 px-4  relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <!-- Title -->
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                من عملائنا
            </h2>
            <div class="w-24 h-1 bg-[#e2d392] mx-auto"></div>
        </div>

        <!-- Logos Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5" id="logoGrid">
            <!-- Logo 1 -->
            <div class="logo-item flex items-center justify-center p-2   transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png" width="200"
                    alt="نقطة ويب " width="200">
            </div>

            <!-- Logo 2 -->
            <div class="logo-item flex items-center justify-center p-2  transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png" alt="نظام آجل"
                    width="200">
            </div>

            <!-- Logo 3 -->
            <div class="logo-item flex items-center justify-center p-2 transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png" alt=" وزارة الصحة"
                    width="200">
            </div>

            <!-- Logo 4 -->
            <div class="logo-item flex items-center justify-center p-2 transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png" alt="Study Group"
                    width="200">
            </div>

            <!-- Logo 5 -->
            <div class="logo-item flex items-center justify-center p-2    transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png"
                    alt=" وزارة البيئة والمياه والزراعة" width="200">
            </div>

            <!-- Logo 6 -->
            <div class="logo-item flex items-center justify-center p-2    transition-shadow">
                <img src="https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png" alt="المملكة"
                    width="200">
            </div>
        </div>

        <!-- Navigation Dots -->
        <div class="flex justify-center mt-12 gap-2" id="dots">
            <button class="dot w-3 h-3 rounded-full bg-blue-600 transition-all" data-index="0"></button>
            <button class="dot w-3 h-3 rounded-full bg-gray-300 transition-all" data-index="1"></button>
        </div>
    </div>
</section>

<style>
    .logo-item {
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }

    .logo-fade-out {
        opacity: 0;
        transform: scale(0.95);
    }

    .logo-fade-in {
        opacity: 1;
        transform: scale(1);
    }
</style>

<script>
    // All logos data (you can replace these with your actual logo URLs)
    const allLogos = [
        // Set 1
        [
            { src: 'https://via.placeholder.com/200x80/4A5568/FFFFFF?text=HRDA', alt: 'هيئة تطوير منطقة المدينة المنورة' },
            { src: 'https://via.placeholder.com/200x80/10B981/FFFFFF?text=Customs', alt: 'الجمارك السعودية' },
            { src: 'https://via.placeholder.com/200x80/059669/FFFFFF?text=MOH', alt: 'وزارة الصحة' },
            { src: 'https://via.placeholder.com/200x80/EF4444/FFFFFF?text=Study+Group', alt: 'Study Group' },
            { src: 'https://via.placeholder.com/200x80/8B5CF6/FFFFFF?text=Ministry', alt: 'وزارة البيئة والمياه والزراعة' },
            { src: 'https://via.placeholder.com/200x80/047857/FFFFFF?text=Kingdom', alt: 'المملكة' }
        ],
        // Set 2 (you can add more clients here)
        [
            { src: 'https://ajlapp.com/images/logoajil2.png', alt: 'عميل 7' },
            { src: 'https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png"', alt: 'عميل 8' },
            { src: 'https://ajlapp.com/images/logoajil2.png', alt: 'عميل 9' },
            { src: 'https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png"', alt: 'عميل 10' },
            { src: 'https://ajlapp.com/images/logoajil2.png', alt: 'عميل 11' },
            { src: 'https://nuqtahweb.com/wp-content/themes/nuqtahweb/assets/img/logo-ng.png"', alt: 'عميل 12' }
        ]
    ];

    // let currentSet = 0;
    // const logoGrid = document.getElementById('logoGrid');
    // const dots = document.querySelectorAll('.dot');

    // function updateLogos(newSet) {
    //     const logoItems = document.querySelectorAll('.logo-item');

    //     // Fade out
    //     logoItems.forEach(item => {
    //         item.classList.add('logo-fade-out');
    //     });

    //     // Wait for fade out, then update content
    //     setTimeout(() => {
    //         const logos = allLogos[newSet];
    //         logoItems.forEach((item, index) => {
    //             const img = item.querySelector('img');
    //             img.src = logos[index].src;
    //             img.alt = logos[index].alt;
    //         });

    //         // Fade in
    //         setTimeout(() => {
    //             logoItems.forEach(item => {
    //                 item.classList.remove('logo-fade-out');
    //                 item.classList.add('logo-fade-in');
    //             });
    //         }, 50);
    //     }, 500);

    //     // Update dots
    //     dots.forEach((dot, index) => {
    //         if (index === newSet) {
    //             dot.classList.remove('bg-gray-300', 'w-3');
    //             dot.classList.add('bg-blue-600', 'w-8');
    //         } else {
    //             dot.classList.remove('bg-blue-600', 'w-8');
    //             dot.classList.add('bg-gray-300', 'w-3');
    //         }
    //     });

    //     currentSet = newSet;
    // }

    // // Auto-rotate logos every 5 seconds
    // setInterval(() => {
    //     const nextSet = (currentSet + 1) % allLogos.length;
    //     updateLogos(nextSet);
    // }, 5000);

    // // Manual navigation
    // dots.forEach(dot => {
    //     dot.addEventListener('click', () => {
    //         const index = parseInt(dot.getAttribute('data-index'));
    //         updateLogos(index);
    //     });
    // });
</script>
