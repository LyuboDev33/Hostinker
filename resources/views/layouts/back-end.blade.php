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

        <link rel="stylesheet" href="/assets/css/custom.css?v=<?= time() ?>">


    <!-- jQuery -->
    <script src="/assets/js/vendor/jquery-3.6.0.min.js?v=<?= time() ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


    <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>

    <script src="https://cdn.tiny.cloud/1/oy49mrh99x9qochiaeatx6s93oogkmooakygczsvo87c3905/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

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
            initDashboardDropdown();
            initSidebarToggle();
            initDashboardDropdowns();
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

        function initDashboardDropdown() {
            const submenuTriggers = document.querySelectorAll('[data-sidebar-submenu]');

            submenuTriggers.forEach((trigger) => {
                trigger.addEventListener('click', function() {
                    const menuItem = this.closest('.dashboard-sidebar__item-has-children');

                    menuItem.classList.toggle('is-open');
                });
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

        function initDashboardDropdowns() {
            const dropdowns = document.querySelectorAll('.dashboard-dropdown');

            dropdowns.forEach((dropdown) => {
                const toggle = dropdown.querySelector('[data-dropdown-toggle]');

                if (!toggle) {
                    return;
                }

                toggle.addEventListener('click', function() {
                    dropdown.classList.toggle('is-open');
                });
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
