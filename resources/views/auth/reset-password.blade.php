<x-frontend>

    @section('SEO')
        <title>Смяна на парола</title>
    @endsection

    <section class="py-5 projects" style="background-image: url(/assets/img/background.png); background-color: #faf9f5;">

        <div>
            <div class="container">

                <div class="row align-items-center">

                    {{-- LEFT SIDE - Reset Password Form --}}
                    <div class="container-reset-pwd shadow">

                        <div class="heading two">
                            <h6>ВЪЗСТАНОВЯВАНЕ НА ПАРОЛА</h6>

                            <h2>Създайте нова парола</h2>

                            <p class="pt-lg-3 pt-md-2">
                                Въведете вашата нова парола и я потвърдете,
                                за да завършите възстановяването на профила си.
                            </p>
                        </div>

                        <form class="content-form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')

                            {{-- Password Reset Token --}}
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- Email --}}
                            <input id="email" type="email" name="email"
                                value="{{ old('email', $request->email) }}" placeholder="Имейл адрес" required autofocus
                                autocomplete="username">

                            @error('email')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- New Password --}}
                            <input id="password" type="password" name="password" placeholder="Нова парола" required
                                autocomplete="new-password">

                            @error('password')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- Confirm New Password --}}
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="Потвърдете новата парола" required autocomplete="new-password">

                            @error('password_confirmation')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn">
                                Смени паролата
                            </button>

                        </form>

                    </div>



                </div>

            </div>
        </div>

    </section>

</x-frontend>
