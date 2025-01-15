<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 py-4 xl:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('movies.index') }}" class="h-[100%]">
                        <img src="{{ asset('logo.png') }}" class="h-[100%]" />
                    </a>
                    <a href="{{ route('movies.index') }}"
                        style="letter-spacing: 5px; color: #ff7600; font-family: sans-serif; font-weight: bold;">
                        ФИЛМИ.БГ
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 xl:-my-px xl:ms-10 xl:flex">
                    @if (Auth::check() && Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.dashboard.index')" :active="request()->routeIs('admin.dashboard.index')">
                            {{ __('Административно табло') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                            {{ __('Начало') }}
                        </x-nav-link>
                    @endif

                </div>

                <div class="hidden space-x-8 xl:-my-px xl:ms-10 xl:flex">
                    @if (Auth::check() && Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.movies.index')" :active="request()->routeIs('admin.movies.index')">
                            {{ __('Филми') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('directors.index')" :active="request()->routeIs('directors.index')">
                            {{ __('Режисьори') }}
                        </x-nav-link>
                    @endif

                </div>

                <div class="hidden space-x-8 xl:-my-px xl:ms-10 xl:flex">
                    @if (Auth::check() && Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.directors.index')" :active="request()->routeIs('admin.directors.index')">
                            {{ __('Режисьори') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('genres.create')" :active="request()->routeIs('genres.create')">
                            {{ __('Добавяне на жанр') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden xl:flex xl:items-center xl:ms-6">
                @if (!(Auth::check() && Auth::user()->is_admin))
                    @include('shared.partials.search-sorting')
                @endif

                @if (Auth::user())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Профил') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Излизане') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        Логин
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        Регистрация
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center xl:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden xl:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check() && Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.dashboard.index')" :active="request()->routeIs('admin.dashboard.index')">
                    {{ __('Административно табло') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                    {{ __('Начало') }}
                </x-responsive-nav-link>
            @endif

        </div>

        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check() && Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.movies.index')" :active="request()->routeIs('admin.movies.index')">
                    {{ __('Филми') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('directors.index')" :active="request()->routeIs('directors.index')">
                    {{ __('Режисьори') }}
                </x-responsive-nav-link>
            @endif
        </div>


        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check() && Auth::user()->is_admin)
            <x-responsive-nav-link :href="route('admin.directors.index')" :active="request()->routeIs('admin.directors.index')">
                {{ __('Режисьори') }}
            </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('genres.create')" :active="request()->routeIs('genres.create')">
                    {{ __('Добавяне на жанр') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @if (!(Auth::check() && Auth::user()->is_admin))
            @include('shared.partials.search-sorting')
        @endif

        @if (Auth::user())
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Профил') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Излизане') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <x-responsive-nav-link>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    Логин
                </a>
            </x-responsive-nav-link>
            <x-responsive-nav-link>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    Регистрация
                </a>
            </x-responsive-nav-link>
        @endif

    </div>
</nav>
