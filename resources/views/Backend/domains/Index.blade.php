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
                                    <th>Заключен за преместване</th>
                                    <th>Действие</th>
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

                                                    <small>Регистриран домейн</small>

                                                    <div class="domain-lock-message"
                                                        id="domain-lock-message-{{ $domain->id }}" role="status"
                                                        aria-live="polite"></div>

                                                </div>
                                            </div>
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($domain->status === \App\Models\Domain::STATUSES['active'])
                                                <div class="backend-domain-status backend-domain-status--active">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                    {{ \App\Models\Domain::STATUSES['active'] }}
                                                </div>
                                            @elseif ($domain->status === \App\Models\Domain::STATUSES['expired'])
                                                <div class="backend-domain-status backend-domain-status--expired">
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                    {{ \App\Models\Domain::STATUSES['expired'] }}
                                                </div>
                                            @elseif ($domain->status === \App\Models\Domain::STATUSES['pending'])
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

                                        {{-- Domain Lock --}}
                                        <td>
                                            <div class="domain-lock-control">

                                                <div class="toggle">
                                                    <input type="checkbox" id="domain-lock-{{ $domain->id }}"
                                                        class="domain-lock-toggle"
                                                        data-domain="{{ $domain->domain_name }}"
                                                        data-domain-id="{{ $domain->id }}"
                                                        aria-label="Заключване на {{ $domain->domain_name }}"
                                                        {{ $domain->is_domain_locked ? 'checked' : '' }} />

                                                    <label for="domain-lock-{{ $domain->id }}"></label>
                                                </div>

                                                <span class="domain-lock-label"
                                                    id="domain-lock-label-{{ $domain->id }}">
                                                    {{ $domain->is_domain_locked ? 'Заключен' : 'Отключен' }}
                                                </span>

                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            <div class="backend-domain-table__actions">

                                                <a class="backend-domain-table__action backend-domain-table__action--primary"
                                                    href="{{ route('backend.domain.manage', $domain->domain_name) }}">
                                                    Управление на домейн
                                                </a>

                                                {{-- <a href="{{ route('backend.domain.dns-records', $domain->domain_name) }}"
                                                    class="backend-domain-table__action backend-domain-table__action--primary">
                                                    DNS записи
                                                </a>

                                                <a href="{{ route('backend.domain.nameservers', $domain->domain_name) }}"
                                                    class="backend-domain-table__action backend-domain-table__action--primary">
                                                    Nameservers
                                                </a> --}}

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


    <script>
        $(document).ready(function() {

            $('.domain-lock-toggle').on('change', function() {

                const toggle = $(this);
                const domainName = toggle.data('domain');
                const domainId = toggle.data('domain-id');
                const locked = toggle.is(':checked');

                const messageElement = $('#domain-lock-message-' + domainId);
                const labelElement = $('#domain-lock-label-' + domainId);

                toggle.prop('disabled', true);

                messageElement
                    .text('Настройката се обновява...')
                    .attr('class', 'domain-lock-message domain-lock-message--loading');

                $.ajax({
                    url: "{{ route('backend.domain.change-lock') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        domain_name: domainName,
                        locked: locked ? 1 : 0
                    },
                    success: function(response) {


                        if (response.success) {

                            toggle.prop('checked', response.is_domain_locked);

                            labelElement.text(
                                response.is_domain_locked ? 'Заключен' : 'Отключен'
                            );

                            messageElement
                                .text(response.message)
                                .attr('class',
                                    'domain-lock-message domain-lock-message--success');

                        } else {

                            toggle.prop('checked', !locked);

                            messageElement
                                .text(response.message)
                                .attr('class',
                                'domain-lock-message domain-lock-message--error');

                        }

                    },
                    error: function(xhr) {

                        toggle.prop('checked', !locked);

                        const message = xhr.responseJSON?.message ||
                            'Възникна грешка при обновяването на домейна.';

                        messageElement
                            .text(message)
                            .attr('class', 'domain-lock-message domain-lock-message--error');

                    },
                    complete: function() {
                        toggle.prop('disabled', false);
                    }
                });

            });

        });
    </script>


</x-backend>
