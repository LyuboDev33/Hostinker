<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('SEO')

    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png">


    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css?v=<?= time() ?>">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.23/dist/lenis.css">

      <!-- color -->
    <link rel="stylesheet" href="/assets/css/dashboard.css?v=<?= time() ?>">

    <link rel="stylesheet" href="/assets/css/main.css?v=<?= time() ?>">


    <!-- jQuery -->
    <script src="/assets/js/vendor/jquery-3.6.0.min.js?v=<?= time() ?>"></script>



    <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>
</head>

<body>


    <div class="dashboard-shell">

        @include('layouts.partials.backend.sidebar')

        <div class="dashboard-main">

            @include('layouts.partials.backend.header')

            <main id="content" class="dashboard-content shadow">
                {{ $slot }}
            </main>

        </div>

    </div>




    <!-- bootstrap -->
    <script src="/assets/js/bootstrap.min.js?v=<?= time() ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeFancybox();
            initializeLenis();
            initDashboardDropdown();
            initSidebarToggle();
        });

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


        function initDashboardDropdown() {
            document.addEventListener('click', function(e) {
                const trigger = e.target.closest('[data-dropdown-toggle]');
                const openDropdown = document.querySelector('.dashboard-dropdown.is-open');

                if (trigger) {
                    const dropdown = trigger.closest('.dashboard-dropdown');

                    if (openDropdown && openDropdown !== dropdown) {
                        openDropdown.classList.remove('is-open');
                    }

                    dropdown.classList.toggle('is-open');
                    e.stopPropagation();

                    return;
                }

                if (openDropdown && !e.target.closest('.dashboard-dropdown')) {
                    openDropdown.classList.remove('is-open');
                }
            });
        }

        function initSidebarToggle() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('[data-sidebar-toggle]')) {
                    document.body.classList.toggle('sidebar-open');
                }

                if (
                    e.target.closest('[data-sidebar-close]') ||
                    (
                        document.body.classList.contains('sidebar-open') &&
                        !e.target.closest('.dashboard-sidebar') &&
                        !e.target.closest('[data-sidebar-toggle]')
                    )
                ) {
                    document.body.classList.remove('sidebar-open');
                }
            });
        }


        function initTinyMce() {
            tinymce.init({
                selector: 'textarea',
                plugins: [
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media',
                    'searchreplace', 'table', 'visualblocks', 'wordcount',
                ],
                toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [{
                        value: 'First.Name',
                        title: 'First Name'
                    },
                    {
                        value: 'Email',
                        title: 'Email'
                    },
                ],
            });
        }
    </script>

</body>

</html>
