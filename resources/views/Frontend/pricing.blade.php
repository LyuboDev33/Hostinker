<x-frontend>

    @section('SEO')
        <title>Абонаментни планове | LASO</title>

        <meta
            name="description"
            content="Изберете подходящия LASO абонаментен план за управление на вашата Meta реклама и генериране на реални запитвания от потенциални клиенти."
        >

        <meta
            name="keywords"
            content="LASO, абонаментни планове, Meta реклама, lead generation, реклама за малък бизнес, Facebook реклама, Instagram реклама"
        >

        <meta
            property="og:title"
            content="Абонаментни планове | LASO"
        >

        <meta
            property="og:description"
            content="Изберете абонамента, който най-добре отговаря на вашия бизнес. Всеки план включва месечна поддръжка и управление на рекламата."
        >

        <meta
            property="og:type"
            content="website"
        >
    @endsection


    {{-- PRICING / PLANS --}}
    <section
        class="pt-5"
        style="background-image: url(/assets/img/background-1.png);">

        <div class="container">

            {{-- PRICING HEADING --}}
            <div class="mb-5 text-center">

                <img
                    src="/assets/img/heading-img.png"
                    alt="LASO абонаментни планове"
                >

                <h6>
                    АБОНАМЕНТНИ ПЛАНОВЕ
                </h6>

                <h2>
                    Изберете план
                </h2>

                <p>
                    По-евтино от повечето абонаменти, които вече плащате всеки месец —
                    но за нещо, което реално развива бизнеса ви.
                </p>

                <p>
                    Изберете абонамента, който най-добре отговаря на вашия бизнес.
                    Всеки план включва месечна поддръжка и управление на рекламата.
                </p>

            </div>


            {{-- PRICING CARDS --}}
            <div class="row">

                {{-- BASIC PLAN --}}
                <div class="col-lg-4 col-md-6">

                    <div
                        class="pricing-two"
                        style="background-image: url(/assets/img/background-p.png);"
                    >

                        <div class="month">

                            <h5>
                                Basic Plan
                            </h5>

                            <h4>
                                $64.<span>00</span><sub>/Month</sub>
                            </h4>

                        </div>


                        <div class="pricing-two-text">

                            <p>
                                Lorem ipsum dolor sit amet, conse ur adipiscing elit sed do.
                            </p>


                            <ul class="list">

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Up to 10 Website
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Lifetime free Support
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    10 GB Hosting free
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    24/7 Support
                                </li>

                            </ul>


                            <a
                                href="#"
                                class="btn"
                            >
                                Purchase Now
                            </a>

                        </div>

                    </div>

                </div>
                {{-- BASIC PLAN END --}}



                {{-- PROFESSIONAL PLAN --}}
                <div class="col-lg-4 col-md-6">

                    <div
                        class="pricing-two"
                        style="background-image: url(/assets/img/background-p.png);"
                    >

                        <div class="month">

                            <h5>
                                Professional Plan
                            </h5>

                            <h4>
                                $120.<span>00</span><sub>/Month</sub>
                            </h4>

                        </div>


                        <div class="pricing-two-text">

                            <p>
                                Lorem ipsum dolor sit amet, conse ur adipiscing elit sed do.
                            </p>


                            <ul class="list">

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Up to 10 Website
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Lifetime free Support
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    10 GB Hosting free
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    24/7 Support
                                </li>

                            </ul>


                            <form
                                action="{{ route('subscription.create', [
                                    'priceId' => 'price_1U1rN30XJPJxSgBOzr2SkEE6',
                                    'plan' => 'premium',
                                ]) }}"
                                method="POST"
                            >

                                @csrf


                                <button
                                    type="submit"
                                    class="btn"
                                >
                                    Купи сега
                                </button>

                            </form>


                            {{-- SUBSCRIPTION ALREADY EXISTS --}}
                            <x-session-message
                                session-key="subscriptionAlreadyExists"
                                type="warning"
                                title="Вече имате активен абонамент"
                                :modal="true"
                                text="Вече имате активен абонамент към нашата услуга."
                            />


                            {{-- PAYMENT PLANS FAILED --}}
                            <x-session-message
                                session-key="paymentPlansFailed"
                                type="danger"
                                :modal="true"
                                title="Възникна грешка"
                                text="Възникна проблем при зареждането на абонаментните планове. Моля, опитайте отново."
                            />


                            {{-- NO SUBSCRIPTION --}}
                            <x-session-message
                                session-key="error_noSubscription"
                                type="warning"
                                :modal="true"
                                title="Нямате активен абонамент"
                                text="За да използвате тази функционалност, е необходимо да имате активен абонамент."
                            />


                            {{-- LOGIN REQUIRED --}}
                            <x-session-message
                                session-key="needToBeLogged"
                                type="warning"
                                title="Необходим е акаунт"
                                text='За да се абонирате е нужно да имате акаунт в нашата система. В случай, че вече имате акаунт, натиснете "Вход" и влезте в профила си.'
                                :modal="true"
                            >

                                <div class="d-flex gap-2 mt-4">

                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-primary"
                                    >
                                        Вход
                                    </a>

                                    <a
                                        href="{{ route('register') }}"
                                        class="btn btn-outline-primary"
                                    >
                                        Регистрация
                                    </a>

                                </div>

                            </x-session-message>

                        </div>

                    </div>

                </div>
                {{-- PROFESSIONAL PLAN END --}}



                {{-- BUSINESS PLAN --}}
                <div class="col-lg-4 col-md-6">

                    <div
                        class="pricing-two mb-0"
                        style="background-image: url(/assets/img/background-p.png);"
                    >

                        <div class="month">

                            <h5>
                                Business Plan
                            </h5>

                            <h4>
                                $184.<span>00</span><sub>/Month</sub>
                            </h4>

                        </div>


                        <div class="pricing-two-text">

                            <p>
                                Lorem ipsum dolor sit amet, conse ur adipiscing elit sed do.
                            </p>


                            <ul class="list">

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Up to 10 Website
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    Lifetime free Support
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    10 GB Hosting free
                                </li>

                                <li>
                                    <img
                                        src="/assets/img/check.png"
                                        alt="check"
                                    >

                                    24/7 Support
                                </li>

                            </ul>


                            <a
                                href="#"
                                class="btn"
                            >
                                Purchase Now
                            </a>

                        </div>

                    </div>

                </div>
                {{-- BUSINESS PLAN END --}}

            </div>
            {{-- PRICING CARDS END --}}



            {{-- SUBSCRIPTION BENEFITS --}}
            <div class="row justify-content-center mt-5">

                <div class="col-lg-12">

                    <ul
                        class="list d-flex justify-content-center align-items-center flex-wrap gap-4"
                    >

                        <li>

                            <img
                                src="/assets/img/check.png"
                                alt="check"
                            >

                            Без дългосрочен договор

                        </li>


                        <li>

                            <img
                                src="/assets/img/check.png"
                                alt="check"
                            >

                            Месечно плащане, като всеки друг абонамент

                        </li>


                        <li>

                            <img
                                src="/assets/img/check.png"
                                alt="check"
                            >

                            Възможност за прекратяване по всяко време

                        </li>

                    </ul>

                </div>

            </div>
            {{-- SUBSCRIPTION BENEFITS END --}}



            {{-- TESTIMONIAL --}}
            <div class="row justify-content-center mt-5">

                <div class="col-lg-9">

                    <div class="mb-5 text-center">

                        <h6>
                            РЕАЛНИ РЕЗУЛТАТИ
                        </h6>

                        <h2>
                            Вижте как LASO работи за реални бизнеси
                        </h2>

                        <p>
                            Вижте как бизнеси в сферата на услугите използват LASO,
                            за да достигат до потенциални клиенти и да получават
                            реални запитвания чрез Meta реклама.
                        </p>

                    </div>


                    <div class="video position-relative">

                        <a
                            data-fancybox=""
                            href="#"
                        >

                            <i>

                                <svg
                                    width="11"
                                    height="17"
                                    viewBox="0 0 11 17"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >

                                    <path
                                        d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z"
                                        fill="#fff"
                                    ></path>

                                </svg>

                            </i>

                        </a>


                        <img
                            src="https://placehold.co/900x500?text=LASO+Видео+Отзив"
                            alt="Видео отзив от клиент на LASO"
                            class="w-100"
                        >

                    </div>


                    <div class="text-center mt-4">

                        <h4>
                            Реални запитвания. Реални бизнеси. Реални резултати.
                        </h4>

                        <p>
                            Тук ще бъде добавен видео отзив от клиент на LASO
                            с конкретен резултат от неговата рекламна кампания.
                        </p>

                    </div>

                </div>

            </div>
            {{-- TESTIMONIAL END --}}

        </div>

    </section>
    {{-- PRICING / PLANS END --}}



    {{-- SECOND PRICING SECTION --}}
    <section
        class="gap blog-section"
        style="background-image: url(/assets/img/background-1.png);"
    >

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <div class="mb-5 two">

                        <h6>
                            АБОНАМЕНТНИ ПЛАНОВЕ
                        </h6>

                        <h2>
                            Изберете абонамента, който най-добре отговаря на вашия бизнес
                        </h2>

                        <p>
                            По-евтино от повечето абонаменти, които вече плащате
                            всеки месец — но за нещо, което реално развива бизнеса ви.
                        </p>

                    </div>

                </div>


                <div class="col-lg-5">

                    <div
                        class="nav nav-pills"
                        id="v-pills-tab"
                        role="tablist"
                        aria-orientation="vertical"
                    >

                        <button
                            class="nav-link"
                            id="v-pills-home-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#v-pills-home"
                            type="button"
                            role="tab"
                            aria-controls="v-pills-home"
                            aria-selected="false"
                        >
                            Месечно
                        </button>


                        <button
                            class="nav-link active"
                            id="v-pills-profile-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile"
                            type="button"
                            role="tab"
                            aria-controls="v-pills-profile"
                            aria-selected="true"
                        >
                            Годишно
                        </button>

                    </div>

                </div>

            </div>


            <div
                class="tab-content"
                id="v-pills-tabContent"
            >

                {{-- MONTHLY --}}
                <div
                    class="tab-pane fade"
                    id="v-pills-home"
                    role="tabpanel"
                    aria-labelledby="v-pills-home-tab"
                >

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="pricing">

                                <div class="professional">

                                    <h3>
                                        Professional
                                    </h3>

                                    <p>
                                        Месечен план за бизнеси, които искат
                                        професионално управление на своята реклама.
                                    </p>

                                </div>


                                <div
                                    class="professional-text"
                                    style="background-image: url(/assets/img/background-p.png);"
                                >

                                    <ul class="list">

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Lead generation реклама
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Месечно управление
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Постоянна оптимизация
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Поддръжка
                                        </li>

                                    </ul>


                                    <h4>
                                        $64
                                        <span>/месец</span>
                                    </h4>


                                    <a
                                        href="#"
                                        class="btn"
                                    >
                                        Избери план
                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="pricing">

                                <div class="professional">

                                    <h3>
                                        Business
                                    </h3>

                                    <p>
                                        Разширен план за бизнеси, които искат
                                        повече възможности и поддръжка.
                                    </p>

                                </div>


                                <div
                                    class="professional-text"
                                    style="background-image: url(/assets/img/background-p.png);"
                                >

                                    <ul class="list">

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Lead generation реклама
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Месечно управление
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Постоянна оптимизация
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Разширена поддръжка
                                        </li>

                                    </ul>


                                    <h4>
                                        $112
                                        <span>/месец</span>
                                    </h4>


                                    <a
                                        href="#"
                                        class="btn"
                                    >
                                        Избери план
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                {{-- MONTHLY END --}}



                {{-- YEARLY --}}
                <div
                    class="tab-pane fade active show"
                    id="v-pills-profile"
                    role="tabpanel"
                    aria-labelledby="v-pills-profile-tab"
                >

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="pricing">

                                <div class="professional">

                                    <h3>
                                        Professional
                                    </h3>

                                    <p>
                                        Годишен план за бизнеси, които искат
                                        постоянно управление на рекламата си.
                                    </p>

                                </div>


                                <div
                                    class="professional-text"
                                    style="background-image: url(/assets/img/background-p.png);"
                                >

                                    <ul class="list">

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Lead generation реклама
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Постоянна оптимизация
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Клиентски профил
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Поддръжка
                                        </li>

                                    </ul>


                                    <h4>
                                        $340
                                        <span>/година</span>
                                    </h4>


                                    <a
                                        href="#"
                                        class="btn"
                                    >
                                        Избери план
                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="pricing">

                                <div class="professional">

                                    <h3>
                                        Business
                                    </h3>

                                    <p>
                                        Годишен план с разширена поддръжка
                                        и постоянно развитие на рекламата.
                                    </p>

                                </div>


                                <div
                                    class="professional-text"
                                    style="background-image: url(/assets/img/background-p.png);"
                                >

                                    <ul class="list">

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Lead generation реклама
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Постоянна оптимизация
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Клиентски профил
                                        </li>

                                        <li>
                                            <img
                                                src="/assets/img/check.png"
                                                alt="check"
                                            >
                                            Разширена поддръжка
                                        </li>

                                    </ul>


                                    <h4>
                                        $560
                                        <span>/година</span>
                                    </h4>


                                    <a
                                        href="#"
                                        class="btn"
                                    >
                                        Избери план
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                {{-- YEARLY END --}}

            </div>

        </div>

    </section>
    {{-- SECOND PRICING SECTION END --}}

</x-frontend>
