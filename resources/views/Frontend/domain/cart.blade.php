<x-frontend>

    @section('SEO')
        <title>Количка | Hostinker</title>
    @endsection


    <section class="domain-cart">
        <div class="container">

            <div class="domain-cart__header">

                <div>

                    <span class="domain-cart__subtitle">
                        Вашата количка
                    </span>

                    <h2>
                        Избран домейн
                    </h2>

                    <p>
                        Изберете периода за регистрация и продължете към завършване на поръчката.
                    </p>

                </div>

            </div>


            @if (!empty($domain))

                <div class="row">

                    <div class="col-lg-7 col-xl-8">

                        <div class="domain-cart__list">

                            <div class="domain-cart-item">

                                <div class="domain-cart-item__top">

                                    <div class="domain-cart-item__domain">

                                        <div class="domain-cart-item__icon">
                                            <i class="fa-solid fa-globe"></i>
                                        </div>

                                        <div>

                                            <span class="domain-cart-item__label">
                                                Домейн
                                            </span>

                                            <h4>
                                                {{ $domain['name'] }}
                                            </h4>

                                        </div>

                                    </div>


                                    <form method="POST" action="{{ route('domain.cart.destroy') }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="domain-cart-item__remove"
                                            title="Премахни от количката">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>

                                    </form>

                                </div>


                                <div class="domain-cart-item__body">

                                    <div class="domain-cart-item__field">

                                        <label for="domainYears">
                                            Период на регистрация
                                        </label>

                                        <select name="years" id="domainYears"
                                            class="form-select domain-cart-item__select">

                                            @foreach ($domain['prices'] as $price)
                                                <option value="{{ $price['years'] }}"
                                                    data-purchase-price="{{ $price['purchase_price'] }}"
                                                    data-renewal-price="{{ $price['renewal_price'] ?? 0 }}"
                                                    data-premium="{{ !empty($price['premium']) ? 1 : 0 }}">

                                                    {{ $price['years'] }}

                                                    {{ $price['years'] == 1 ? 'година' : 'години' }}

                                                    —

                                                    {{ number_format($price['purchase_price'], 2) }} €

                                                </option>
                                            @endforeach

                                        </select>

                                    </div>


                                    <div class="domain-cart-item__pricing">

                                        <div class="domain-cart-item__price-box">

                                            <span>
                                                Цена за регистрация
                                            </span>

                                            <strong id="domainPurchasePrice">
                                                {{ number_format($domain['prices'][1]['purchase_price'] ?? 0, 2) }} €
                                            </strong>

                                        </div>


                                        <div class="domain-cart-item__price-box">

                                            <span>
                                                Цена за подновяване
                                            </span>

                                            <strong id="domainRenewalPrice">
                                                {{ number_format($domain['prices'][1]['renewal_price'] ?? 0, 2) }} €
                                            </strong>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form method="POST" action="{{ route('domain.register') }}" class="col-lg-5 col-xl-4">

                        @csrf

                        <input type="hidden" name="domainName" value="{{ $domain['name'] }}">

                        <input type="hidden" name="years" id="selectedYears" value="1">

                        <div class="domain-cart-summary">

                            <h4>
                                Обобщение
                            </h4>

                            <div class="domain-cart-summary__rows">

                                <div class="domain-cart-summary__row">

                                    <span>
                                        Домейн
                                    </span>

                                    <strong>
                                        {{ $domain['name'] }}
                                    </strong>

                                </div>


                                <div class="domain-cart-summary__row">

                                    <span>
                                        Период
                                    </span>

                                    <strong id="summaryYears">
                                        1 година
                                    </strong>

                                </div>


                                <div class="domain-cart-summary__row">

                                    <span>
                                        Обща сума
                                    </span>

                                    <strong id="summaryPrice">
                                        {{ number_format($domain['prices'][1]['purchase_price'] ?? 0, 2) }} €
                                    </strong>

                                </div>

                            </div>

                            <hr>

                            <div class="domain-cart-summary__notice">

                                <i class="fa-solid fa-circle-info"></i>

                                <p>
                                    Преди плащане ще проверим отново дали домейнът е свободен
                                    и дали цената не е променена.
                                </p>

                            </div>


                            @if (Auth::check())
                                <button type="submit" class="tg-btn tg-btn-two domain-cart-summary__checkout">
                                    Продължи към плащане
                                </button>
                            @else
                                <p class="alert alert-danger rounded-4">
                                    За да продължите към плащане е нужно да сте влезли във вашия акаунт.
                                </p>

                                <div class="domain-payment-login">

                                    <a href="{{ route('login') }}"
                                        class="tg-btn tg-btn-two domain-cart-summary__checkout">
                                        Вход
                                    </a>

                                    <a href="{{ route('register') }}"
                                        class="tg-btn tg-btn-two domain-cart-summary__checkout">
                                        Регистрация
                                    </a>

                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif

                        </div>
                    </form>



                </div>
            @else
                <div class="domain-cart-empty">

                    <div class="domain-cart-empty__icon">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>

                    <h3>
                        Количката ви е празна
                    </h3>

                    <p>
                        Все още не сте добавили домейн в количката.
                    </p>

                    <a href="{{ route('domain') }}" class="tg-btn tg-btn-two">
                        Потърси домейн
                    </a>

                </div>

            @endif

        </div>
    </section>


    <script>
        $(document).ready(function() {

            $('#domainYears').on('change', function() {

                const selectedOption = $(this).find(':selected');

                const years = Number($(this).val());
                const purchasePrice = Number(selectedOption.data('purchase-price'));
                const renewalPrice = Number(selectedOption.data('renewal-price'));
                const premium = Number(selectedOption.data('premium'));

                $('#domainPurchasePrice').text(
                    purchasePrice.toFixed(2) + ' €'
                );

                $('#domainRenewalPrice').text(
                    renewalPrice.toFixed(2) + ' €'
                );

                $('#domainType').text(
                    premium === 1 ?
                    'Premium' :
                    'Стандартен'
                );

                $('#summaryYears').text(
                    years === 1 ?
                    '1 година' :
                    years + ' години'
                );

                $('#summaryPrice').text(
                    purchasePrice.toFixed(2) + ' €'
                );

                $('#selectedYears').val(years);

            });

        });
    </script>

</x-frontend>
