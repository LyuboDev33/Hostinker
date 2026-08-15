<x-backend>

    @section('SEO')
        <title>Админ | Потребители</title>
    @endsection

    <div class="profile-page">

        <div>
            <div class="heading two">
                <h6>АДМИНИСТРАЦИЯ</h6>
                <h2>Потребители</h2>

                <p class="pt-lg-3 pt-md-2">
                    Оттук можете да преглеждате всички регистрирани потребители в системата, както и статуса на техния
                    абонамент.
                </p>
            </div>
        </div>

        <hr>

        @if (session('success'))
            <div class="alert alert-success w-fit rounded-pill">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger w-fit rounded-pill">
                {{ session('error') }}
            </div>
        @endif

        <section class="profile-section mb-5">

            <div class="heading two mb-4">
                <h6>ВСИЧКИ ПОТРЕБИТЕЛИ</h6>
                <h2>Списък с потребители</h2>

                <p class="pt-lg-3 pt-md-2">
                    Общо регистрирани потребители: <strong>{{ $users->total() }}</strong>
                </p>
            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Име</th>
                            <th>Имейл</th>
                            <th>Абонамент</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($users as $user)
                            <tr>

                                <td>
                                    #{{ $user->id }}
                                </td>

                                <td>
                                    <strong>{{ $user->name }}</strong>
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>

                                    @if ($user->subscribed('basic') || $user->subscribed('standart') || $user->subscribed('premium'))
                                        <span class="badge bg-success p-2">
                                            Има активен абонамент
                                        </span>
                                    @else
                                        <span class="badge bg-secondary p-2">
                                            Няма активен абонамент
                                        </span>
                                    @endif

                                </td>

                                <td class="text-end d-flex justify-content-end">

                                    <div class="d-flex flex-column gap-2 flex-xxl-row">
                                        <a href="{{ route('admin.users.details.show', $user) }}"
                                            class="btn-custom-materials">Виж материали</a>

                                        <a href="{{ route('admin.users.show', $user) }}" class="btn">
                                            Разгледай
                                        </a>
                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        Все още няма регистрирани потребители.
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($users->hasPages())
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif

        </section>

    </div>

</x-backend>
