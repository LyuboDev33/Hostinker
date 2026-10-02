<x-backend>

    @section('SEO')
        <title>Хостинг планове - Dashboard</title>
    @endsection


    <section class="hosting-admin">

        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="hosting-admin__header">

                <div>
                    <span class="hosting-admin__eyebrow">
                        <i class="fa-solid fa-server"></i>
                        Администрация
                    </span>

                    <h1>Хостинг планове</h1>

                    <p>
                        Създавайте и управлявайте хостинг плановете,
                        които предлагате на клиентите.
                    </p>
                </div>


                <div class="hosting-admin__count">

                    <span>
                        {{ $hostingPlans->count() }}
                    </span>

                    <small>
                        Общо планове
                    </small>

                </div>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="hosting-admin__alert hosting-admin__alert--success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>
            @endif


            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <div class="hosting-admin__alert hosting-admin__alert--error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        Моля, проверете въведената информация.
                    </span>

                </div>
            @endif


            <div class="hosting-admin__layout">


                {{-- ========================================== --}}
                {{-- CREATE HOSTING PLAN --}}
                {{-- ========================================== --}}

                <div class="hosting-admin-card">

                    <div class="hosting-admin-card__header">

                        <div class="hosting-admin-card__header-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>

                        <div>

                            <h3>
                                Нов хостинг план
                            </h3>

                            <p>
                                Въведете параметрите на новия план.
                            </p>

                        </div>

                    </div>


                    <form action="{{ route('super_admin.hosting.store') }}" method="POST" class="hosting-plan-form">

                        @csrf


                        {{-- NAME --}}
                        <div class="hosting-form-group">

                            <label for="name">
                                Име на плана
                            </label>

                            <div class="hosting-form-input">

                                <i class="fa-solid fa-tag"></i>

                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Например: Starter" required>

                            </div>

                            @error('name')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- STORAGE --}}
                        <div class="hosting-form-group">

                            <label for="storage_gb">
                                Дисково пространство
                            </label>

                            <div class="hosting-form-input hosting-form-input--suffix">

                                <i class="fa-solid fa-hard-drive"></i>

                                <input type="number" id="storage_gb" name="storage_gb" value="{{ old('storage_gb') }}"
                                    min="1" step="1" placeholder="10" required>

                                <span>
                                    GB
                                </span>

                            </div>

                            @error('storage_gb')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- INITIAL PRICE --}}
                        <div class="hosting-form-group">

                            <label for="price">
                                Начална цена
                            </label>

                            <div class="hosting-form-input hosting-form-input--suffix">

                                <i class="fa-solid fa-euro-sign"></i>

                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    min="0" step="0.01" placeholder="49.99" required>

                                <span>
                                    €
                                </span>

                            </div>

                            <small class="hosting-form-help">
                                Цената, която клиентът заплаща при първоначално закупуване.
                            </small>

                            @error('price')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- RENEWAL PRICE --}}
                        <div class="hosting-form-group">

                            <label for="renewal_price">
                                Цена при подновяване
                            </label>

                            <div class="hosting-form-input hosting-form-input--suffix">

                                <i class="fa-solid fa-rotate"></i>

                                <input type="number" id="renewal_price" name="renewal_price"
                                    value="{{ old('renewal_price') }}" min="0" step="0.01" placeholder="89.99"
                                    required>

                                <span>
                                    €
                                </span>

                            </div>

                            <small class="hosting-form-help">
                                Цената, която клиентът ще заплаща при последващо подновяване.
                            </small>

                            @error('renewal_price')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- STRIPE PRICE --}}
                        <div class="hosting-form-group">

                            <label for="stripe_price">
                                Stripe Price ID
                            </label>

                            <div class="hosting-form-input">

                                <i class="fa-brands fa-stripe-s"></i>

                                <input type="text" id="stripe_price" name="stripe_price"
                                    value="{{ old('stripe_price') }}" placeholder="price_1ABC..." autocomplete="off"
                                    required>

                            </div>

                            <small class="hosting-form-help">
                                Price ID на абонамента, създаден в Stripe.
                            </small>

                            @error('stripe_price')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="hosting-form-group">

                            <label for="stripe_price_renewal">
                                Stripe Price Renewal ID
                            </label>

                            <div class="hosting-form-input">

                                <i class="fa-brands fa-stripe-s"></i>

                                <input type="text" id="stripe_price_renewal" name="stripe_price_renewal"
                                    value="{{ old('stripe_price') }}" placeholder="price_1ABC..." autocomplete="off"
                                    required>

                            </div>

                            <small class="hosting-form-help">
                                Price ID на абонамента, създаден в Stripe.
                            </small>

                            @error('stripe_price')
                                <span class="hosting-form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- ACTIVE --}}
                        <div class="hosting-form-status">

                            <div>

                                <strong>
                                    Активен план
                                </strong>

                                <p>
                                    Планът ще бъде достъпен за използване.
                                </p>

                            </div>


                            <label class="hosting-switch">

                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}>

                                <span class="hosting-switch__slider"></span>

                            </label>

                        </div>


                        {{-- SUBMIT --}}
                        <button type="submit" class="tg-btn hosting-plan-form__submit">

                            <i class="fa-solid fa-plus"></i>

                            Създай план

                        </button>

                    </form>

                </div>



                {{-- ========================================== --}}
                {{-- EXISTING HOSTING PLANS --}}
                {{-- ========================================== --}}

                <div class="hosting-admin-card hosting-admin-card--plans">

                    <div class="hosting-admin-card__header">

                        <div class="hosting-admin-card__header-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <div>

                            <h3>
                                Съществуващи планове
                            </h3>

                            <p>
                                Всички създадени хостинг планове.
                            </p>

                        </div>

                    </div>


                    @if ($hostingPlans->isEmpty())

                        {{-- EMPTY STATE --}}
                        <div class="hosting-plans-empty">

                            <div class="hosting-plans-empty__icon">
                                <i class="fa-solid fa-server"></i>
                            </div>

                            <h4>
                                Все още няма хостинг планове
                            </h4>

                            <p>
                                Създайте първия план от формата.
                            </p>

                        </div>
                    @else
                        <div class="hosting-plans-list">

                            @foreach ($hostingPlans as $plan)
                                <div class="hosting-plan-item">


                                    {{-- PLAN INFORMATION --}}
                                    <div class="hosting-plan-item__main">

                                        <div class="hosting-plan-item__icon">
                                            <i class="fa-solid fa-server"></i>
                                        </div>


                                        <div class="hosting-plan-item__info">

                                            <div class="hosting-plan-item__title">

                                                <h4>
                                                    {{ $plan->name }}
                                                </h4>


                                                @if ($plan->is_active)
                                                    <span class="hosting-plan-status hosting-plan-status--active">

                                                        <i class="fa-solid fa-circle"></i>

                                                        Активен

                                                    </span>
                                                @else
                                                    <span class="hosting-plan-status hosting-plan-status--inactive">

                                                        <i class="fa-solid fa-circle"></i>

                                                        Неактивен

                                                    </span>
                                                @endif

                                            </div>


                                            <div class="hosting-plan-item__meta">

                                                {{-- STORAGE --}}
                                                <span>

                                                    <i class="fa-solid fa-hard-drive"></i>

                                                    {{ $plan->storage_gb }} GB

                                                </span>


                                                {{-- CREATED --}}
                                                <span>

                                                    <i class="fa-regular fa-calendar"></i>

                                                    {{ $plan->created_at->format('d.m.Y') }}

                                                </span>

                                            </div>


                                            {{-- STRIPE --}}
                                            <div class="hosting-plan-item__stripe">

                                                <i class="fa-brands fa-stripe-s"></i>

                                                <span>
                                                    {{ $plan->stripe_price }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- PRICING --}}
                                    <div class="hosting-plan-item__pricing">

                                        {{-- INITIAL --}}
                                        <div class="hosting-plan-price">

                                            <span class="hosting-plan-price__label">
                                                Начална цена
                                            </span>

                                            <div>

                                                <strong>
                                                    {{ number_format($plan->price, 2, ',', ' ') }} €
                                                </strong>

                                                <span>
                                                    / година
                                                </span>

                                            </div>

                                        </div>


                                        {{-- ARROW --}}
                                        <div class="hosting-plan-price__arrow">

                                            <i class="fa-solid fa-arrow-right"></i>

                                        </div>


                                        {{-- RENEWAL --}}
                                        <div class="hosting-plan-price hosting-plan-price--renewal">

                                            <span class="hosting-plan-price__label">
                                                Подновяване
                                            </span>

                                            <div>

                                                <strong>
                                                    {{ number_format($plan->renewal_price, 2, ',', ' ') }} €
                                                </strong>

                                                <span>
                                                    / година
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

</x-backend>
