@if ($item['type'] === 'directory')

    <div class="file-tree-node {{ $item['is_open'] ? '' : 'is-collapsed' }}">

        <button
            type="button"
            class="file-tree-item file-tree-item--folder"
            data-folder-toggle
            style="--tree-level: {{ $level }}"
        >

            <span class="file-tree-arrow">
                <i class="fa-solid {{ $item['is_open'] ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i>
            </span>

            <span class="file-tree-icon">
                <i class="fa-solid {{ $item['is_open'] ? 'fa-folder-open' : 'fa-folder' }}"></i>
            </span>

            <span class="file-tree-name">
                {{ $item['name'] }}
            </span>

        </button>

        <div class="file-tree-children">

            @foreach ($item['children'] ?? [] as $child)

                @include('Backend.websites.partials.file-tree', [
                    'item' => $child,
                    'level' => $level + 1,
                    'domain' => $domain,
                ])

            @endforeach

        </div>

    </div>

@else

    <a
        href="{{ route('backend.files.show', [
            'domainName' => $domain->domain_name,
            'path' => $item['relative_path'],
        ]) }}"
        class="file-tree-item file-tree-item--file {{ $item['is_active'] ? 'file-tree-item--active' : '' }}"
        style="--tree-level: {{ $level }}"
    >

        <span class="file-tree-arrow file-tree-arrow--empty"></span>

        <span class="file-tree-icon">

            @switch(strtolower(pathinfo($item['name'], PATHINFO_EXTENSION)))

                @case('php')
                    <i class="fa-brands fa-php"></i>
                    @break

                @case('js')
                    <i class="fa-brands fa-js"></i>
                    @break

                @case('css')
                    <i class="fa-brands fa-css3-alt"></i>
                    @break

                @case('html')
                @case('htm')
                    <i class="fa-brands fa-html5"></i>
                    @break

                @case('png')
                @case('jpg')
                @case('jpeg')
                @case('gif')
                @case('webp')
                @case('svg')
                    <i class="fa-regular fa-image"></i>
                    @break

                @default
                    <i class="fa-regular fa-file-lines"></i>

            @endswitch

        </span>

        <span class="file-tree-name">
            {{ $item['name'] }}
        </span>

    </a>

@endif
