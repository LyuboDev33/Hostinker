
<x-backend>

    @section('SEO')
        <title>Моите уебсайтове</title>
    @endsection

    <section class="backend-domains">
        <div class="container">

            <div class="backend-domains__header">
                <div class="backend-domains__heading">
                    <span class="backend-domains__subtitle">Управление на уебсайтове</span>
                    <h2>Моите уебсайтове</h2>
                    <p>Преглеждайте и управлявайте всички ваши уебсайтове, свързани с вашия акаунт.</p>
                </div>

                <div class="backend-domains__header-action">
                    <div class="dropdown">
                        <button
                            type="button"
                            class="tg-btn tg-btn-two dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-plus"></i>
                            Създай уебсайт
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-code me-2"></i>
                                    Custom PHP/HTML website
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-brands fa-wordpress me-2"></i>
                                    WordPress website
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="backend-domains__card">

                <div class="backend-domains__card-header">
                    <div>
                        <h4>Уебсайтове</h4>
                        <span>
                            {{ $websites->count() }}
                            {{ $websites->count() === 1 ? 'уебсайт' : 'уебсайта' }}
                        </span>
                    </div>
                </div>

                @if ($websites->isNotEmpty())

                    <div class="backend-domains__list">

                        @foreach ($websites as $domain)

                            <div class="backend-domain-row">

                                <div class="backend-domain-row__main">

                                    <div class="backend-domain-row__icon">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>

                                    <div class="backend-domain-row__content">

                                        <div class="backend-domain-row__name">
                                            <span>{{ $domain->domain_name }}</span>

                                            <a href="{{ route('backend.websites.show', $domain->domain_name) }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               title="Отвори уебсайта">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </div>

                                        <div class="backend-domain-row__meta">

                                            <span>
                                                <i class="fa-regular fa-calendar"></i>

                                                @if ($domain->created_at)
                                                    Добавен на {{ $domain->created_at->format('d.m.Y') }}
                                                @else
                                                    Дата на добавяне не е налична
                                                @endif
                                            </span>

                                            <span>
                                                <i class="fa-solid fa-user"></i>
                                                Ваш уебсайт
                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="backend-domain-row__actions">

                                    <a href="{{ route('backend.websites.show', $domain->domain_name) }}"
                                       class="backend-domain-row__button">
                                        <i class="fa-solid fa-gear"></i>
                                        Управление
                                    </a>

                                    <button
                                        type="button"
                                        class="backend-domain-row__more"
                                        aria-label="Още действия">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="backend-domains__empty">

                        <div class="backend-domains__empty-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>

                        <h4>Все още нямате сайтове</h4>

                        <p>
                            Създайте своя първи уебсайт, като изберете
                            между Custom PHP/HTML или WordPress.
                        </p>

                        <div class="dropdown">
                            <button
                                type="button"
                                class="tg-btn tg-btn-two dropdown-toggle"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-plus"></i>
                                Създай уебсайт
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-solid fa-code me-2"></i>
                                        Custom PHP/HTML website
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-brands fa-wordpress me-2"></i>
                                        WordPress website
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                @endif

            </div>

        </div>
    </section>

</x-backend>
