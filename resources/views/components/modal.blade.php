@props([
    'title',
    'message',
    'primaryUrl' => '#',
    'primaryText' => 'Продължи',
    'secondaryUrl' => '#',
    'secondaryText' => 'Затвори',
])

<div class="modal-custom" id="cartSuccessModal">

    <div class="modal-custom__dialog">

        <div class="modal-custom__content">

            <button
                type="button"
                class="modal-custom__close"
                onclick="document.getElementById('cartSuccessModal').remove()"
                aria-label="Затвори"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="modal-custom__body">

                <div class="modal-custom__icon modal-custom__icon--success">
                    <i class="fa-solid fa-check"></i>
                </div>

                <h4 class="modal-custom__title">
                    {{ $title }}
                </h4>

                <p class="modal-custom__message">
                    {{ $message }}
                </p>

                <div class="modal-custom__actions">

                    <a href="{{ $primaryUrl }}" class="tg-btn tg-btn-two">
                        {{ $primaryText }}
                    </a>

                    <a href="{{ $secondaryUrl }}" class="modal-custom__secondary-btn">
                        {{ $secondaryText }}
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>
