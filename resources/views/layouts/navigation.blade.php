<nav x-data="{ open: false }" 
     class="fixed w-full top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-bold text-xl">M</span>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Manaahel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ms-10 sm:flex">
                    @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Dashboard') }}
                    </a>
                    @else
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Home') }}
                    </a>
                    @endauth
                    <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('About') }}
                    </a>
                    <a href="{{ route('programs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Programs') }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Blog') }}
                    </a>
                    <a href="{{ route('map.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Map') }}
                    </a>
                    @auth
                    <a href="{{ route('courses.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                        {{ __('Courses') }}
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-2">
                <!-- Language Switcher -->
                <div class="flex items-center space-x-1 px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded-lg">
                    <a href="{{ url('locale/id') }}" class="px-2 py-1 text-xs font-medium {{ app()->getLocale() == 'id' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400' }} rounded transition-all duration-200">
                        ID
                    </a>
                    <a href="{{ url('locale/en') }}" class="px-2 py-1 text-xs font-medium {{ app()->getLocale() == 'en' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400' }} rounded transition-all duration-200">
                        EN
                    </a>
                    <a href="{{ url('locale/ar') }}" class="px-2 py-1 text-xs font-medium {{ app()->getLocale() == 'ar' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400' }} rounded transition-all duration-200">
                        AR
                    </a>
                </div>

                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('registrations.create')">
                            {{ __('Register for Program') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    {{ __('Register') }}
                </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Dashboard') }}
            </a>
            @else
            <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Home') }}
            </a>
            @endauth
            <a href="{{ route('about') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('About') }}
            </a>
            <a href="{{ route('programs.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Programs') }}
            </a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Blog') }}
            </a>
            <a href="{{ route('map.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Map') }}
            </a>
            @auth
            <a href="{{ route('courses.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Courses') }}
            </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('registrations.create') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                    {{ __('Register for Program') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700 px-4 space-y-2">
            <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all duration-200">
                {{ __('Log in') }}
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-medium text-center text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
                {{ __('Register') }}
            </a>
        </div>
        @endauth

        <!-- Language Switcher Mobile -->
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700 px-4">
            <div class="flex items-center justify-center space-x-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Language') }}:</span>
                <div class="flex items-center space-x-1 px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded-lg">
                    <a href="{{ url('locale/id') }}" class="px-3 py-1 text-sm font-medium {{ app()->getLocale() == 'id' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400' }} rounded transition-all duration-200">
                        ID
                    </a>
                    <a href="{{ url('locale/en') }}" class="px-3 py-1 text-sm font-medium {{ app()->getLocale() == 'en' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400' }} rounded transition-all duration-200">
                        EN
                    </a>
                    <a href="{{ url('locale/ar') }}" class="px-3 py-1 text-sm font-medium {{ app()->getLocale() == 'ar' ? 'text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700' : 'text-gray-600 dark:text-gray-400' }} rounded transition-all duration-200">
                        AR
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
