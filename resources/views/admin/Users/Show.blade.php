
<x-backend>

@section('SEO')
    <title>Потребителски абонамент</title>
@endsection

<div class="profile-page">

    <div>
        <div class="heading two">
            <h6>АБОНАМЕНТ</h6>

            <h2>
                Управление на потребителски абонамент
            </h2>

            <p class="pt-lg-3 pt-md-2">
                Тук можете да прегледате информацията за текущия абонаментен план на потребителя и неговия статус.
            </p>
        </div>
    </div>

    <hr>


    @if (!$subscription || !($subscription['has_subscription'] ?? false))

        <section class="profile-section mb-5">

            <div class="heading two mb-4">
                <h6>ТЕКУЩ АБОНАМЕНТ</h6>

                <h2>
                    Потребителят няма активен абонамент
                </h2>

                <p class="pt-lg-3 pt-md-2">
                    В момента към профила на този потребител няма активен абонаментен план.
                </p>
            </div>

            <div class="alert alert-warning">
                {{ $subscription['message'] ?? 'Потребителят няма активен абонаментен план в момента.' }}
            </div>

        </section>
    @else
        <section class="profile-section mb-5">

            <div class="heading two mb-4">
                <h6>ТЕКУЩ АБОНАМЕНТ</h6>

                <h2>
                    Абонамент на потребителя
                </h2>

                <p class="pt-lg-3 pt-md-2">
                    По-долу можете да видите информация за текущия абонаментен план на този потребител.
                </p>
            </div>

            <div class="content-form">

                <div class="row">

                    <div class="col-lg-4 mb-4">
                        <label>
                            План
                        </label>

                        <div class="alert alert-info mb-0">
                            <strong>
                                {{ ucfirst($subscription['name'] ?? '—') }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <label>
                            Статус
                        </label>

                        @if ($subscription['active'] ?? false)
                            <div class="alert alert-success mb-0">
                                <strong>
                                    Активен
                                </strong>
                            </div>
                        @else
                            <div class="alert alert-danger mb-0">
                                <strong>
                                    Неактивен
                                </strong>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4 mb-4">
                        <label>
                            Начало на абонамента
                        </label>

                        <div class="alert alert-light mb-0">
                            <strong>
                                {{ $subscription['started_at'] ?? '—' }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <label>
                            Период
                        </label>

                        <div class="alert alert-light mb-0">
                            <strong>
                                {{ $subscription['interval'] ?? '—' }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <label>
                            Следващо плащане
                        </label>

                        <div class="alert alert-light mb-0">
                            <strong>
                                {{ $subscription['current_period_end'] ?? 'Няма предстоящо плащане' }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <label>
                            Край на абонамента
                        </label>

                        <div class="alert alert-light mb-0">
                            <strong>
                                {{ $subscription['ends_at'] ?? '—' }}
                            </strong>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        @if ($subscription['cancel_at_period_end'] ?? false)

            <hr>

            <section class="profile-section mb-5">

                <div class="heading two mb-4">
                    <h6>ПРЕКРАТЯВАНЕ НА АБОНАМЕНТА</h6>

                    <h2>
                        Абонаментът е насрочен за прекратяване
                    </h2>

                    <p class="pt-lg-3 pt-md-2">
                        Потребителят е поискал прекратяване на своя абонамент.
                    </p>
                </div>

                <div class="alert alert-warning">
                    <strong>
                        Абонаментът ще остане активен до
                        {{ $subscription['ends_at'] ?? ($subscription['current_period_end'] ?? 'края на текущия период') }}.
                    </strong>
                </div>

                @if (!empty($subscription['message']))
                    <div class="alert alert-info">
                        {{ $subscription['message'] }}
                    </div>
                @endif

            </section>
        @else
            <hr>

            <section class="profile-section profile-section--danger">

                <div class="heading two mb-4">
                    <h6>УПРАВЛЕНИЕ НА АБОНАМЕНТА</h6>

                    <h2>
                        Прекратяване на абонамента
                    </h2>

                    <p class="pt-lg-3 pt-md-2">
                        Ако абонаментът бъде прекратен, потребителят ще запази достъп до системата до края на текущия платен период.
                    </p>
                </div>

                @if (!empty($subscription['current_period_end']))
                    <div class="alert alert-warning">
                        При прекратяване на абонамента потребителят ще има достъп до системата до
                        <strong>{{ $subscription['current_period_end'] }}</strong>.
                    </div>
                @endif

                <form action="{{ route('subscription.cancel') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn bg-danger border-danger">
                        Прекрати абонамента
                    </button>
                </form>

            </section>

        @endif

    @endif

</div>

</x-backend>
