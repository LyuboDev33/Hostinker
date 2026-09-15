<x-backend>

    @section('SEO')
        <title>{{ $website->domain_name }} - Dashboard</title>
    @endsection


    <section class="website-dashboard">

        <div class="container">


            {{-- BREADCRUMBS --}}
            <div class="website-dashboard__breadcrumbs">

                <a href="#">
                    <i class="fa-solid fa-house"></i>
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <a href="#">
                    Уебсайтове
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <span>{{ $website->domain_name }}</span>

            </div>


          {{-- WEBSITE OVERVIEW --}}
            <div class="website-dashboard__website-card">

                <div class="website-dashboard__website-top">

                    <div class="website-dashboard__website-info">

                        <div class="website-dashboard__website-icon">
                            <i class="fa-solid fa-code"></i>
                        </div>


                        <div>

                            <div class="website-dashboard__domain">

                                <strong>
                                    {{ $website->domain_name }}
                                </strong>

                                <a
                                    href="https://{{ $website->domain_name }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>

                            </div>


                            <span class="website-dashboard__created">
                                Създаден:
                                {{ $website->created_at?->format('d.m.Y') }}
                            </span>

                        </div>

                    </div>


                    <div class="website-dashboard__website-status">

                        <span class="website-status website-status--success">
                            <i class="fa-solid fa-circle-check"></i>
                            Активен
                        </span>

                    </div>

                </div>



                <div class="website-dashboard__website-bottom">

                    <div class="website-dashboard__quick-actions">

                        <a href="#" class="website-outline-btn">
                            <i class="fa-solid fa-globe"></i>
                            Управление на домейн
                        </a>

                        <a href="#" class="website-outline-btn">
                            <i class="fa-regular fa-envelope"></i>
                            Имейли
                        </a>

                    </div>


                    <div class="website-dashboard__badges">

                        <span class="website-badge website-badge--success">
                            <i class="fa-solid fa-circle-check"></i>
                            SSL
                        </span>

                        <span class="website-badge website-badge--success">
                            <i class="fa-solid fa-circle-check"></i>
                            Сайтът работи
                        </span>

                    </div>

                </div>

            </div>



            {{-- MAIN DASHBOARD GRID --}}
            <div class="website-dashboard__grid">


                {{-- LEFT SIDE --}}
                <div class="website-dashboard__left">


                    {{-- ESSENTIALS --}}
                    <div class="website-dashboard-card">

                        <div class="website-dashboard-card__header">
                            <h4>Основни инструменти</h4>
                        </div>


                        <div class="website-dashboard-tools">


                            {{-- DATABASE --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-solid fa-database"></i>
                                    </div>


                                    <div>
                                        <h5>Бази данни</h5>

                                        <p>
                                            Създаване и управление на MySQL бази данни
                                        </p>
                                    </div>

                                </div>


                                <a href="#" class="website-outline-btn website-outline-btn--small">
                                    Управление
                                </a>

                            </div>



                            {{-- PHPMYADMIN --}}


                            {{-- BACKUPS --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </div>


                                    <div>
                                        <h5>Архиви</h5>

                                        <p>
                                            Резервни копия на файлове и бази данни
                                        </p>
                                    </div>

                                </div>


                                <a href="#" class="website-dashboard-tool__arrow">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>

                            </div>



                            {{-- FILE MANAGER --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-regular fa-folder"></i>
                                    </div>


                                    <div>
                                        <h5>Файлов мениджър</h5>

                                        <p>
                                            Управлявайте файловете в public_html
                                        </p>
                                    </div>

                                </div>


                                <a href="" class="website-outline-btn website-outline-btn--small">
                                    Отвори

                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>

                            </div>



                            {{-- GIT --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-brands fa-git-alt"></i>
                                    </div>


                                    <div>
                                        <h5>Git</h5>

                                        <p>
                                            Управлявайте Git repository и deployment
                                        </p>
                                    </div>

                                </div>


                                <a href="#" class="website-outline-btn website-outline-btn--small">
                                    Управление
                                </a>

                            </div>



                            {{-- PHP --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-brands fa-php"></i>
                                    </div>


                                    <div>
                                        <h5>PHP конфигурация</h5>

                                        <p>
                                            PHP версия и конфигурационни настройки
                                        </p>
                                    </div>

                                </div>


                                <a href="#" class="website-dashboard-tool__arrow">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>

                            </div>



                            {{-- SSL --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-solid fa-lock"></i>
                                    </div>


                                    <div>
                                        <h5>SSL сертификат</h5>

                                        <p>
                                            HTTPS защита на вашия уебсайт
                                        </p>
                                    </div>

                                </div>


                                <span class="website-status website-status--success">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Активен
                                </span>

                            </div>





                            {{-- HOSTING --}}
                            <div class="website-dashboard-tool">

                                <div class="website-dashboard-tool__info">

                                    <div class="website-dashboard-tool__icon">
                                        <i class="fa-solid fa-server"></i>
                                    </div>


                                    <div>
                                        <h5>Хостинг план</h5>

                                        <p>
                                            Hosthinker Web Hosting
                                        </p>
                                    </div>

                                </div>


                                <a href="#" class="website-dashboard-tool__arrow">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>

                            </div>


                        </div>

                    </div>

                </div>



                {{-- RIGHT SIDE --}}
                <div class="website-dashboard__right">





                    {{-- RESOURCE USAGE --}}
                    <div class="website-dashboard-card">

                        <div class="website-dashboard-card__header website-dashboard-card__header--action">

                            <h4>Използвани ресурси</h4>

                            <a
                                href="#"
                                class="website-outline-btn website-outline-btn--small"
                            >
                                Детайли
                            </a>

                        </div>


                        <div class="website-resources">


                            <div class="website-resource">

                                <div class="website-resource__top">

                                    <div>
                                        <span>Дисково пространство</span>

                                        <strong>
                                            1.8 GB / 10 GB
                                        </strong>
                                    </div>

                                    <span>18%</span>

                                </div>


                                <div class="website-progress">
                                    <span style="width: 18%;"></span>
                                </div>

                            </div>



                            <div class="website-resource">

                                <div class="website-resource__top">

                                    <div>
                                        <span>Inodes</span>

                                        <strong>
                                            12,420 / 100,000
                                        </strong>
                                    </div>

                                    <span>12%</span>

                                </div>


                                <div class="website-progress">
                                    <span style="width: 12%;"></span>
                                </div>

                            </div>



                            <div class="website-resource">

                                <div class="website-resource__top">

                                    <div>
                                        <span>CPU</span>

                                        <strong>
                                            4%
                                        </strong>
                                    </div>

                                    <span>
                                        <i class="fa-solid fa-microchip"></i>
                                    </span>

                                </div>


                                <div class="website-progress">
                                    <span style="width: 4%;"></span>
                                </div>

                            </div>



                            <div class="website-resource">

                                <div class="website-resource__top">

                                    <div>
                                        <span>RAM</span>

                                        <strong>
                                            220 MB
                                        </strong>
                                    </div>

                                    <span>
                                        <i class="fa-solid fa-memory"></i>
                                    </span>

                                </div>


                                <div class="website-progress">
                                    <span style="width: 22%;"></span>
                                </div>

                            </div>


                        </div>

                    </div>


                </div>
            </div>
        </div>

    </section>

</x-backend>
