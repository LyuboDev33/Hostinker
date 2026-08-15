<header class="dashboard-header">

    <div class="dashboard-header__wrapper">

        {{-- Left --}}
        <div class="dashboard-header__left">

            <button
                type="button"
                class="dashboard-header__sidebar-toggle"
                data-sidebar-toggle
                aria-label="Меню">

                <i class="fa-solid fa-bars"></i>

            </button>




        </div>


        {{-- Right --}}
        <div class="dashboard-header__right">

            {{-- Profile --}}
            <div class="dashboard-dropdown">

                <button
                    type="button"
                    class="dashboard-dropdown__toggle"
                    data-dropdown-toggle>

                    <span class="dashboard-dropdown__avatar">

                        <img
                            src="{{ $profilePicture }}"
                            alt="{{ Auth::user()->name }}">

                    </span>

                    <span class="dashboard-dropdown__identity">

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                    </span>

                    <i class="fa-solid fa-chevron-down dashboard-dropdown__caret"></i>

                </button>


                <div class="dashboard-dropdown__menu">

                    <div class="dashboard-dropdown__menu-header">

                        <span>Влезли сте като</span>

                        <strong>
                            {{ Auth::user()->email }}
                        </strong>

                    </div>

                    <ul>

                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fa-regular fa-user"></i>

                                Профил
                            </a>
                        </li>

                        <li>
                            <a
                                <i class="fa-regular fa-envelope"></i>

                                Съобщения
                            </a>
                        </li>

                        <li class="dashboard-dropdown__divider"></li>

                        <li>

                            <form
                                method="POST"
                                action="{{ route('logout') }}">

                                @csrf

                                <button
                                    type="submit"
                                    class="dashboard-dropdown__logout">

                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>

                                    Изход

                                </button>

                            </form>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</header>
