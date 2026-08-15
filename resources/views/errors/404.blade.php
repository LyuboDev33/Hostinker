<x-frontend>

      <!-- error-area -->
        <section class="error__area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="error__content">
                            <img src="assets/img/images/404.svg" alt="">
                            <h2 class="title">Уупссс.....</h2>
                            <p>Страницата, която търсите не съществува.</p>
                            <a href="{{ route('welcome') }}" class="tg-btn tg-btn-two">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 5.33268V3.99935C6 3.64573 6.14048 3.30659 6.39052 3.05654C6.64057 2.80649 6.97971 2.66602 7.33333 2.66602H12C12.3536 2.66602 12.6928 2.80649 12.9428 3.05654C13.1929 3.30659 13.3333 3.64573 13.3333 3.99935V11.9993C13.3333 12.353 13.1929 12.6921 12.9428 12.9422C12.6928 13.1922 12.3536 13.3327 12 13.3327H7.33333C6.97971 13.3327 6.64057 13.1922 6.39052 12.9422C6.14048 12.6921 6 12.353 6 11.9993V10.666" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2 8H10.6667L8.66667 6" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.66797 10L10.668 8" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                Към началната страница
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape">
                <img src="assets/img/images/breadcrumb_shape.png" alt="">
            </div>
        </section>
        <!-- error-area-end -->

</x-frontend>
