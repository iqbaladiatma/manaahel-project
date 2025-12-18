<x-app-layout>
    <div class="py-12 mt-20 bg-gray-50 dark:bg-dark-bg min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('gallery.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors font-semibold group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Galeri
                </a>
            </div>

            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl shadow-xl dark:shadow-dark-border p-8 mb-8 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Tambah Media dari Cloudinary</h1>
                        <p class="text-orange-100 mt-1">Tambahkan foto/video yang sudah ada di Cloudinary</p>
                    </div>
                </div>
                
                <!-- Admin Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    <span class="text-sm font-semibold">Admin Mode</span>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden">
                <form action="{{ route('gallery.cloudinary.store') }}" method="POST" class="p-8">
                    @csrf

                    <!-- Cloudinary URL -->
                    <div class="mb-6">
                        <label for="cloudinary_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            URL Cloudinary <span class="text-red-500">*</span>
                        </label>
                        <input type="url" 
                               name="cloudinary_url" 
                               id="cloudinary_url" 
                               value="{{ old('cloudinary_url') }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all"
                               placeholder="https://res.cloudinary.com/your-cloud/image/upload/v1234567890/sample.jpg">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                            Copy URL langsung dari Cloudinary Media Library
                        </p>
                        @error('cloudinary_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Public ID (Optional) -->
                    <div class="mb-6">
                        <label for="cloudinary_public_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Public ID <span class="text-gray-500">(Opsional)</span>
                        </label>
                        <input type="text" 
                               name="cloudinary_public_id" 
                               id="cloudinary_public_id" 
                               value="{{ old('cloudinary_public_id') }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all"
                               placeholder="sample atau folder/sample">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                            Public ID dari Cloudinary (akan otomatis diextract dari URL jika kosong)
                        </p>
                        @error('cloudinary_public_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Type -->
                    <div class="mb-6">
                        <label for="file_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Tipe Media <span class="text-red-500">*</span>
                        </label>
                        <select name="file_type" 
                                id="file_type"
                                required
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                            <option value="image" {{ old('file_type') == 'image' ? 'selected' : '' }}>Gambar/Foto</option>
                            <option value="video" {{ old('file_type') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('file_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all"
                               placeholder="Masukkan judul media...">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Deskripsi
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all"
                                  placeholder="Ceritakan tentang media ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Visibility -->
                    <div class="mb-6">
                        <label for="visibility" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Visibilitas <span class="text-red-500">*</span>
                        </label>
                        <select name="visibility" 
                                id="visibility"
                                required
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                            <option value="public" {{ old('visibility') == 'public' ? 'selected' : '' }}>Publik (Semua orang bisa lihat)</option>
                            <option value="member_only" {{ old('visibility') == 'member_only' ? 'selected' : '' }}>Khusus Member</option>
                        </select>
                        @error('visibility')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Batch Filter -->
                    <div class="mb-6">
                        <label for="batch_filter" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Filter Angkatan <span class="text-gray-500">(Opsional)</span>
                        </label>
                        <input type="number" 
                               name="batch_filter" 
                               id="batch_filter" 
                               value="{{ old('batch_filter') }}"
                               min="2020" max="2030"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all"
                               placeholder="2024">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                            Kosongkan jika ingin semua angkatan bisa melihat
                        </p>
                        @error('batch_filter')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assign to Member -->
                    <div class="mb-6">
                        <label for="member_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Assign ke Member <span class="text-gray-500">(Opsional)</span>
                        </label>
                        <select name="member_id" 
                                id="member_id"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                            <option value="">-- Galeri Umum --</option>
                            @foreach(\App\Models\User::where('role', 'member_angkatan')->orderBy('name')->get() as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} @if($member->batch_year)({{ $member->batch_year }})@endif
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            Tambah ke Galeri
                        </button>
                        <a href="{{ route('gallery.index') }}" 
                           class="px-8 py-4 bg-gray-100 dark:bg-dark-card text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 p-6 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-orange-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-semibold text-orange-800 mb-2">Cara Mendapatkan URL Cloudinary</h3>
                        <ol class="text-sm text-orange-700 space-y-1 list-decimal list-inside">
                            <li>Login ke dashboard Cloudinary Anda</li>
                            <li>Buka "Media Library"</li>
                            <li>Klik pada foto/video yang ingin ditambahkan</li>
                            <li>Copy URL dari bagian "Delivery URL"</li>
                            <li>Paste URL tersebut di form ini</li>
                        </ol>
                        <p class="mt-3 text-sm text-orange-600">
                            <strong>Tip:</strong> Untuk import banyak media sekaligus, gunakan 
                            <a href="{{ route('gallery.cloudinary.bulk') }}" class="underline hover:no-underline">Bulk Import</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>