<x-frontend>

    @section('SEO')
        <title>Забравена парола</title>
    @endsection


    <section class="py-5 projects"
        style="background-image: url(assets/img/background.png); background-color: #faf9f5;">

        <div class="section-business">
            <div class="container">

                <div class="row align-items-center">

                    {{-- LEFT SIDE - Forgot Password Form --}}
                    <div class="col-lg-6">

                        <div class="heading two">
                            <h6>ВЪЗСТАНОВЯВАНЕ НА ПАРОЛА</h6>

                            <h2>Забравена парола</h2>

                            <p class="pt-lg-3 pt-md-2">
                                Въведете имейл адреса, с който сте се регистрирали.
                                Ще получите линк за възстановяване на вашата парола.
                            </p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="content-form" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <input id="email"
                                type="email"
                                name="email" value="{{ old('email') }}"
                                placeholder="Имейл адрес" required>

                            @error('email')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn">
                                Изпрати линк за възстановяване
                            </button>

                        </form>

                    </div>

                    {{-- RIGHT SIDE - Image --}}
                    <div class="col-lg-6">

                        <div class="business-img">

                            <img src="/assets/img/business.png" alt="Възстановяване на парола">

                            <img src="{{ asset('assets/img/dots-shaps.png') }}" alt="dots-shaps" class="dots-shaps">

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>

</x-frontend>
