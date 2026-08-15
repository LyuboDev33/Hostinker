<aside class="dashboard-sidebar">

    <div class="dashboard-sidebar__header">

        <a href="{{ route('dashboard') }}" class="dashboard-sidebar__logo">
            <x-logo width="150" />
        </a>

        <button
            type="button"
            class="dashboard-sidebar__close"
            data-sidebar-close
            aria-label="Затвори">
            <i class="fa-regular fa-circle-xmark"></i>
        </button>

    </div>


    <nav class="dashboard-sidebar__nav">

        <ul class="dashboard-sidebar__menu">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}">

                    <span class="dashboard-sidebar__menu-icon">
                        <i class="fa-solid fa-house"></i>
                    </span>

                    <span>Табло</span>

                </a>
            </li>


            {{-- Websites --}}
            <li class="dashboard-sidebar__item-has-children {{ request()->routeIs('websites.*') ? 'is-open' : '' }}">

                <button
                    type="button"
                    class="dashboard-sidebar__menu-toggle {{ request()->routeIs('websites.*') ? 'is-active' : '' }}"
                    data-sidebar-submenu>

                    <span class="dashboard-sidebar__menu-main">

                        <span class="dashboard-sidebar__menu-icon">
                            <i class="fa-solid fa-window-maximize"></i>
                        </span>

                        <span>Уебсайтове</span>

                    </span>

                    <i class="fa-solid fa-chevron-down dashboard-sidebar__arrow"></i>

                </button>


                <ul class="dashboard-sidebar__submenu">

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('websites.index', 'websites.show', 'websites.edit') ? 'is-active' : '' }}">
                            Моите сайтове
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('websites.create') ? 'is-active' : '' }}">
                            Добави сайт
                        </a>
                    </li>

                </ul>

            </li>


            {{-- Domains --}}
            <li class="dashboard-sidebar__item-has-children {{ request()->routeIs('domains.*') ? 'is-open' : '' }}">

                <button
                    type="button"
                    class="dashboard-sidebar__menu-toggle {{ request()->routeIs('domains.*') ? 'is-active' : '' }}"
                    data-sidebar-submenu>

                    <span class="dashboard-sidebar__menu-main">

                        <span class="dashboard-sidebar__menu-icon">
                            <i class="fa-solid fa-globe"></i>
                        </span>

                        <span>Домейни</span>

                    </span>

                    <i class="fa-solid fa-chevron-down dashboard-sidebar__arrow"></i>

                </button>


                <ul class="dashboard-sidebar__submenu">

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('domains.index', 'domains.show') ? 'is-active' : '' }}">
                            Моите домейни
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('domains.create') ? 'is-active' : '' }}">
                            Регистрирай домейн
                        </a>
                    </li>

                </ul>

            </li>


            {{-- Hosting --}}
            <li class="dashboard-sidebar__item-has-children {{ request()->routeIs('hosting.*') ? 'is-open' : '' }}">

                <button
                    type="button"
                    class="dashboard-sidebar__menu-toggle {{ request()->routeIs('hosting.*') ? 'is-active' : '' }}"
                    data-sidebar-submenu>

                    <span class="dashboard-sidebar__menu-main">

                        <span class="dashboard-sidebar__menu-icon">
                            <i class="fa-solid fa-server"></i>
                        </span>

                        <span>Хостинг</span>

                    </span>

                    <i class="fa-solid fa-chevron-down dashboard-sidebar__arrow"></i>

                </button>


                <ul class="dashboard-sidebar__submenu">

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('hosting.index', 'hosting.show') ? 'is-active' : '' }}">
                            Моите планове
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('hosting.plans') ? 'is-active' : '' }}">
                            Хостинг планове
                        </a>
                    </li>

                </ul>

            </li>


            {{-- Messages --}}
            <li>
                <a href="#"
                    class="{{ request()->routeIs('messages.*') ? 'is-active' : '' }}">

                    <span class="dashboard-sidebar__menu-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </span>

                    <span>Съобщения</span>

                    <span class="dashboard-sidebar__badge">
                        3
                    </span>

                </a>
            </li>


            @if ($isAdmin)

                <li class="dashboard-sidebar__separator">
                    <span>Администрация</span>
                </li>


                <li class="dashboard-sidebar__item-has-children {{ request()->routeIs('admin.*') ? 'is-open' : '' }}">

                    <button
                        type="button"
                        class="dashboard-sidebar__menu-toggle {{ request()->routeIs('admin.*') ? 'is-active' : '' }}"
                        data-sidebar-submenu>

                        <span class="dashboard-sidebar__menu-main">

                            <span class="dashboard-sidebar__menu-icon">
                                <i class="fa-solid fa-user-shield"></i>
                            </span>

                            <span>Админ панел</span>

                        </span>

                        <i class="fa-solid fa-chevron-down dashboard-sidebar__arrow"></i>

                    </button>


                    <ul class="dashboard-sidebar__submenu">

                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="{{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">
                                Потребители
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="{{ request()->routeIs('admin.hosting.*') ? 'is-active' : '' }}">
                                Хостинг планове
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="{{ request()->routeIs('admin.websites.*') ? 'is-active' : '' }}">
                                Уебсайтове
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="{{ request()->routeIs('admin.domains.*') ? 'is-active' : '' }}">
                                Домейни
                            </a>
                        </li>

                    </ul>

                </li>

            @endif

        </ul>

    </nav>

</aside>
