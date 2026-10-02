<x-backend>

    @section('SEO')
        <title>DNS записи</title>
    @endsection

    <section class="backend-domains backend-dns-records">
        <div class="container">

            <div class="backend-domains__header">
                <div class="backend-domains__heading">
                    <span class="backend-domains__subtitle">Управление на DNS</span>
                    <h2>DNS записи</h2>
                    <p>Управлявайте DNS записите за домейна, добавяйте нови записи и редактирайте съществуващите настройки.</p>
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
                        <h4>DNS записи за <span>{{ $domainName ?? 'domain.com' }}</span></h4>
                        <span>Управление на DNS зоната</span>
                    </div>
                </div>

                <div class="backend-dns-records__form-wrapper">

                    <div class="backend-dns-records__form-header">
                        <div>
                            <h4>Добави DNS запис</h4>
                            <p>Попълнете данните за новия DNS запис.</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                    @endif

                    @error('dns_record')
                        <div class="alert alert-danger mb-4">{{ $message }}</div>
                    @enderror

                    <form method="POST" action="{{ route('backend.create.dns-record', $domainName) }}" class="backend-dns-records__form">
                        @csrf

                        <div class="backend-dns-records__form-grid">

                            <div class="backend-dns-records__form-group">
                                <label for="type">Тип</label>

                                <select name="type" id="type" class="backend-dns-records__input">
                                    <option value="A" @selected(old('type') === 'A')>A</option>
                                    <option value="AAAA" @selected(old('type') === 'AAAA')>AAAA</option>
                                    <option value="CNAME" @selected(old('type') === 'CNAME')>CNAME</option>
                                    <option value="MX" @selected(old('type') === 'MX')>MX</option>
                                    <option value="TXT" @selected(old('type') === 'TXT')>TXT</option>
                                    <option value="SRV" @selected(old('type') === 'SRV')>SRV</option>
                                    <option value="NS" @selected(old('type') === 'NS')>NS</option>
                                    <option value="ANAME" @selected(old('type') === 'ANAME')>ANAME</option>
                                </select>

                                @error('type')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="backend-dns-records__form-group">
                                <label for="host">Име / Name</label>

                                <div class="backend-dns-records__host-field">
                                    <input type="text" name="host" id="host" class="backend-dns-records__input" value="{{ old('host') }}" placeholder="@">
                                    <span class="backend-dns-records__domain-suffix">.{{ $domainName ?? 'domain.com' }}</span>
                                </div>

                                @error('host')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="backend-dns-records__form-group">
                                <label for="answer">Стойност / Answer</label>
                                <input type="text" name="answer" id="answer" class="backend-dns-records__input" value="{{ old('answer') }}" placeholder="Например: 192.168.1.1">

                                @error('answer')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="backend-dns-records__form-group">
                                <label for="ttl">TTL</label>
                                <input type="number" name="ttl" id="ttl" value="{{ old('ttl', 300) }}" min="300" class="backend-dns-records__input">

                                @error('ttl')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="backend-dns-records__form-group" id="dns-priority-group" style="display: none;">
                                <label for="priority">Приоритет</label>
                                <input type="number" name="priority" id="priority" class="backend-dns-records__input" value="{{ old('priority') }}" min="0" placeholder="Например: 10">
                                <small class="text-muted">Задължително за MX и SRV записи.</small>

                                @error('priority')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="backend-dns-records__form-group backend-dns-records__form-group--button">
                                <button type="submit" class="tg-btn tg-btn-two backend-dns-records__submit">
                                    <i class="fa-solid fa-plus"></i>
                                    Добави
                                </button>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="backend-dns-records__table-section">

                    <div class="backend-dns-records__table-header">
                        <div>
                            <h4>Съществуващи DNS записи</h4>
                            <span>{{ isset($dnsRecords['records']) ? count($dnsRecords['records']) : 0 }} DNS записа</span>
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

                                        <tr class="dns-record-row" data-record-id="{{ $record['id'] }}">

                                            <td>
                                                <select name="type" class="backend-dns-records__input dns-edit-field dns-record-type-input" form="dns-update-form-{{ $record['id'] }}" disabled>
                                                    @foreach (['A', 'AAAA', 'CNAME', 'MX', 'TXT', 'SRV', 'NS', 'ANAME'] as $type)
                                                        <option value="{{ $type }}" @selected(($record['type'] ?? '') === $type)>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="host" value="{{ $record['host'] ?? '' }}" class="backend-dns-records__input dns-edit-field" form="dns-update-form-{{ $record['id'] }}" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="answer" value="{{ $record['answer'] ?? '' }}" class="backend-dns-records__input dns-edit-field" form="dns-update-form-{{ $record['id'] }}" disabled>
                                            </td>

                                            <td>
                                                <input type="number" name="ttl" value="{{ $record['ttl'] ?? 300 }}" min="300" class="backend-dns-records__input dns-edit-field" form="dns-update-form-{{ $record['id'] }}" disabled>
                                            </td>

                                            <td>
                                                <input type="number" name="priority" value="{{ $record['priority'] ?? '' }}" min="0" placeholder="N/A" class="backend-dns-records__input dns-edit-field dns-priority-input" form="dns-update-form-{{ $record['id'] }}" disabled>
                                            </td>

                                            <td>
                                                <form id="dns-update-form-{{ $record['id'] }}" method="POST" action="{{ route('backend.update.dns-record', ['domain' => $domainName, 'recordId' => $record['id']]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                </form>

                                                <form id="dns-delete-form-{{ $record['id'] }}" method="POST" action="{{ route('backend.delete.dns-record', ['domain' => $domainName, 'recordId' => $record['id']]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <div class="backend-domain-table__actions dns-normal-actions">
                                                    <button type="button" class="backend-domain-table__action backend-domain-table__action--primary dns-edit-button">
                                                        <i class="fa-solid fa-pen"></i>
                                                        Редактирай
                                                    </button>

                                                    <button type="submit" form="dns-update-form-{{ $record['id'] }}" class="backend-domain-table__action backend-domain-table__action--primary dns-save-button" style="display: none;">
                                                        <i class="fa-solid fa-floppy-disk"></i>
                                                        Запази
                                                    </button>

                                                    <button type="button" class="backend-domain-table__action dns-cancel-button" style="display: none;">
                                                        <i class="fa-solid fa-xmark"></i>
                                                        Отказ
                                                    </button>

                                                    <button type="button" class="backend-domain-table__action backend-domain-table__action--danger dns-delete-button">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Изтрий
                                                    </button>
                                                </div>

                                                <div class="dns-delete-confirmation" style="display: none;">
                                                    <p class="mb-2 text-center">Сигурни ли сте, че искате да изтриете този DNS запис?</p>

                                                    <div class="backend-domain-table__actions">
                                                        <button type="submit" form="dns-delete-form-{{ $record['id'] }}" class="backend-domain-table__action backend-domain-table__action--danger">
                                                            <i class="fa-solid fa-check"></i>
                                                            Потвърждавам
                                                        </button>

                                                        <button type="button" class="backend-domain-table__action dns-close-delete-button">
                                                            <i class="fa-solid fa-xmark"></i>
                                                            Затвори
                                                        </button>
                                                    </div>
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

                            <h4>Няма добавени DNS записи</h4>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createTypeSelect = document.getElementById('type');
            const createPriorityGroup = document.getElementById('dns-priority-group');
            const createPriorityInput = document.getElementById('priority');

            function toggleCreatePriority() {
                if (!createTypeSelect || !createPriorityGroup) return;

                const needsPriority = ['MX', 'SRV'].includes(createTypeSelect.value);
                createPriorityGroup.style.display = needsPriority ? '' : 'none';

                if (createPriorityInput) createPriorityInput.disabled = !needsPriority;
            }

            if (createTypeSelect) {
                toggleCreatePriority();
                createTypeSelect.addEventListener('change', toggleCreatePriority);
            }

            document.querySelectorAll('.dns-record-row').forEach(function (row) {
                const fields = row.querySelectorAll('.dns-edit-field');
                const typeInput = row.querySelector('.dns-record-type-input');
                const priorityInput = row.querySelector('.dns-priority-input');
                const editButton = row.querySelector('.dns-edit-button');
                const saveButton = row.querySelector('.dns-save-button');
                const cancelButton = row.querySelector('.dns-cancel-button');
                const deleteButton = row.querySelector('.dns-delete-button');
                const deleteConfirmation = row.querySelector('.dns-delete-confirmation');
                const closeDeleteButton = row.querySelector('.dns-close-delete-button');

                fields.forEach(field => field.dataset.originalValue = field.value);

                editButton.addEventListener('click', function () {
                    fields.forEach(field => field.disabled = false);

                    if (priorityInput && !['MX', 'SRV'].includes(typeInput.value)) priorityInput.disabled = true;

                    editButton.style.display = 'none';
                    deleteButton.style.display = 'none';
                    saveButton.style.display = '';
                    cancelButton.style.display = '';
                    deleteConfirmation.style.display = 'none';
                    row.classList.add('dns-record-row--editing');
                });

                cancelButton.addEventListener('click', function () {
                    fields.forEach(function (field) {
                        field.value = field.dataset.originalValue;
                        field.disabled = true;
                    });

                    editButton.style.display = '';
                    deleteButton.style.display = '';
                    saveButton.style.display = 'none';
                    cancelButton.style.display = 'none';
                    row.classList.remove('dns-record-row--editing');
                });

                typeInput.addEventListener('change', function () {
                    if (!priorityInput) return;

                    const needsPriority = ['MX', 'SRV'].includes(typeInput.value);
                    priorityInput.disabled = !needsPriority;

                    if (!needsPriority) priorityInput.value = '';
                });

                deleteButton.addEventListener('click', function () {
                    editButton.style.display = 'none';
                    deleteButton.style.display = 'none';
                    deleteConfirmation.style.display = '';
                });

                closeDeleteButton.addEventListener('click', function () {
                    deleteConfirmation.style.display = 'none';
                    editButton.style.display = '';
                    deleteButton.style.display = '';
                });
            });
        });
    </script>

</x-backend>
