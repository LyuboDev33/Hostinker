<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="xHosting - Web Hosting HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    @yield('SEO')

    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/aos.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
    integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

       <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">

    <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>

    <script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>


</head>

<body>

    <!--Preloader-->
    {{-- <div id="preloader">
        <div class="loader"></div>
    </div> --}}
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-chevron-up"></i>
    </button>
    <!-- Scroll-top-end-->

    @include('layouts.partials.frontend.header')

    <!-- main-area -->
    <main class="main-area fix">

        {{ $slot }}

    </main>
    <!-- main-area-end -->

    @include('layouts.partials.frontend.footer')



    <!-- JS here -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
           initializeFancybox();
            initializeLenis();
            initializeTestimonialSplide();
        });

        function initializeLenis() {

            const lenis = new Lenis({
                duration: 1,
                smoothWheel: true,
                wheelMultiplier: 0.8,
                touchMultiplier: 0.8,
                lerp: 0.5
            });

            function lenisAnimationFrame(time) {
                lenis.raf(time);
                requestAnimationFrame(lenisAnimationFrame);
            }

            requestAnimationFrame(lenisAnimationFrame);
        }

          function initializeTestimonialSplide() {
            const testimonialSplide = document.getElementById('testimonialSplide');

            if (!testimonialSplide) {
                return;
            }

            if (typeof Splide === 'undefined') {
                return;
            }

            new Splide(testimonialSplide, {
                type: 'loop',
                perPage: 1,
                perMove: 1,
                gap: '20px',
                arrows: true,
                pagination: true,
                autoplay: false,
                interval: 5000,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 800
            }).mount();
        }

               function initializeFancybox() {
            if (typeof Fancybox === 'undefined') {
                return;
            }

            const fancyboxElements = document.querySelectorAll('[data-fancybox]');

            if (!fancyboxElements.length) {
                return;
            }

            Fancybox.bind('[data-fancybox]', {});
        }


    </script>
</body>

</html>
