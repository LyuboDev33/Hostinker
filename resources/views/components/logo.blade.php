@props([
    'width' => 120,
    'mobileWidth' => 90,
])

<a href="/">
    <img
        class="d-none d-md-block"
        width="{{ $width }}"
        src="{{ asset('/assets/img/logo/logo02.svg') }}?v={{ time() }}"
        alt="Valente Logo"
    >

    <img
        class="d-block d-md-none"
        width="{{ $mobileWidth }}"
        src="{{ asset('/assets/img/logo/logo02.svg') }}?v={{ time() }}"
        alt="Valente Logo"
    >
</a>
