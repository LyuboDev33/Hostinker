<x-backend>

    @section('SEO')
        <title>Профил</title>
    @endsection

    <div class="profile-page">

        <div>
            <div class="heading two">
                <h6>МОЯТ ПРОФИЛ</h6>
                <h2>Здравейте, {{ Auth::user()->first_name ?? Auth::user()->name }} 👋</h2>

                <p class="pt-lg-3 pt-md-2">
                    Оттук можете да редактирате личната си информация,
                    профилната си снимка и паролата си.
                </p>
            </div>
        </div>

        <hr>

        {{-- Success message --}}
        @if (session('editSuccess'))
            <div class="alert alert-success w-fit rounded-pill">
                {{ session('editSuccess') }}
            </div>
        @endif

        @if (session('successPasswordChange'))
            <div class="alert alert-success w-fit rounded-pill">
                {{ session('successPasswordChange') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success w-fit rounded-pill">
                {{ session('success') }}
            </div>
        @endif

        {{-- General errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Моля, проверете въведената информация.</strong>
            </div>
        @endif

        {{-- ============================================================
             PROFILE INFORMATION FORM
        ============================================================ --}}
        <section class="profile-section mb-5">

            <div class="heading two mb-4">
                <h6>ЛИЧНА ИНФОРМАЦИЯ</h6>
                <h2>Редактиране на профила</h2>

                <p class="pt-lg-3 pt-md-2">
                    Променете профилната си снимка и основната информация
                    за своя акаунт.
                </p>
            </div>

            <form class="content-form" action="{{ route('profile.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row">

                    {{-- Profile picture --}}
                    <div class="col-lg-4 mb-4">

                        <div class="profile-image-wrapper">

                            <div class="profile-image-preview mb-3">
                                <img id="profile-image-preview" src="{{ $profilePicture }}" alt="Профилна снимка"
                                    width="170" height="170" style="object-fit: cover; border-radius:50%;">
                            </div>

                            <label for="profile_pic">
                                Профилна снимка
                            </label>

                            <input id="profile_pic" type="file" name="profile_pic" accept=".jpg,.jpeg,.png">

                            @error('profile_pic', 'profile')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- User information --}}
                    <div class="col-lg-8">

                        <div class="row">

                            <div class="col-lg-6">

                                <label for="name">
                                    Име
                                </label>

                                <input id="name" type="text" name="name"
                                    value="{{ old('name') ?: $user->name }}" placeholder="Въведете вашето име">

                                @error('name', 'profile')
                                    <div class="text-danger mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-lg-6">

                                <label for="email">
                                    Имейл адрес
                                </label>

                                <input id="email" type="email" name="email"
                                    value="{{ old('email') ?: $user->email }}" placeholder="Въведете имейл адрес">

                                @error('email', 'profile')
                                    <div class="text-danger mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-lg-12">

                                <button type="submit" class="btn">
                                    Запази промените
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </section>

        {{-- ============================================================
             PASSWORD FORM
        ============================================================ --}}
        <hr>
        <section class="profile-section mb-5">

            <div class="heading two mb-4">
                <h6>СИГУРНОСТ</h6>
                <h2>Смяна на парола</h2>

                <p class="pt-lg-3 pt-md-2">
                    Използвайте сигурна парола, която не използвате в други сайтове.
                </p>
            </div>

            <form class="content-form" action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-lg-4">

                        <label for="current_password">
                            Сегашна парола
                        </label>

                        <div class="password-field">

                            <input id="current_password" type="password" name="current_password"
                                placeholder="Въведете сегашната си парола" autocomplete="current-password">

                            <i class="fa-solid fa-eye" onclick="inputEyeLash(this)"></i>

                        </div>

                        @error('current_password', 'updatePassword')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-lg-4">

                        <label for="password">
                            Нова парола
                        </label>

                        <div class="password-field">

                            <input id="password" type="password" name="password"
                                placeholder="Въведете новата си парола" autocomplete="new-password">

                            <i class="fa-solid fa-eye" onclick="inputEyeLash(this)"></i>

                        </div>

                        @error('password', 'updatePassword')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-lg-4">

                        <label for="password_confirmation">
                            Повторете новата парола
                        </label>

                        <div class="password-field">

                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="Повторете новата си парола" autocomplete="new-password">

                            <i class="fa-solid fa-eye" onclick="inputEyeLash(this)"></i>

                        </div>

                        @error('password_confirmation', 'updatePassword')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-lg-12">

                        <button type="submit" class="btn">
                            Запази новата парола
                        </button>

                    </div>

                </div>

            </form>

        </section>

        {{-- ============================================================
             DELETE ACCOUNT
        ============================================================ --}}
        <hr>
        <section class="profile-section profile-section--danger">

            <div class="heading two mb-4">
                <h6>ОПАСНА ЗОНА</h6>
                <h2>Изтриване на акаунта</h2>

                <p class="pt-lg-3 pt-md-2">
                    След изтриване на акаунта всички свързани с него данни
                    могат да бъдат премахнати без възможност за възстановяване.
                </p>
            </div>

            <button type="button" class="btn bg-danger border-danger" data-bs-toggle="modal"
                data-bs-target="#deleteAccountModal">
                Изтрий акаунта
            </button>

        </section>

    </div>

    {{-- ================================================================
         DELETE ACCOUNT MODAL
    ================================================================= --}}
    <div class="modal fade" id="deleteAccountModal">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">
                        Внимание!
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">

                        <h4 class="text-center">
                            С изтриването на акаунта си ще загубите достъп до
                            информацията, свързана с него.
                        </h4>

                        <h4 class="text-center">
                            Сигурни ли сте, че искате да го изтриете?
                        </h4>


                        <label class="mt-3" for="delete_password">
                            Потвърдете паролата си
                        </label>

                        <input id="delete_password" type="password" name="password"
                            placeholder="Въведете вашата парола" autocomplete="current-password">

                        @error('password', 'userDeletion')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror


                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn" data-bs-dismiss="modal">
                            Затвори
                        </button>

                        <button type="submit" class="btn bg-danger border-danger">
                            Потвърди изтриването
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    {{-- Vanilla JavaScript image preview --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('profile_pic');
            const imagePreview = document.getElementById('profile-image-preview');

            if (!fileInput || !imagePreview) {
                return;
            }

            fileInput.addEventListener('change', function(event) {
                const selectedFile = event.target.files[0];

                if (!selectedFile) {
                    return;
                }

                imagePreview.src = URL.createObjectURL(selectedFile);
            });
        });
    </script>

</x-backend>
