<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gold dark:from-dark-bg dark:via-dark-card dark:to-dark-bg/5 py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header Card -->
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-lg dark:shadow-dark-border overflow-hidden mb-6 border-t-4 border-gold">
                <div class="bg-gradient-to-r from-blue-primary to-blue-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="w-16 h-16 gradient-gold rounded-full flex items-center justify-center mr-4 shadow-lg dark:shadow-dark-border">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">Lengkapi Profil Anda</h1>
                            <p class="text-blue-100 mt-1">Isi data berikut untuk melanjutkan pendaftaran program</p>
                        </div>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="px-8 py-6 bg-blue-50 dark:bg-blue-dark/20 border-b border-blue-100">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-blue-900 mb-1">Mengapa perlu melengkapi profil?</h3>
                            <p class="text-sm text-blue-800">Data ini diperlukan untuk proses pendaftaran program academy. Dengan profil yang lengkap, Anda bisa mendaftar program dengan 1-klik tanpa perlu mengisi form berulang kali.</p>
                        </div>
                    </div>
                </div>

                <!-- Missing Fields Alert -->
                @if(!empty($missingFields))
                <div class="px-8 py-4 bg-amber-50 dark:bg-amber-900/20 border-b border-amber-100">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-amber-900">Data yang perlu dilengkapi:</p>
                            <ul class="mt-1 text-sm text-amber-800 list-disc list-inside">
                                @if(in_array('name', $missingFields))
                                    <li>Nama Lengkap</li>
                                @endif
                                @if(in_array('email', $missingFields))
                                    <li>Alamat Email</li>
                                @endif
                                @if(in_array('phone', $missingFields))
                                    <li>Nomor WhatsApp</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Form -->
                <form action="{{ route('profile.complete.update') }}" method="POST" class="px-8 py-8">
                    @csrf

                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Nama Lengkap
                                @if(in_array('name', $missingFields))
                                    <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Wajib diisi</span>
                                @endif
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full px-4 py-3 border-2 {{ in_array('name', $missingFields) ? 'border-red-300 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-dark-border' }} rounded-lg focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all"
                                   placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Alamat Email
                                @if(in_array('email', $missingFields))
                                    <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Wajib diisi</span>
                                @endif
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full px-4 py-3 border-2 {{ in_array('email', $missingFields) ? 'border-red-300 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-dark-border' }} rounded-lg focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all"
                                   placeholder="contoh@email.com">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Nomor WhatsApp
                                @if(in_array('phone', $missingFields))
                                    <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Wajib diisi</span>
                                @endif
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-500">+62</span>
                                </div>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone', $user->phone) }}"
                                       required
                                       class="w-full pl-14 pr-4 py-3 border-2 {{ in_array('phone', $missingFields) ? 'border-red-300 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-dark-border' }} rounded-lg focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all"
                                       placeholder="8123456789">
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1 ml-1">Format: 08xxxxxxxxxx atau 8xxxxxxxxxx</p>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Benefits Section -->
                    <div class="mt-8 bg-gradient-to-r from-blue-50 to-gold/10 rounded-lg p-6 border border-blue-100">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-gold mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Keuntungan Profil Lengkap:
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Pendaftaran program dengan <strong>1-klik</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Tidak perlu mengisi form berulang kali</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Akses cepat ke semua program academy</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Notifikasi program baru via email & WhatsApp</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <button type="submit" 
                                class="flex-1 gradient-blue text-white font-bold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg dark:shadow-dark-border hover:shadow-xl dark:hover:shadow-gold/20 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan & Lanjutkan
                        </button>
                        <a href="{{ $intendedUrl }}" 
                           class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 dark:text-gray-200 font-semibold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Privacy Note -->
            <div class="bg-white dark:bg-dark-card rounded-lg shadow-md p-4 border-l-4 border-blue-primary dark:border-gold">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong class="text-gray-900">Privasi Terjaga:</strong> Data Anda aman dan hanya digunakan untuk keperluan pendaftaran program. Kami tidak akan membagikan informasi Anda kepada pihak ketiga.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
