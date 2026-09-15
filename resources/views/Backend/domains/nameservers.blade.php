<x-backend>

    @section('SEO')
        <title>Nameservers</title>
    @endsection


    <section class="backend-domains backend-nameservers">
        <div class="container">

            <div class="backend-domains__header">

                <div class="backend-domains__heading">
                    <span class="backend-domains__subtitle">
                        Управление на домейн
                    </span>

                    <h2>
                        Nameservers
                    </h2>

                    <p>
                        Управлявайте nameserver настройките на вашия домейн.
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
                            Nameservers за
                            <span>{{ $domain['domainName'] ?? 'domain.com' }}</span>
                        </h4>

                        <span>
                            Управление на DNS сървърите на домейна
                        </span>
                    </div>

                </div>


                <div class="backend-nameservers__content">

                    <div class="backend-nameservers__info">

                        <div class="backend-nameservers__info-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>

                        <div>
                            <h5>
                                Какво представляват Nameservers?
                            </h5>

                            <p>
                                Nameservers определят къде се управляват DNS записите на вашия домейн.
                                При промяна на nameserver настройките е възможно да бъде необходимо време,
                                преди промените да се разпространят напълно.
                            </p>
                        </div>

                    </div>

                    {{-- @dd($domain) --}}
                    <form method="POST"
                        action="{{ route('backend.domain.update.nameservers', $domain['domainName']) }}"
                        class="backend-nameservers__form">

                        @csrf
                        @method('PUT')


                        <div class="backend-nameservers__form-header">

                            <div>
                                <h4>
                                    Nameserver настройки
                                </h4>

                                <p>
                                    Въведете до четири nameserver адреса за този домейн.
                                </p>
                            </div>

                        </div>


                        @if (session('success'))
                            <div class="alert alert-success m-3 w-fit">
                                {{ session('success') }}
                            </div>
                        @endif

                        @error('nameservers')
                            <div class="alert alert-danger m-3 w-fit">
                                {{ $message }}
                            </div>
                        @enderror


                        <div class="backend-nameservers__fields">


                            {{-- Nameserver 1 --}}
                            <div class="backend-nameservers__field">

                                <div class="backend-nameservers__field-number">
                                    1
                                </div>

                                <div class="backend-nameservers__field-content">

                                    <label for="nameserver_1">
                                        Nameserver 1
                                    </label>

                                    <div class="backend-nameservers__input-wrapper">

                                        <i class="fa-solid fa-server"></i>

                                        <input type="text" name="nameservers[]" id="nameserver_1"
                                            class="backend-dns-records__input backend-nameservers__input"
                                            value="{{ old('nameservers.0', $domain['nameservers'][0] ?? '') }}"
                                            placeholder="ns1.example.com" autocomplete="off">

                                    </div>

                                </div>

                            </div>


                            {{-- Nameserver 2 --}}
                            <div class="backend-nameservers__field">

                                <div class="backend-nameservers__field-number">
                                    2
                                </div>

                                <div class="backend-nameservers__field-content">

                                    <label for="nameserver_2">
                                        Nameserver 2
                                    </label>

                                    <div class="backend-nameservers__input-wrapper">

                                        <i class="fa-solid fa-server"></i>

                                        <input type="text" name="nameservers[]" id="nameserver_2"
                                            class="backend-dns-records__input backend-nameservers__input"
                                            value="{{ old('nameservers.1', $domain['nameservers'][1] ?? '') }}"
                                            placeholder="ns2.example.com" autocomplete="off">

                                    </div>

                                </div>

                            </div>


                            {{-- Nameserver 3 --}}
                            <div class="backend-nameservers__field">

                                <div class="backend-nameservers__field-number">
                                    3
                                </div>

                                <div class="backend-nameservers__field-content">

                                    <label for="nameserver_3">
                                        Nameserver 3
                                    </label>

                                    <div class="backend-nameservers__input-wrapper">

                                        <i class="fa-solid fa-server"></i>

                                        <input type="text" name="nameservers[]" id="nameserver_3"
                                            class="backend-dns-records__input backend-nameservers__input"
                                            value="{{ old('nameservers.2', $domain['nameservers'][2] ?? '') }}"
                                            placeholder="ns3.example.com" autocomplete="off">

                                    </div>

                                </div>

                            </div>


                            {{-- Nameserver 4 --}}
                            <div class="backend-nameservers__field">

                                <div class="backend-nameservers__field-number">
                                    4
                                </div>

                                <div class="backend-nameservers__field-content">

                                    <label for="nameserver_4">
                                        Nameserver 4
                                    </label>

                                    <div class="backend-nameservers__input-wrapper">

                                        <i class="fa-solid fa-server"></i>

                                        <input type="text" name="nameservers[]" id="nameserver_4"
                                            class="backend-dns-records__input backend-nameservers__input"
                                            value="{{ old('nameservers.3', $domain['nameservers'][3] ?? '') }}"
                                            placeholder="ns4.example.com" autocomplete="off">

                                    </div>

                                </div>

                            </div>


                        </div>


                        <div class="backend-nameservers__actions">

                            <button type="submit" class="tg-btn tg-btn-two backend-nameservers__submit">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Запази Nameservers
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </section>



</x-backend>
