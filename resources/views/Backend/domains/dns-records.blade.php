<x-backend>

    @section('SEO')
        <title>DNS записи</title>
    @endsection


    <section class="backend-domains backend-dns-records">
        <div class="container">

            <div class="backend-domains__header">

                <div class="backend-domains__heading">
                    <span class="backend-domains__subtitle">
                        Управление на DNS
                    </span>

                    <h2>
                        DNS записи
                    </h2>

                    <p>
                        Управлявайте DNS записите за домейна, добавяйте нови записи и редактирайте съществуващите
                        настройки.
                    </p>
                </div>

                <div class="backend-domains__header-action">

                    <a href="{{ route('backend.domain.index') }}" class="tg-btn tg-btn-two">
                        <i class="fa-solid fa-arrow-left"></i>
                        Назад към домейните
                    </a>

                </div>

            </div>


            <div class="backend-domains__card">

                <div class="backend-domains__card-header">

                    <div>

                        <h4>
                            DNS записи за
                            <span>{{ $domain ?? 'domain.com' }}</span>
                        </h4>

                        <span>
                            Управление на DNS зоната
                        </span>

                    </div>

                </div>


                {{-- Add DNS Record --}}
                <div class="backend-dns-records__form-wrapper">

                    <div class="backend-dns-records__form-header">

                        <div>
                            <h4>
                                Добави DNS запис
                            </h4>

                            <p>
                                Попълнете данните за новия DNS запис.
                            </p>
                        </div>

                    </div>



                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @error('dns_record')
                        <div class="alert alert-danger mb-4">
                            {{ $message }}
                        </div>
                    @enderror


                    <form method="POST"
                        action="{{ route('backend.create.dns-record', $domainName) }}"
                        class="backend-dns-records__form">

                        @csrf


                        <div class="backend-dns-records__form-grid">


                            {{-- Type --}}
                            <div class="backend-dns-records__form-group">

                                <label for="type">
                                    Тип
                                </label>

                                <select name="type" id="type" class="backend-dns-records__input">

                                    <option value="A" @selected(old('type') === 'A')>
                                        A
                                    </option>

                                    <option value="AAAA" @selected(old('type') === 'AAAA')>
                                        AAAA
                                    </option>

                                    <option value="CNAME" @selected(old('type') === 'CNAME')>
                                        CNAME
                                    </option>

                                    <option value="MX" @selected(old('type') === 'MX')>
                                        MX
                                    </option>

                                    <option value="TXT" @selected(old('type') === 'TXT')>
                                        TXT
                                    </option>

                                    <option value="SRV" @selected(old('type') === 'SRV')>
                                        SRV
                                    </option>

                                    <option value="NS" @selected(old('type') === 'NS')>
                                        NS
                                    </option>

                                    <option value="ANAME" @selected(old('type') === 'ANAME')>
                                        ANAME
                                    </option>

                                </select>

                                @error('type')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Host --}}
                            <div class="backend-dns-records__form-group">

                                <label for="host">
                                    Име / Name
                                </label>

                                <div class="backend-dns-records__host-field">

                                    <input type="text" name="host" id="host"
                                        class="backend-dns-records__input" value="{{ old('host') }}" placeholder="@">

                                    <span class="backend-dns-records__domain-suffix">
                                        .{{ $domainName ?? 'domain.com' }}
                                    </span>

                                </div>

                                @error('host')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Answer --}}
                            <div class="backend-dns-records__form-group">

                                <label for="answer">
                                    Стойност / Answer
                                </label>

                                <input type="text" name="answer" id="answer" class="backend-dns-records__input"
                                    value="{{ old('answer') }}" placeholder="Например: 192.168.1.1">

                                @error('answer')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TTL --}}
                            <div class="backend-dns-records__form-group">

                                <label for="ttl">
                                    TTL
                                </label>

                                <input type="number" name="ttl" id="ttl" value="{{ old('ttl', 300) }}"
                                    min="300" class="backend-dns-records__input">

                                @error('ttl')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Priority --}}
                            <div class="backend-dns-records__form-group" id="dns-priority-group" style="display: none;">

                                <label for="priority">
                                    Приоритет
                                </label>

                                <input type="number" name="priority" id="priority" class="backend-dns-records__input"
                                    value="{{ old('priority') }}" min="0" placeholder="Например: 10">

                                <small class="text-muted">
                                    Задължително за MX и SRV записи.
                                </small>

                                @error('priority')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Submit --}}
                            <div
                                class="backend-dns-records__form-group
                                        backend-dns-records__form-group--button">

                                <button type="submit" class="tg-btn tg-btn-two backend-dns-records__submit">

                                    <i class="fa-solid fa-plus"></i>

                                    Добави

                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- Records Table --}}
                <div class="backend-dns-records__table-section">

                    <div class="backend-dns-records__table-header">

                        <div>
                            <h4>
                                Съществуващи DNS записи
                            </h4>

                            <span>
                                {{ isset($dnsRecords['records']) ? count($dnsRecords['records']) : 0 }}
                                DNS записа
                            </span>
                        </div>

                    </div>


                    @if (!empty($dnsRecords['records']))

                        <div class="backend-domains__table-wrapper">

                            <table class="backend-domains__table backend-dns-records__table">

                                <thead>

                                    <tr>
                                        <th>Тип</th>
                                        <th>Host</th>
                                        <th>Стойност</th>
                                        <th>TTL</th>
                                        <th>Приоритет</th>
                                        <th></th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($dnsRecords['records'] as $record)
                                        <tr>

                                            {{-- Type --}}
                                            <td>

                                                <div class="backend-dns-record-type">
                                                    {{ $record['type'] ?? '-' }}
                                                </div>

                                            </td>


                                            {{-- Host --}}
                                            <td>

                                                <div class="backend-dns-record-value">

                                                    <i class="fa-solid fa-server"></i>

                                                    <span>
                                                        {{ $record['host'] ?? '-' }}
                                                    </span>

                                                </div>

                                            </td>


                                            {{-- Answer --}}
                                            <td>

                                                <div class="backend-dns-record-answer">
                                                    {{ $record['answer'] ?? '-' }}
                                                </div>

                                            </td>


                                            {{-- TTL --}}
                                            <td>

                                                <span class="backend-dns-record-ttl">
                                                    {{ $record['ttl'] ?? '-' }}
                                                </span>

                                            </td>


                                            {{-- Priority --}}
                                            <td>

                                                @if (isset($record['priority']))
                                                    <span>
                                                        {{ $record['priority'] }}
                                                    </span>
                                                @else
                                                    <span class="backend-domain-table__muted">
                                                        N/A
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- Actions --}}
                                            <td>

                                                <div class="backend-domain-table__actions">

                                                    <button type="button"
                                                        class="backend-domain-table__action backend-domain-table__action--primary">
                                                        Редактирай
                                                    </button>

                                                    <button type="button"
                                                        class="backend-domain-table__action backend-domain-table__action--danger">
                                                        Изтрий
                                                    </button>

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
                                <i class="fa-solid fa-server"></i>
                            </div>

                            <h4>
                                Няма добавени DNS записи
                            </h4>

                            <p>
                                Все още няма конфигурирани DNS записи за този домейн.
                                Добавете първия запис чрез формата по-горе.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </section>



</x-backend>
