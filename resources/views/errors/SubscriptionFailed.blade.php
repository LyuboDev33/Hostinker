<x-frontend>

    @section('SEO')
        <title>Провалено плащане </title>
    @endsection

    <div class="section-business mb-5 mt-5 ">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6 align-self-start">
                    <div class="heading two">
                        <h2>Провалено плащане!</h2>
                    </div>
                    <div class="better-business">
                        <p>Опитът за плащането е неуспешен!</p>
                        <p>Моля свържете с нас за допълнителна информация!</p>
                        <a href="{{ route('contact') }}" class="btn">
                        Контакти
                    </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="business-img">
                        <img src="/assets/img/failed-payment.png" alt="Провалено плащане">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-frontend>
