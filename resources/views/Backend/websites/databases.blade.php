
<x-backend>

    @section('SEO')
        <title>Управление на бази данни</title>
    @endsection

    <section class="website-dashboard">

        <div class="container">

            <!-- BREADCRUMBS -->
            <div class="website-dashboard__breadcrumbs">

                <a href="#">
                    <i class="fa-solid fa-house"></i>
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <a href="#">
                    Уебсайтове
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <a href="#">
                    Управление на уебсайт
                </a>

                <i class="fa-solid fa-chevron-right"></i>

                <span>Бази данни</span>

            </div>


            <!-- PAGE HEADER -->
            <div class="website-dashboard__page-header">

                <div>

                    <span class="website-dashboard__subtitle">
                        MySQL
                    </span>

                    <h2>Управление на бази данни</h2>

                    <p>
                        Създавайте и управлявайте MySQL базите данни
                        на вашия уебсайт.
                    </p>

                </div>

            </div>


            <!-- CREATE DATABASE -->
            <div class="website-dashboard-card">

                <div class="website-dashboard-card__header">

                    <h4>
                        <i class="fa-solid fa-circle-plus me-2"></i>
                        Създаване на нова база данни
                    </h4>

                </div>

                <div class="database-card__body">

                    <form action="#" method="POST">

                        <div class="database-form__grid">

                            <!-- DATABASE NAME -->
                            <div class="database-form__group">

                                <label for="database_name">
                                    Име на базата данни
                                </label>

                                <input
                                    type="text"
                                    id="database_name"
                                    name="database_name"
                                    placeholder="Например: my_database"
                                    autocomplete="off"
                                    required
                                >

                                <small>
                                    Въведете името на новата MySQL база данни.
                                </small>

                            </div>


                            <!-- USERNAME -->
                            <div class="database-form__group">

                                <label for="database_username">
                                    Потребителско име
                                </label>

                                <input
                                    type="text"
                                    id="database_username"
                                    name="database_username"
                                    placeholder="Например: my_user"
                                    autocomplete="off"
                                    required
                                >

                                <small>
                                    Потребителят ще получи достъп до базата данни.
                                </small>

                            </div>


                            <!-- PASSWORD -->
                            <div class="database-form__group database-form__group--full">

                                <label for="database_password">
                                    Парола
                                </label>

                                <input
                                    type="password"
                                    id="database_password"
                                    name="database_password"
                                    placeholder="Въведете сигурна парола"
                                    autocomplete="new-password"
                                    minlength="8"
                                    required
                                >

                                <small>
                                    Използвайте парола с поне 8 символа.
                                </small>

                            </div>

                        </div>


                        <!-- FORM ACTIONS -->
                        <div class="database-form__actions">

                            <button
                                type="submit"
                                class="tg-btn"
                            >
                                <i class="fa-solid fa-plus"></i>
                                Създай база данни
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            <!-- EXISTING DATABASES -->
            <div class="website-dashboard-card database-list">

                <div class="website-dashboard-card__header">

                    <h4>
                        <i class="fa-solid fa-database me-2"></i>
                        Съществуващи бази данни
                    </h4>

                </div>

                <div class="database-list__table-wrapper">

                    <table class="database-list__table">

                        <thead>
                            <tr>
                                <th>База данни</th>
                                <th>Потребител</th>
                                <th>Създадена на</th>
                                <th>Действия</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- STATIC EXAMPLE -->
                            <tr>

                                <td>
                                    <div class="database-list__name">
                                        <i class="fa-solid fa-database"></i>
                                        u3_test3
                                    </div>
                                </td>

                                <td>u3_test3</td>

                                <td>24.09.2026</td>

                                <td>

                                    <div class="database-list__actions">

                                        <a
                                            href="#"
                                            class="website-outline-btn website-outline-btn--small"
                                        >
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            phpMyAdmin
                                        </a>

                                        <button
                                            type="button"
                                            class="website-outline-btn website-outline-btn--small database-list__delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                            Изтрий
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</x-backend>
