<x-backend>

    @section('SEO')
        <title>Моите домейни</title>
    @endsection


    <section class="backend-domains">
        <div class="container">

            <div class="backend-domains__header">

                <div class="backend-domains__heading">
                    <span class="backend-domains__subtitle">Управление на домейни</span>
                    <h2>Моите домейни</h2>
                    <p>Преглеждайте статуса, срока на регистрация и настройките на всички домейни във вашия акаунт.</p>
                </div>

                <div class="backend-domains__header-action">
                    <a href="#" class="tg-btn tg-btn-two">
                        <i class="fa-solid fa-plus"></i>
                        Регистрирай домейн
                    </a>
                </div>

            </div>


            <div class="backend-domains__card">

                <div class="backend-domains__card-header">

                    <div>
                        <h4>Вашите домейни</h4>
                        <span>{{ $domains->count() }} {{ $domains->count() === 1 ? 'домейн' : 'домейна' }}</span>
                    </div>

                </div>


                @if ($domains->isNotEmpty())

                    <div class="backend-domains__table-wrapper">

                        <table class="backend-domains__table">

                            <thead>
                                <tr>
                                    <th>Домейн</th>
                                    <th>Статус</th>
                                    <th>Дата на изтичане</th>
                                    <th>Автоматично подновяване</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($domains as $domain)
                                    <tr>

                                        <td>

                                            <div class="backend-domain-table__domain">

                                                <div class="backend-domain-table__icon">
                                                    <i class="fa-solid fa-globe"></i>
                                                </div>

                                                <div class="backend-domain-table__domain-info">

                                                    <div class="backend-domain-table__domain-name">

                                                        <span>{{ $domain->domain_name }}</span>

                                                        <a href="https://{{ $domain->domain_name }}" target="_blank"
                                                            rel="noopener noreferrer" title="Отвори домейна">
                                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                        </a>

                                                    </div>

                                                    <small>
                                                        Регистриран домейн
                                                    </small>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @if (!empty($domain->status))
                                                @if ($domain->status === 'active')
                                                    <div class="backend-domain-status backend-domain-status--active">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                        {{ \App\Models\Domain::STATUSES['active'] }}
                                                    </div>
                                                @elseif ($domain->status === 'expired')
                                                    <div class="backend-domain-status backend-domain-status--expired">
                                                        <i class="fa-solid fa-circle-exclamation"></i>
                                                        {{ \App\Models\Domain::STATUSES['expired'] }}
                                                    </div>
                                                @elseif ($domain->status === 'pending')
                                                    <div class="backend-domain-status backend-domain-status--pending">
                                                        <i class="fa-regular fa-clock"></i>
                                                        {{ \App\Models\Domain::STATUSES['pending'] }}
                                                    </div>
                                                @else
                                                    <div class="backend-domain-status backend-domain-status--neutral">
                                                        <i class="fa-regular fa-circle-question"></i>
                                                        {{ \App\Models\Domain::STATUSES['neutral'] }}
                                                    </div>
                                                @endif
                                            @else
                                                <div class="backend-domain-status backend-domain-status--neutral">
                                                    <i class="fa-regular fa-circle-question"></i>
                                                    {{ \App\Models\Domain::STATUSES['neutral'] }}
                                                </div>
                                            @endif

                                        </td>


                                        {{-- Expiration --}}
                                        <td>

                                            <div class="backend-domain-table__date">

                                                <i class="fa-regular fa-calendar"></i>

                                                @if (!empty($domain->expires_at))
                                                    <span>{{ $domain->expires_at }}</span>
                                                @else
                                                    <span class="backend-domain-table__muted">Няма налична дата</span>
                                                @endif

                                            </div>

                                        </td>


                                        {{-- Auto renewal --}}
                                        <td>

                                            @if (isset($domain->auto_renew))
                                                @if ($domain->auto_renew)
                                                    <div class="backend-domain-renewal backend-domain-renewal--active">
                                                        <span class="backend-domain-renewal__dot"></span>
                                                        Включено
                                                    </div>
                                                @else
                                                    <div class="backend-domain-renewal">
                                                        <span class="backend-domain-renewal__dot"></span>
                                                        Изключено
                                                    </div>
                                                @endif
                                            @else
                                                <div class="backend-domain-renewal backend-domain-renewal--unknown">
                                                    <span class="backend-domain-renewal__dot"></span>
                                                    Няма информация
                                                </div>
                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td>

                                            <div class="backend-domain-table__actions">

                                                <a href="{{ route('backend.domain.dns-records', $domain->domain_name) }}"
                                                    class="backend-domain-table__action backend-domain-table__action--primary">
                                                    DNS записи
                                                </a>

                                                <a href="{{ route('backend.domain.nameservers', $domain->domain_name) }}"
                                                    class="backend-domain-table__action backend-domain-table__action--primary">
                                                    Nameservers
                                                </a>


                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <div class="backend-domains__empty">

                        <div class="backend-domains__empty-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>

                        <h4>Все още нямате регистрирани домейни</h4>

                        <p>Регистрирайте нов домейн и той ще се появи тук заедно със статуса, срока на регистрация и
                            настройките за подновяване.</p>

                        <a href="#" class="tg-btn tg-btn-two">
                            <i class="fa-solid fa-plus"></i>
                            Регистрирай първия си домейн
                        </a>

                    </div>

                @endif

            </div>

        </div>
    </section>

</x-backend>
