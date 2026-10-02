<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Потвърдете имейла си | Оптика Valente</title>

    <meta name="description"
        content="Потвърдете своя имейл адрес, за да завършите регистрацията си в Оптика Valente.">

    <meta name="robots" content="noindex,nofollow">

    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/default-icons.css">
    <link rel="stylesheet" href="/assets/css/main.css">

</head>

<body>

    <!-- verify-email-area -->
    <section class="verify-email__area">

        <div class="container-fluid p-0">

            <div class="row gx-0">

                <!-- Left content -->
                <div class="col-md-6">

                    <div class="verify-email__content">

                        <div class="verify-email__box">

                            <!-- Icon -->
                            <div class="verify-email__icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7Z"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                    <path
                                        d="M3 7L12 13L21 7"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>

                            </div>

                            <!-- Heading -->
                            <div class="verify-email__heading">

                                <h1>
                                    Потвърдете вашия имейл
                                </h1>

                                <p>
                                    Благодарим ви за регистрацията! Изпратихме ви
                                    линк за потвърждение. Отворете имейла и натиснете
                                    върху линка, за да активирате профила си.
                                </p>

                            </div>

                            <!-- Email -->
                            <div class="verify-email__address">

                                <div class="verify-email__address-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        />

                                        <path
                                            d="M3 7L12 13L21 7"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>

                                </div>

                                <div class="verify-email__address-content">

                                    <span>
                                        Изпратихме имейл до:
                                    </span>

                                    <strong>
                                        {{ auth()->user()->email }}
                                    </strong>

                                </div>

                            </div>

                            <!-- Status -->
                            @if (session('status') == 'verification-link-sent')

                                <div class="verify-email__success">

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Нов линк за потвърждение беше изпратен
                                        успешно на вашия имейл адрес.
                                    </span>

                                </div>

                            @endif

                            <!-- Resend -->
                            <form
                                method="POST"
                                action="{{ route('verification.send') }}"
                                class="verify-email__form"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="tg-btn tg-btn-two"
                                >
                                    Изпрати отново имейл
                                </button>

                            </form>

                            <div class="verify-email__help">

                                <p>
                                    Не намирате имейла? Проверете и папка „Спам“.
                                </p>

                            </div>

                            <!-- Logout -->
                            <div class="verify-email__logout">

                                <p>
                                    Влезли сте с грешен имейл адрес?
                                </p>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button type="submit">
                                        Излезте от профила
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Right image -->
                <div class="col-md-6 verify-email__image-column">

                    <div class="verify-email__image"></div>

                </div>

            </div>

        </div>

    </section>
    <!-- verify-email-area-end -->


    <!-- JS here -->
    <script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
