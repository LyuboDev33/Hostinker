<x-backend>

    @section('SEO')
        <title>Dashboard</title>
    @endsection


    {{-- =========================================================
        DASHBOARD INTRO
    ========================================================== --}}
    <section class="hosting__area-two pt-60 pb-60">

        <div class="container">

            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-8">

                    <div class="hosting__content-wrap">

                        <div class="section__title mb-15">
                            <span class="sub-title">
                                Вашият контролен панел
                            </span>

                            <h3>
                                Здравейте, {{ Auth::user()->name }} 👋
                            </h3>
                        </div>

                        <p>
                            Управлявайте вашите уебсайтове, домейни,
                            хостинг услуги и съобщения от едно място.
                        </p>

                    </div>

                </div>

                <div class="col-xl-5 col-lg-4 text-lg-end">

                    <a href="#" class="tg-btn tg-btn-two add-new-website">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.66797 7.5L12.168 10L9.66797 12.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />

                            <path
                                d="M3 10C3 14.1421 6.35786 17.5 10.5 17.5C14.6421 17.5 18 14.1421 18 10C18 5.85786 14.6421 2.5 10.5 2.5C6.35786 2.5 3 5.85786 3 10Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        Добави нов сайт
                    </a>

                </div>
            </div>

        </div>

    </section>

    <hr>

    {{-- =========================================================
        SERVICES / DASHBOARD MENU
    ========================================================== --}}
    <section class="hosting__area-two mt-4">

        <div class="container">

            <div class="hosting__item-wrap-two">

                <div class="row gutter-y-24">


                    {{-- Heading --}}
                    {{-- <div class="col-xl-6 col-lg-8">

                        <div class="hosting__content-wrap">

                            <div class="section__title mb-15">

                                <span class="sub-title">
                                    Вашите услуги
                                </span>

                                <h2>
                                    Управлявайте всички ваши услуги бързо и лесно
                                от контролния панел.
                                </h2>

                            </div>



                        </div>

                    </div> --}}



                    {{-- Websites --}}
                    <div class="col-xl-3 col-lg-4 col-sm-6">

                        <div class="hosting__item-two">

                            <div class="hosting__item-top">

                                <div class="hosting__icon hosting__icon-two">
                                    <img src="/assets/img/icon/hosting_icon01.svg" alt="Websites">
                                </div>

                                <div class="hosting__content-top">

                                    <h4 class="title">
                                        Уебсайтове
                                    </h4>

                                    <span>
                                        Вашите уебсайтове
                                    </span>

                                </div>

                            </div>


                            <div class="hosting__content-two">

                                <p>
                                    Управлявайте всички сайтове, свързани
                                    с вашия акаунт.
                                </p>

                            </div>


                            <div class="hosting__btn-two">

                                <a href="#">

                                    <svg class="left-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <path
                                            d="M2.5 10C2.5 14.1421 5.85786 17.5 10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </svg>

                                    <span class="text">
                                        Управление
                                    </span>

                                    <svg class="right-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <path
                                            d="M2.5 10C2.5 14.1421 5.85786 17.5 10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </svg>

                                </a>

                            </div>

                            <span class="hosting__badge">
                                3 активни
                            </span>

                        </div>

                    </div>



                    {{-- Domains --}}
                    <div class="col-xl-3 col-lg-4 col-sm-6">

                        <div class="hosting__item-two">

                            <div class="hosting__item-top">

                                <div class="hosting__icon hosting__icon-two">
                                    <img src="/assets/img/icon/hosting_icon02.svg" alt="Domains">
                                </div>

                                <div class="hosting__content-top">

                                    <h4 class="title">
                                        Домейни
                                    </h4>

                                    <span>
                                        Домейни и DNS
                                    </span>

                                </div>

                            </div>


                            <div class="hosting__content-two">

                                <p>
                                    Преглеждайте, регистрирайте и управлявайте
                                    вашите домейн имена.
                                </p>

                            </div>


                            <div class="hosting__btn-two">

                                <a href="#">

                                    <svg class="left-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                    <a href="{{ route('backend.domain.index') }}" class="text">
                                        Моите домейни
                                    </a>

                                    <svg class="right-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                </a>

                            </div>

                        </div>

                    </div>



                    {{-- Hosting --}}
                    <div class="col-xl-3 col-lg-4 col-sm-6">

                        <div class="hosting__item-two">

                            <div class="hosting__item-top">

                                <div class="hosting__icon hosting__icon-two">
                                    <img src="/assets/img/icon/hosting_icon03.svg" alt="Hosting">
                                </div>

                                <div class="hosting__content-top">

                                    <h4 class="title">
                                        Хостинг
                                    </h4>

                                    <span>
                                        Управление на услугите
                                    </span>

                                </div>

                            </div>


                            <div class="hosting__content-two">

                                <p>
                                    Следете вашите активни хостинг планове,
                                    ресурси и периоди на подновяване.
                                </p>

                            </div>


                            <div class="hosting__btn-two">

                                <a href="#">

                                    <svg class="left-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                    <span class="text">
                                        Управление
                                    </span>

                                    <svg class="right-icon"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none">

                                        <path d="M9.16797 7.5L11.668 10L9.16797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                </a>

                            </div>

                            <span class="hosting__badge hosting__badge-two">
                                Активен
                            </span>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </section>

    <hr>

    {{-- =========================================================
        DOMAIN SEARCH
    ========================================================== --}}
    <section class="domain__search-area mb-5 d-flex">

        <div class="container">

            <div
                data-background="/assets/img/images/domain_search-bg.jpg">

                <div class="section__title text-center mb-40">

                    <span class="sub-title">
                        Намерете вашия домейн
                    </span>

                    <h2 class="title">
                        Имате нова идея? Проверете домейна още сега.
                    </h2>

                    <p>
                        Потърсете свободно домейн име за следващия си проект.
                    </p>

                </div>


                <div class="domain__search-wrap domain__search-wrap-two d-flex justify-content-center">

                    <form action="#" class="domain__search-form">

                        <svg width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <circle cx="14"
                                cy="14"
                                r="8"
                                stroke="currentColor"
                                stroke-width="2" />

                            <path d="M20 20L27 27"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round" />

                        </svg>


                        <input
                            type="text"
                            placeholder="Потърсете вашия домейн...">


                        <button type="submit" class="tg-btn tg-btn-two">
                            Проверка
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <hr>

    {{-- =========================================================
        PRICING
        Same structure/design as welcome page
    ========================================================== --}}
    <section id="web" class="pricing__area mb-3">

        <div class="container">


            <div class="row">

                <div class="col-lg-12">

                    <div class="section__title section__title-two text-center mb-40">

                        <span class="sub-title">
                            Hosting Plans
                        </span>

                        <h2 class="title">
                            <span>Web Hosting</span> Plans That Fit Your Budget
                        </h2>

                        <p>
                            Experience ultra-fast loading speeds globally for seamless
                            performance and reliability anywhere in the world.
                        </p>

                    </div>

                </div>

            </div>



            {{-- Pricing Switch --}}
            <div class="pricing-tab pricing-tab-two pricing-tab-four">

                <span class="tab-btn monthly_tab_title">
                    12 Months
                </span>

                <span class="pricing-tab-switcher"></span>

                <span class="tab-btn annual_tab_title">
                    36 Months <strong>(save 30%)</strong>
                </span>

            </div>



            <div class="pricing__item-wrap">

                <div class="row justify-content-center">


                    {{-- =====================================================
                        Starter
                    ====================================================== --}}
                    <div class="col-lg-4 col-md-6">

                        <div class="pricing__box pricing__box-two">

                            <div class="pricing__plan">

                                <h4 class="title">
                                    Starter Plan
                                </h4>

                                <p>
                                    Everything you need to your website
                                </p>

                            </div>


                            <div class="pricing__price">

                                <h2 class="price monthly_price">
                                    $4.50 <span>/month</span>
                                </h2>

                                <h2 class="price annual_price">
                                    $45.50 <span>/year</span>
                                </h2>

                                <p>
                                    $ 5.99 when you renew this plan
                                </p>

                                <span class="price-off">
                                    50% OFF
                                </span>

                            </div>


                            <div class="pricing__btn">

                                <a href="#" class="tg-btn tg-border-btn">

                                    <svg width="21"
                                        height="20"
                                        viewBox="0 0 21 20"
                                        fill="none">

                                        <path d="M9.66797 7.5L12.168 10L9.66797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10.5"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                    Get Started

                                </a>

                            </div>


                            <div class="pricing__list">

                                <ul class="list-wrap">

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Up to 10 Website
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Stander Performance
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Up to <strong>30 GB</strong> Data Storage
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>25 GB</strong> SSD Storage
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Free</strong> & Automatic Website Migration
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Daily Backup
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>99.99</strong> Uptime Guarantee
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Unlimited Free <strong>SSL</strong>
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                24/7 Dedicated <strong>Support</strong>
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Powerful control panel
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Cache manager
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> cronjobs
                                            </span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> FTP accounts
                                            </span>
                                        </div>
                                    </li>

                                </ul>

                            </div>


                            <div class="pricing__select">

                                <span class="more-item">
                                    More Features
                                </span>

                                <span class="less-item">
                                    Less Features
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                        Business
                    ====================================================== --}}
                    <div class="col-lg-4 col-md-6">

                        <div class="pricing__box pricing__box-two">

                            <div class="pricing__plan">

                                <h4 class="title">
                                    Business Plan
                                    <span class="tg-badge">
                                        Popular
                                    </span>
                                </h4>

                                <p>
                                    Everything you need to your website
                                </p>

                            </div>


                            <div class="pricing__price">

                                <h2 class="price monthly_price">
                                    $9.50 <span>/month</span>
                                </h2>

                                <h2 class="price annual_price">
                                    $90.50 <span>/year</span>
                                </h2>

                                <p>
                                    $ 5.99 when you renew this plan
                                </p>

                                <span class="price-off">
                                    70% OFF
                                </span>

                            </div>


                            <div class="pricing__btn">

                                <a href="#" class="tg-btn tg-border-btn active">

                                    <svg width="21"
                                        height="20"
                                        viewBox="0 0 21 20"
                                        fill="none">

                                        <path d="M9.66797 7.5L12.168 10L9.66797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10.5"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                    Get Started

                                </a>

                            </div>


                            <div class="pricing__list">

                                <ul class="list-wrap">

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Up to 10 Website</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Stander Performance</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Up to <strong>30 GB</strong> Data Storage
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>25 GB</strong> SSD Storage
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Free</strong> & Automatic Website Migration
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Daily Backup</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>99.99</strong> Uptime Guarantee
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Unlimited Free <strong>SSL</strong>
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                24/7 Dedicated <strong>Support</strong>
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Powerful control panel</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Cache manager</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> cronjobs
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> FTP accounts
                                            </span>
                                        </div>
                                    </li>

                                </ul>

                            </div>


                            <div class="pricing__select">

                                <span class="more-item">
                                    More Features
                                </span>

                                <span class="less-item">
                                    Less Features
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                        Premium
                    ====================================================== --}}
                    <div class="col-lg-4 col-md-6">

                        <div class="pricing__box pricing__box-two">

                            <div class="pricing__plan">

                                <h4 class="title">
                                    Premium Plan
                                </h4>

                                <p>
                                    Everything you need to your website
                                </p>

                            </div>


                            <div class="pricing__price">

                                <h2 class="price monthly_price">
                                    $20.50 <span>/month</span>
                                </h2>

                                <h2 class="price annual_price">
                                    $200.50 <span>/year</span>
                                </h2>

                                <p>
                                    $ 5.99 when you renew this plan
                                </p>

                                <span class="price-off">
                                    50% OFF
                                </span>

                            </div>


                            <div class="pricing__btn">

                                <a href="#" class="tg-btn tg-border-btn">

                                    <svg width="21"
                                        height="20"
                                        viewBox="0 0 21 20"
                                        fill="none">

                                        <path d="M9.66797 7.5L12.168 10L9.66797 12.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <circle cx="10.5"
                                            cy="10"
                                            r="7.5"
                                            stroke="currentColor"
                                            stroke-width="1.5" />

                                    </svg>

                                    Get Started

                                </a>

                            </div>


                            <div class="pricing__list">

                                <ul class="list-wrap">

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Up to 10 Website</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Stander Performance</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Up to <strong>30 GB</strong> Data Storage
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>25 GB</strong> SSD Storage
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Free</strong> & Automatic Website Migration
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Daily Backup</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>99.99</strong> Uptime Guarantee
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                Unlimited Free <strong>SSL</strong>
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                24/7 Dedicated <strong>Support</strong>
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Powerful control panel</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>Cache manager</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> cronjobs
                                            </span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="content">
                                            <span>
                                                <strong>Unlimited</strong> FTP accounts
                                            </span>
                                        </div>
                                    </li>

                                </ul>

                            </div>


                            <div class="pricing__select">

                                <span class="more-item">
                                    More Features
                                </span>

                                <span class="less-item">
                                    Less Features
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>




</x-backend>
