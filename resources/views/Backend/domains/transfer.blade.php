<x-backend>

    @section('SEO')
        <title>Трансфер на домейн</title>
        <meta name="description" content="Прехвърлете домейна си към вашия хостинг акаунт.">
    @endsection

    <section class="backend-domain-transfer">
        <div class="container">

            {{-- Breadcrumb --}}
            <div class="backend-domain-transfer__breadcrumb">
                <a href="{{ route('dashboard') }}" aria-label="Начало">
                    <i class="fa-solid fa-house"></i>
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <a href="{{ route('backend.domain.index') }}">
                    Моите домейни
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <span>Трансфер на домейн</span>
            </div>

            {{-- Transfer card --}}
            <div class="backend-domain-transfer__card">

                <div class="backend-domain-transfer__content">

                    {{-- Illustration --}}
                    <img
                        src="{{ asset('assets/images/domains/domain-transfer-empty.svg') }}"
                        alt="Трансфер на домейн"
                        class="backend-domain-transfer__image"
                        width="126"
                        height="80"
                    >

                    <h2>Трансферирайте домейна си при нас</h2>

                    {{-- Domain transfer form --}}
                    <form
                        action="#"
                        method="POST"
                        class="backend-domain-transfer__form"
                    >
                        @csrf

                        <div class="backend-domain-transfer__form-row">

                            <div class="backend-domain-transfer__input-wrapper">
                                <input
                                    type="text"
                                    name="domain"
                                    id="domain"
                                    class="backend-domain-transfer__input"
                                    placeholder="Въведете домейна, който искате да трансферирате"
                                    value="{{ old('domain') }}"
                                    autocomplete="off"
                                    autocapitalize="none"
                                    spellcheck="false"
                                    aria-label="Домейн за трансфер"
                                    aria-describedby="domain-error"
                                    required
                                >

                                @error('domain')
                                    <span
                                        class="backend-domain-transfer__error"
                                        id="domain-error"
                                    >
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                            <button
                                type="submit"
                                class="tg-btn tg-btn-two backend-domain-transfer__submit"
                            >
                                Трансфер
                            </button>

                        </div>
                    </form>

                    {{-- Transfer price --}}
                    <div class="backend-domain-transfer__pricing">
                        <p>
                            <strong>Трансфер на .com домейн.</strong>
                            Цената зависи от домейн разширението и регистратора.
                        </p>
                    </div>

                   
                </div>

            </div>

        </div>
    </section>

</x-backend>

