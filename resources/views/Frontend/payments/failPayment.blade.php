<x-frontend>
      <!-- error-area -->
        <section class="error__area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="error__content">
                            <h2 class="title">Провалено плащане!</h2>
                            <p>Плащането се провали! Моля свържете се с нас ако имате нужда от помощ!</p>
                            <a href="{{ route('contact') }}" class="tg-btn tg-btn-two">
                                Към контактите
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape">
                <img src="/assets/img/images/breadcrumb_shape.png" alt="Breadcrump">
            </div>
        </section>
        <!-- error-area-end -->

</x-frontend>
