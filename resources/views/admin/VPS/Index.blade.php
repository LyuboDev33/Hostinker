<x-backend>
    @section('SEO')
        <title>VPS сървъри</title>
    @endsection

    <section class="hosting-admin">
        <div class="container">

            <div class="hosting-admin__header">
                <div>
                    <span class="hosting-admin__eyebrow">
                        <i class="fa-solid fa-server"></i>
                        Администрация
                    </span>

                    <h1>VPS сървъри</h1>

                    <p>
                        Добавяйте и управлявайте VPS сървърите,
                        които обслужват хостинг акаунтите на клиентите.
                    </p>
                </div>

                <div class="hosting-admin__count">
                    <span>{{ $vpsServers->total() }}</span>
                    <small>Общо сървъри</small>
                </div>
            </div>

            @if (session('success'))
                <div class="hosting-admin__alert hosting-admin__alert--success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="hosting-admin__alert hosting-admin__alert--error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="hosting-admin__layout">

                {{-- CREATE VPS --}}
                <div class="hosting-admin-card">

                    <div class="hosting-admin-card__header">
                        <div class="hosting-admin-card__header-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>

                        <div>
                            <h3>Нов VPS сървър</h3>
                            <p>Въведете данните за SSH връзка.</p>
                        </div>
                    </div>

                    <form action="{{ route('super_admin.vps.store') }}" method="POST" class="hosting-plan-form">

                        @csrf

                        <div class="hosting-form-group">
                            <label for="host">IP адрес / Hostname</label>

                            <div class="hosting-form-input">
                                <i class="fa-solid fa-network-wired"></i>

                                <input type="text" id="host" name="host" value="{{ old('host') }}"
                                    placeholder="Например: 192.0.2.10" required>
                            </div>

                            @error('host')
                                <span class="hosting-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="hosting-form-group">
                            <label for="port">SSH порт</label>

                            <div class="hosting-form-input">
                                <i class="fa-solid fa-plug"></i>

                                <input type="number" id="port" name="port" value="{{ old('port', 22) }}"
                                    min="1" max="65535" required>
                            </div>

                            @error('port')
                                <span class="hosting-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="hosting-form-group">
                            <label for="username">SSH потребител</label>

                            <div class="hosting-form-input">
                                <i class="fa-solid fa-user"></i>

                                <input type="text" id="username" name="username" value="{{ old('username') }}"
                                    placeholder="Например: root" autocomplete="off" required>
                            </div>

                            @error('username')
                                <span class="hosting-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="hosting-form-group">
                            <label for="password">SSH парола</label>

                            <div class="hosting-form-input">
                                <i class="fa-solid fa-lock"></i>

                                <input type="password" id="password" name="password"
                                    placeholder="Въведете SSH паролата" autocomplete="new-password" required>
                            </div>

                            <small class="hosting-form-help">
                                Паролата ще бъде съхранена в криптиран вид.
                            </small>

                            @error('password')
                                <span class="hosting-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- VPS CAPACITY --}}
                        <div class="hosting-form-group">
                            <label for="capacity_gb">Максимално дисково пространство</label>

                            <div class="hosting-form-input hosting-form-input--suffix">
                                <i class="fa-solid fa-hard-drive"></i>

                                <input type="number" id="capacity_gb" name="capacity_gb"
                                    value="{{ old('capacity_gb') }}" min="1" step="1"
                                    placeholder="Например: 90" required>

                                <span>GB</span>
                            </div>

                            <small class="hosting-form-help">
                                Максималното дисково пространство, което може да бъде разпределено
                                между хостинг акаунтите на този VPS.
                            </small>

                            @error('capacity_gb')
                                <span class="hosting-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="tg-btn hosting-plan-form__submit">
                            <i class="fa-solid fa-plus"></i>
                            Добави VPS сървър
                        </button>
                    </form>
                </div>

                {{-- EXISTING VPS --}}
                <div class="hosting-admin-card hosting-admin-card--plans">

                    <div class="hosting-admin-card__header">
                        <div class="hosting-admin-card__header-icon">
                            <i class="fa-solid fa-server"></i>
                        </div>

                        <div>
                            <h3>Съществуващи VPS сървъри</h3>
                            <p>Всички добавени сървъри и техните хостинг акаунти.</p>
                        </div>
                    </div>

                    @if ($vpsServers->isEmpty())
                        <div class="hosting-plans-empty">
                            <div class="hosting-plans-empty__icon">
                                <i class="fa-solid fa-server"></i>
                            </div>

                            <h4>Все още няма VPS сървъри</h4>
                            <p>Добавете първия VPS сървър чрез формата.</p>
                        </div>
                    @else
                        <div class="hosting-plans-list">
                            @foreach ($vpsServers as $vps)
                                <div class="hosting-plan-item">

                                    <div class="hosting-plan-item__main">
                                        <div class="hosting-plan-item__icon">
                                            <i class="fa-solid fa-server"></i>
                                        </div>

                                        <div class="hosting-plan-item__info">
                                            <div class="hosting-plan-item__title">
                                                <h4>{{ $vps->host }}</h4>
                                            </div>

                                            <div class="hosting-plan-item__meta">
                                                <span>
                                                    <i class="fa-solid fa-user"></i>
                                                    {{ $vps->username }}
                                                </span>

                                                <span>
                                                    <i class="fa-solid fa-plug"></i>
                                                    SSH: {{ $vps->port }}
                                                </span>

                                                <span>
                                                    <i class="fa-regular fa-calendar"></i>
                                                    {{ $vps->created_at->format('d.m.Y') }}
                                                </span>
                                            </div>

                                            <div class="hosting-plan-item__stripe">
                                                <i class="fa-solid fa-shield-halved"></i>
                                                <span>SSH данните са защитени</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hosting-plan-item__pricing">
                                        <div class="hosting-plan-price">
                                            <span class="hosting-plan-price__label">
                                                Хостинг акаунти
                                            </span>

                                            <div>
                                                <strong>{{ $vps->hosting_accounts_count }}</strong>
                                                <span>акаунта</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        @if ($vpsServers->hasPages())
                            <div class="hosting-admin__pagination mt-4">
                                {{ $vpsServers->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </section>
</x-backend>
