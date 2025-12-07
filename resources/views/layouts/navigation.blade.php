<nav x-data="{ open: false }" 
     class="fixed w-full top-0 z-50 bg-white dark:bg-dark-card dark:bg-dark-bg shadow-md dark:shadow-dark-border transition-colors duration-200">
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
                        <span class="text-xl font-bold text-blue-primary dark:text-gold">Manaahel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ms-10 sm:flex">
                    @auth
                    <!-- Member Navigation -->
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold transition-colors">
                        Dashboard
                    </a>
                    <a href="{{ route('programs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Program
                    </a>
                    <a href="{{ route('academy.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Academy
                    </a>
                    <a href="{{ route('members.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Anggota
                    </a>
                    <a href="{{ route('gallery.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Galeri
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Artikel
                    </a>
                    @else
                    <!-- Public Navigation -->
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Tentang
                    </a>
                    <a href="{{ route('programs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Program
                    </a>
                    <a href="{{ route('academy.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 dark:hover:bg-dark-card transition-all duration-200">
                        Academy
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 transition-all duration-200">
                        Artikel
                    </a>
                    <a href="{{ route('map.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 dark:bg-blue-dark/20 transition-all duration-200">
                        Peta
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-2">
                <!-- Dark Mode Toggle -->
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="darkModeToggle" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-gold/50 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:bg-dark-card after:border-gray-300 dark:border-dark-border after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gold"></div>
                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </label>

                @auth
                <!-- Admin Panel Button (Only for Admins) -->
                @if(Auth::user()->isAdmin())
                <a href="{{ route('filament.admin.pages.dashboard') }}" 
                   class="inline-flex items-center px-4 py-2 gradient-gold text-white text-sm font-semibold rounded-lg hover:shadow-lg dark:shadow-dark-border transition-all duration-200 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    Panel Admin
                </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-100 rounded-lg hover:bg-gray-100 dark:bg-dark-card dark:hover:bg-dark-card transition-all duration-200">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">
                            Dashboard
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('registrations.create')">
                            Daftar Program
                        </x-dropdown-link>

                        @if(Auth::user()->isAdmin())
                        <div class="border-t border-gray-100 dark:border-dark-border"></div>
                        <x-dropdown-link :href="route('filament.admin.pages.dashboard')">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                                Panel Admin
                            </div>
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <div class="border-t border-gray-100 dark:border-dark-border"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="gradient-gold text-white px-6 py-2.5 rounded-full font-medium hover:opacity-90 transition shadow-md">
                    Daftar
                </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:bg-dark-card dark:hover:bg-dark-card transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border-t border-gray-200 dark:border-dark-border">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
            <!-- Member Navigation Mobile -->
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Dashboard
            </a>
            <a href="{{ route('programs.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Program
            </a>
            <a href="{{ route('academy.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Academy
            </a>
            <a href="{{ route('members.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Anggota
            </a>
            <a href="{{ route('gallery.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Galeri
            </a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Artikel
            </a>
            @else
            <!-- Public Navigation Mobile -->
            <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Beranda
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Tentang
            </a>
            <a href="{{ route('programs.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Program
            </a>
            <a href="{{ route('academy.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Academy
            </a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Artikel
            </a>
            <a href="{{ route('map.index') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Peta
            </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-dark-border">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                    Profil
                </a>
                <a href="{{ route('registrations.create') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                    Daftar Program
                </a>

                <!-- Admin Panel Button (Mobile) - Only for Admins -->
                @if(Auth::user()->isAdmin())
                <a href="{{ route('filament.admin.pages.dashboard') }}" class="block px-4 py-3 text-base font-medium gradient-gold text-white rounded-lg hover:opacity-90 transition-all duration-200 shadow-md">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Panel Admin
                    </div>
                </a>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-dark-border px-4 space-y-2">
            <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-blue-dark/20 rounded-lg transition-all duration-200">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-medium text-center text-white gradient-gold rounded-full hover:opacity-90 transition">
                Daftar
            </a>
        </div>
        @endauth

        <!-- Theme Switcher Mobile -->
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-dark-border px-4">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mode Gelap</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="darkModeToggleMobile" class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-gold/50 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-gold"></div>
                    <span class="ml-3 flex items-center">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </label>
            </div>
        </div>
    </div>
</nav>

