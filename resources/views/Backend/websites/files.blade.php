<x-backend>

    @section('SEO')
        <title>File Manager - {{ $domain->domain_name }}</title>
    @endsection

    <section class="file-manager">

        <div class="container">

            <div class="file-manager__header">

                <div>
                    <h2>{{ $domain->domain_name }}</h2>

                    <p>
                        Управлявайте файловете на вашия уебсайт.
                    </p>
                </div>

            </div>

            <div class="file-manager__workspace">

                {{-- LEFT SIDEBAR --}}
                <aside class="file-manager__sidebar">

                    <div class="file-manager__sidebar-header">

                        <div>
                            <span>EXPLORER</span>
                        </div>

                        <div class="file-manager__sidebar-actions">

                            <button type="button" title="Нов файл">
                                <i class="fa-regular fa-file"></i>
                            </button>

                            <button type="button" title="Нова папка">
                                <i class="fa-regular fa-folder"></i>
                            </button>

                            <button type="button" title="Обнови">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>

                        </div>

                    </div>

                    <div class="file-manager__tree">

                        <div class="file-tree-root">

                            <button
                                type="button"
                                class="file-tree-item file-tree-item--folder file-tree-root__button"
                                data-folder-toggle
                            >
                                <span class="file-tree-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>

                                <span class="file-tree-icon">
                                    <i class="fa-solid fa-folder-open"></i>
                                </span>

                                <span class="file-tree-name">
                                    public_html
                                </span>
                            </button>

                            <div class="file-tree-children">

                                @foreach ($files as $file)

                                    @include('Backend.websites.partials.file-tree', [
                                        'item' => $file,
                                        'level' => 1,
                                        'rootPath' => $rootPath,
                                        'domain' => $domain,
                                    ])

                                @endforeach

                            </div>

                        </div>

                    </div>

                </aside>


                {{-- MAIN EDITOR AREA --}}
                <main class="file-manager__main">

                    <div class="file-manager__tabs">

                        <div class="file-manager__empty-tab">

                            @if ($currentPath)
                                {{ basename($currentPath) }}
                            @else
                                Няма отворен файл
                            @endif

                        </div>

                    </div>


                    <div class="file-manager__editor">

                        @if ($fileContent !== null)

                            {{-- MONACO EDITOR --}}
                            <div
                                id="editor"
                                style="width: 100%; height: 100%;"
                            ></div>

                        @else

                            {{-- NO FILE SELECTED --}}
                            <div class="file-manager__editor-empty">

                                <div class="file-manager__editor-empty-icon">
                                    <i class="fa-solid fa-code"></i>
                                </div>

                                <h3>Изберете файл</h3>

                                <p>
                                    Кликнете върху файл отляво, за да го отворите в редактора.
                                </p>

                            </div>

                        @endif

                    </div>

                </main>

            </div>

        </div>

    </section>


    {{-- MONACO --}}
    @if ($fileContent !== null)

        <script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.55.1/min/vs/loader.js"></script>

        <script>
            require.config({
                paths: {
                    vs: 'https://cdn.jsdelivr.net/npm/monaco-editor@0.55.1/min/vs'
                }
            });

            require(['vs/editor/editor.main'], function() {

                window.editor = monaco.editor.create(
                    document.getElementById('editor'),
                    {
                        value: @json($fileContent),
                        language: 'html',
                        theme: 'vs-dark',
                        automaticLayout: true,
                        fontSize: 14,

                        minimap: {
                            enabled: true
                        }
                    }
                );

            });
        </script>

    @endif


    {{-- FOLDER OPEN / CLOSE --}}
    <script>
        document.addEventListener('click', function(event) {

            const folder = event.target.closest('[data-folder-toggle]');

            if (!folder) {
                return;
            }

            const wrapper = folder.closest('.file-tree-node, .file-tree-root');

            if (!wrapper) {
                return;
            }

            const children = wrapper.querySelector(':scope > .file-tree-children');

            if (!children) {
                return;
            }

            wrapper.classList.toggle('is-collapsed');

            const arrow = folder.querySelector('.file-tree-arrow i');
            const folderIcon = folder.querySelector('.file-tree-icon i');

            if (wrapper.classList.contains('is-collapsed')) {

                arrow?.classList.replace(
                    'fa-chevron-down',
                    'fa-chevron-right'
                );

                if (folderIcon) {
                    folderIcon.classList.replace(
                        'fa-folder-open',
                        'fa-folder'
                    );
                }

            } else {

                arrow?.classList.replace(
                    'fa-chevron-right',
                    'fa-chevron-down'
                );

                if (folderIcon) {
                    folderIcon.classList.replace(
                        'fa-folder',
                        'fa-folder-open'
                    );
                }

            }

        });
    </script>

</x-backend>
