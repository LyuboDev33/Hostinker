<x-frontend>

      <!-- error-area -->
        <section class="error__area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="error__content">
                            <h2 class="title">Успешно плащане!</h2>
                            <p>Домейнът беше закупен успешно.</p>
                            <a href="{{ route('backend.domain.index') }}" class="tg-btn tg-btn-two">
                                Към домейните
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
