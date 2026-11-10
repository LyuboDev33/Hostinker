<x-backend>

    @section('SEO')
        <title>Управление на {{ $domain->domain_name }}</title>
        <meta name="robots" content="noindex,nofollow">
    @endsection

    <div class="domain-manage">

        <div class="domain-manage__container">

            <div class="domain-manage__heading">
                <div>
                    <span class="domain-manage__eyebrow">МОИТЕ ДОМЕЙНИ</span>
                    <h1>Управление на домейн</h1>
                    <p>Всичко необходимо за управлението на вашия домейн на едно място.</p>
                </div>
            </div>

            <div class="domain-manage__grid">

                {{-- LEFT COLUMN --}}
                <div class="domain-manage__main">

                    <div class="domain-manage__card">

                        <div class="domain-manage__card-heading">
                            <h2>Нека {{ $domain->domain_name }} работи за вас</h2>
                            <p>Настройте вашия домейн и започнете да изграждате онлайн присъствието си.</p>
                        </div>

                        <div class="domain-manage__chips">
                            <span class="domain-manage__chip domain-manage__chip--active">
                                <i class="fa-solid fa-briefcase"></i>
                                За бизнеса
                            </span>

                            <span class="domain-manage__chip">
                                <i class="fa-regular fa-envelope"></i>
                                За имейл
                            </span>

                            <span class="domain-manage__chip">
                                <i class="fa-solid fa-shield-halved"></i>
                                Защита
                            </span>
                        </div>

                        <div class="domain-manage__feature-list">

                            <div class="domain-manage__feature">
                                <div class="domain-manage__feature-icon domain-manage__feature-icon--green">
                                    <i class="fa-solid fa-display"></i>
                                </div>

                                <div class="domain-manage__feature-content">
                                    <h3>Управление на уебсайт</h3>
                                    <p>Свържете домейна с вашия уебсайт и го направете достъпен онлайн.</p>
                                </div>

                                <a href="#" class="domain-manage__outline-button">
                                    Управление
                                </a>
                            </div>

                            <div class="domain-manage__feature">
                                <div class="domain-manage__feature-icon domain-manage__feature-icon--green">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>

                                <div class="domain-manage__feature-content">
                                    <h3>Професионален имейл</h3>
                                    <p>Използвайте имейл адрес със собствения си домейн.</p>
                                </div>

                                <a href="#" class="domain-manage__outline-button">
                                    Настройки
                                </a>
                            </div>

                        </div>

                    </div>

                    {{-- SECURITY AND TRANSFER --}}
                    <div class="domain-manage__card" id="domain-security">

                        <div class="domain-manage__section-heading">
                            <div>
                                <h2>Сигурност и трансфер</h2>
                                <p>Управлявайте защитата на домейна и настройките за прехвърляне.</p>
                            </div>
                        </div>

                        <div class="domain-manage__setting">

                            <div class="domain-manage__setting-icon">
                                <i class="fa-solid fa-lock"></i>
                            </div>

                            <div class="domain-manage__setting-content">
                                <h3>Заключване на домейна</h3>
                                <p>Предпазва домейна от неоторизирано прехвърляне към друг регистратор.</p>
                            </div>

                            <div class="domain-manage__setting-action">
                                <label class="domain-manage__switch">
                                    <input type="checkbox" id="domain-lock"
                                        {{ $domain->is_domain_locked ? 'checked' : '' }}>
                                    <span class="domain-manage__switch-slider"></span>
                                </label>

                                <span class="domain-manage__switch-label">
                                    {{ $domain->is_domain_locked ? 'Заключен' : 'Отключен' }}
                                </span>
                            </div>

                        </div>

                        <form action="{{ route('backend.domain.get-auth-code', $domain->domain_name) }}" method="POST"
                            class="domain-manage__setting">

                            @csrf

                            <div class="domain-manage__setting-icon">
                                <i class="fa-solid fa-key"></i>
                            </div>

                            <div class="domain-manage__setting-content">
                                <h3>Код за трансфер (EPP)</h3>
                                <p>Необходим при прехвърляне на домейна към друг регистратор.</p>
                            </div>

                            <button type="submit" class="domain-manage__outline-button">
                                Покажи кода
                            </button>

                        </form>


                        @if (session('error'))
                            <div class="domain-manage__info">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif

                        <div class="domain-manage__info">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>
                                Новорегистрираните домейни може да имат 60-дневно
                                ограничение за трансфер. Това не влияе върху
                                работата на уебсайта или имейл услугите.
                            </p>
                        </div>

                    </div>

                </div>

                {{-- RIGHT COLUMN --}}
                <aside class="domain-manage__sidebar">

                    {{-- DOMAIN OVERVIEW --}}
                    <div class="domain-manage__card">

                        <div class="domain-manage__domain-heading">
                            <h2>{{ $domain->domain_name }}</h2>

                            <span class="domain-manage__status">
                                <span></span>
                                Активен
                            </span>
                        </div>

                        <div class="domain-manage__expiration">

                            <div class="domain-manage__expiration-circle">
                                <div class="domain-manage__expiration-inner">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                            </div>

                            <div class="domain-manage__expiration-info">
                                <span>Дата на изтичане</span>
                                <h3>{{ $domain->expires_at?->format('d.m.Y') ?? '—' }}</h3>
                                <a href="#">Подновяване</a>
                            </div>

                        </div>

                        <a href="#" class="domain-manage__full-button">
                            <i class="fa-solid fa-arrow-rotate-right"></i>
                            Поднови домейна
                        </a>

                    </div>

                    {{-- DNS AND NAMESERVERS --}}
                    <div class="domain-manage__card">

                        <div class="domain-manage__sidebar-section">

                            <div class="domain-manage__sidebar-title">
                                <h3>DNS / Nameservers</h3>
                            </div>

                            <p class="domain-manage__muted">
                                Управлявайте DNS записите и сървърите на имена за вашия домейн.
                            </p>

                            <div class="domain-manage__detail">
                                <span>
                                    <i class="fa-solid fa-list-ul"></i>
                                    DNS записи
                                </span>

                                <a href="{{ route('backend.domain.dns-records', $domain->domain_name) }}">
                                    Управление на DSN записи
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                            <div class="domain-manage__detail">
                                <span>
                                    <i class="fa-solid fa-server"></i>
                                    Nameservers
                                </span>

                                <a href="{{ route('backend.domain.nameservers', $domain->domain_name) }}">
                                    Управление на Nameservers
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>

                        {{-- TRANSFER --}}
                        <div class="domain-manage__sidebar-section">

                            <div class="domain-manage__sidebar-title">
                                <h3>Трансфер</h3>
                            </div>

                            <div class="domain-manage__detail">
                                <span>Заключване</span>

                                <span class="domain-manage__pill">
                                    {{ $domain->is_domain_locked ? 'Активно' : 'Неактивно' }}
                                </span>
                            </div>

                            <div class="domain-manage__detail">
                                <span>Код за трансфер</span>
                                <a href="#domain-security">Управление</a>
                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </div>


    @if (session('auth_code'))
        <div class="domain-auth-modal">

            <div class="domain-auth-modal__overlay"></div>

            <div class="domain-auth-modal__content">

                <div class="domain-auth-modal__icon">
                    <i class="fa-solid fa-key"></i>
                </div>

                <h2>Код за трансфер (EPP)</h2>

                <p class="domain-auth-modal__description">
                    Използвайте този код при прехвърляне на домейна
                    към друг регистратор.
                </p>

                <div class="domain-auth-modal__code">
                    <span>{{ session('auth_code') }}</span>
                </div>

                <p class="domain-auth-modal__warning">
                    <i class="fa-solid fa-shield-halved"></i>
                    Не споделяйте този код с неоторизирани лица.
                </p>

                <a href="{{ route('backend.domain.manage', $domain->domain_name) }}" class="domain-auth-modal__close">
                    Затвори
                </a>

            </div>

        </div>
    @endif


</x-backend>
