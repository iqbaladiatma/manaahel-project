<nav x-data="{ open: false }" 
     class="fixed w-full top-0 z-50 bg-white shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 gradient-blue rounded-lg flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-xl">M</span>
                        </div>
                        <span class="text-xl font-bold text-blue-primary">Manaahel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ms-10 sm:flex">
                    @auth
                    <!-- Member Navigation -->
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('programs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Programs') }}
                    </a>
                    <a href="{{ route('members.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Members') }}
                    </a>
                    <a href="{{ route('gallery.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Gallery') }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Blog') }}
                    </a>
                    @else
                    <!-- Public Navigation -->
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('About') }}
                    </a>
                    <a href="{{ route('programs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Programs') }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Blog') }}
                    </a>
                    <a href="{{ route('map.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        {{ __('Map') }}
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-2">
                <!-- Language Switcher -->
                <div class="flex items-center space-x-1 px-2 py-1.5 bg-gray-100 rounded-lg border border-gray-200">
                    <a href="{{ url('locale/id') }}" class="px-3 py-1.5 text-xs font-semibold {{ app()->getLocale() == 'id' ? 'text-white gradient-blue shadow-sm' : 'text-gray-600 hover:text-blue-primary' }} rounded-md transition">
                        ID
                    </a>
                    <a href="{{ url('locale/en') }}" class="px-3 py-1.5 text-xs font-semibold {{ app()->getLocale() == 'en' ? 'text-white gradient-blue shadow-sm' : 'text-gray-600 hover:text-blue-primary' }} rounded-md transition">
                        EN
                    </a>
                    <a href="{{ url('locale/ar') }}" class="px-3 py-1.5 text-xs font-semibold {{ app()->getLocale() == 'ar' ? 'text-white gradient-blue shadow-sm' : 'text-gray-600 hover:text-blue-primary' }} rounded-md transition">
                        AR
                    </a>
                </div>

                @auth
                <!-- Admin Panel Button (Only for Admins) -->
                @if(Auth::user()->isAdmin())
                <a href="{{ route('filament.admin.pages.dashboard') }}" 
                   class="inline-flex items-center px-4 py-2 gradient-gold text-white text-sm font-semibold rounded-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    {{ __('Admin Panel') }}
                </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
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

                        @if(Auth::user()->isAdmin())
                        <div class="border-t border-gray-100"></div>
                        <x-dropdown-link :href="route('filament.admin.pages.dashboard')">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                                {{ __('Admin Panel') }}
                            </div>
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <div class="border-t border-gray-100"></div>
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
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="gradient-gold text-white px-6 py-2.5 rounded-full font-medium hover:opacity-90 transition shadow-md">
                    {{ __('Register') }}
                </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-md border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
            <!-- Member Navigation Mobile -->
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('programs.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Programs') }}
            </a>
            <a href="{{ route('members.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Members') }}
            </a>
            <a href="{{ route('gallery.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Gallery') }}
            </a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Blog') }}
            </a>
            @else
            <!-- Public Navigation Mobile -->
            <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Home') }}
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('About') }}
            </a>
            <a href="{{ route('programs.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Programs') }}
            </a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Blog') }}
            </a>
            <a href="{{ route('map.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Map') }}
            </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('registrations.create') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                    {{ __('Register for Program') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 px-4 space-y-2">
            <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                {{ __('Log in') }}
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-medium text-center text-white gradient-gold rounded-full hover:opacity-90 transition">
                {{ __('Register') }}
            </a>
        </div>
        @endauth

        <!-- Language Switcher Mobile -->
        <div class="pt-4 pb-3 border-t border-gray-200 px-4">
            <div class="flex items-center justify-center space-x-3">
                <span class="text-sm font-medium text-gray-600">{{ __('Language') }}:</span>
                <div class="flex items-center space-x-1 px-2 py-1.5 bg-gray-100 rounded-lg border border-gray-200">
                    <a href="{{ url('locale/id') }}" class="px-3 py-1.5 text-sm font-semibold {{ app()->getLocale() == 'id' ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-sm' : 'text-gray-600' }} rounded-md transition-all duration-200">
                        ID
                    </a>
                    <a href="{{ url('locale/en') }}" class="px-3 py-1.5 text-sm font-semibold {{ app()->getLocale() == 'en' ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-sm' : 'text-gray-600' }} rounded-md transition-all duration-200">
                        EN
                    </a>
                    <a href="{{ url('locale/ar') }}" class="px-3 py-1.5 text-sm font-semibold {{ app()->getLocale() == 'ar' ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-sm' : 'text-gray-600' }} rounded-md transition-all duration-200">
                        AR
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

