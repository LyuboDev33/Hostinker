@props([
    'sessionKey',
    'type' => 'danger',
    'title' => null,
    'text' => null,
    'modal' => false,
])

@if (session($sessionKey))

    @if ($modal)

        <div class="modal fade" id="{{ $sessionKey }}Modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">

                        @if ($title)
                            <h5 class="modal-title">
                                {{ $title }}
                            </h5>
                        @endif

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Затвори"></button>

                    </div>

                    <div class="modal-body">

                        <div class="alert rounded-pill alert-{{ $type }} mb-3">
                            {{ session($sessionKey) }}
                        </div>

                        @if ($text)
                            <p class="mb-0 text-black">
                                {{ $text }}
                            </p>
                        @endif

                        {{ $slot }}

                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new bootstrap.Modal(document.getElementById('{{ $sessionKey }}Modal')).show();
            });
        </script>

    @else

        <div class="alert alert-{{ $type }} mt-3">
            {{ session($sessionKey) }}
        </div>

    @endif

@endif
