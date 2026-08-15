<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Регистрация | Оптика Valente</title>

    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/default-icons.css">
    <link rel="stylesheet" href="/assets/css/default.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/odometer.css">
    <link rel="stylesheet" href="/assets/css/aos.css">
    <link rel="stylesheet" href="/assets/css/main.css">


</head>

<body>

<!-- login-area -->
<section class="login__area">

    <div class="container-fluid p-0">

        <div class="row gx-0">

            <div class="col-md-6">

                <div class="login__form-inner">

                    <div class="shape">
                        <img src="/assets/img/images/login.svg" alt="">
                    </div>

                    <div class="login__form-wrap">

                        <h2 class="title">
                            Създайте<br>
                            своя профил
                        </h2>

                        <form
                            action="{{ route('register') }}"
                            method="POST"
                            class="login__form"
                        >

                            @csrf


                            {{-- NAME --}}
                            <div class="form__grp">

                                <label for="name">

                                    <i class="fas fa-user"></i>

                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Вашето име"
                                    autocomplete="name"
                                    autofocus
                                    required
                                >

                            </div>

                            @error('name')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror


                            {{-- EMAIL --}}
                            <div class="form__grp">

                                <label for="email">

                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M3 7C3 6.46957 3.21071 5.96086 3.58579 5.58579C3.96086 5.21071 4.46957 5 5 5H19C19.5304 5 20.0391 5.21071 20.4142 5.58579C20.7893 5.96086 21 6.46957 21 7V17C21 17.5304 20.7893 18.0391 20.4142 18.4142C20.0391 18.7893 19.5304 19 19 19H5C4.46957 19 3.96086 18.7893 3.58579 18.4142C3.21071 18.0391 3 17.5304 3 17V7Z"
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

                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Имейл адрес"
                                    autocomplete="username"
                                    required
                                >

                            </div>

                            @error('email')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror


                            {{-- PASSWORD --}}
                            <div class="form__grp">

                                <label for="password">

                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M12.0028 3C14.3386 5.06658 17.3872 6.14257 20.5028 6C20.9564 7.54302 21.0951 9.16147 20.9109 10.7592C20.7266 12.3569 20.2231 13.9013 19.4302 15.3005C18.6373 16.6998 17.5712 17.9254 16.2952 18.9045C15.0193 19.8836 13.5596 20.5962 12.0028 21C10.446 20.5962 8.98624 19.8836 7.71031 18.9045C6.43437 17.9254 5.36827 16.6998 4.57536 15.3005C3.78245 13.9013 3.2789 12.3569 3.09464 10.7592C2.91038 9.16147 3.04917 7.54302 3.50276 6C6.61829 6.14257 9.66693 5.06658 12.0028 3Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M11 11C11 11.2652 11.1054 11.5196 11.2929 11.7071C11.4804 11.8946 11.7348 12 12 12C12.2652 12 12.5196 11.8946 12.7071 11.7071C12.8946 11.5196 13 11.2652 13 11C13 10.7348 12.8946 10.4804 12.7071 10.2929C12.5196 10.1054 12.2652 10 12 10C11.7348 10 11.4804 10.1054 11.2929 10.2929C11.1054 10.4804 11 10.7348 11 11Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M12 12V14.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>

                                </label>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Парола"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                            @error('password')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror


                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="form__grp">

                                <label for="password_confirmation">

                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M12.0028 3C14.3386 5.06658 17.3872 6.14257 20.5028 6C20.9564 7.54302 21.0951 9.16147 20.9109 10.7592C20.7266 12.3569 20.2231 13.9013 19.4302 15.3005C18.6373 16.6998 17.5712 17.9254 16.2952 18.9045C15.0193 19.8836 13.5596 20.5962 12.0028 21C10.446 20.5962 8.98624 19.8836 7.71031 18.9045C6.43437 17.9254 5.36827 16.6998 4.57536 15.3005C3.78245 13.9013 3.2789 12.3569 3.09464 10.7592C2.91038 9.16147 3.04917 7.54302 3.50276 6C6.61829 6.14257 9.66693 5.06658 12.0028 3Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M11 11C11 11.2652 11.1054 11.5196 11.2929 11.7071C11.4804 11.8946 11.7348 12 12 12C12.2652 12 12.5196 11.8946 12.7071 11.7071C12.8946 11.5196 13 11.2652 13 11C13 10.7348 12.8946 10.4804 12.7071 10.2929C12.5196 10.1054 12.2652 10 12 10C11.7348 10 11.4804 10.1054 11.2929 10.2929C11.1054 10.4804 11 10.7348 11 11Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />

                                        <path
                                            d="M12 12V14.5"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>

                                </label>

                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Потвърдете паролата"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                            @error('password_confirmation')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror


                            <button
                                type="submit"
                                class="tg-btn tg-btn-two"
                            >
                                Създай профил
                            </button>

                        </form>


                        <div class="account__switch">

                            <p>
                                Вече имате акаунт?

                                <a href="{{ route('login') }}">
                                    Влезте оттук
                                </a>
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div
                    class="login__img"
                    data-background="/assets/img/images/login_img.jpg"
                >
                </div>

            </div>

        </div>

    </div>

</section>
<!-- login-area-end -->


    <!-- JS here -->
    <script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/jquery.odometer.min.js"></script>
    <script src="/assets/js/jquery.appear.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/nice-select.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <script src="/assets/js/jquery.parallaxScroll.min.js"></script>
    <script src="/assets/js/jarallax.min.js"></script>
    <script src="/assets/js/jquery.marquee.min.js"></script>
    <script src="/assets/js/ajax-form.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/main.js"></script>



</body>

</html>
