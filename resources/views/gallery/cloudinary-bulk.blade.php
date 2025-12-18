<x-app-layout>
    <div class="py-12 mt-20 bg-gray-50 dark:bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl shadow-xl dark:shadow-dark-border p-8 mb-8 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 014 11.5V5zM7 7a1 1 0 012 0v2a1 1 0 11-2 0V7zm3 0a1 1 0 012 0v2a1 1 0 11-2 0V7z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Bulk Import dari Cloudinary</h1>
                        <p class="text-purple-100 mt-1">Import banyak media sekaligus dengan format teks</p>
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
                <form action="{{ route('gallery.cloudinary.bulk-store') }}" method="POST" class="p-8">
                    @csrf

                    <!-- Media List -->
                    <div class="mb-6">
                        <label for="media_list" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Daftar Media <span class="text-red-500">*</span>
                        </label>
                        <textarea name="media_list" 
                                  id="media_list" 
                                  rows="15"
                                  required
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all font-mono text-sm"
                                  placeholder="Format: URL|Judul|Deskripsi|Tipe

Contoh:
https://res.cloudinary.com/demo/image/upload/sample.jpg|Foto Sample|Ini adalah foto sample|image
https://res.cloudinary.com/demo/video/upload/sample.mp4|Video Sample|Ini adalah video sample|video
https://res.cloudinary.com/demo/image/upload/folder/photo1.jpg|Kegiatan 1|Dokumentasi kegiatan pertama|image">{{ old('media_list') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                            Format: <code>URL|Judul|Deskripsi|Tipe</code> (satu media per baris)
                        </p>
                        @error('media_list')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Default Settings -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Default Visibility -->
                        <div>
                            <label for="default_visibility" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Visibilitas Default <span class="text-red-500">*</span>
                            </label>
                            <select name="default_visibility" 
                                    id="default_visibility"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                <option value="public" {{ old('default_visibility') == 'public' ? 'selected' : '' }}>Publik</option>
                                <option value="member_only" {{ old('default_visibility') == 'member_only' ? 'selected' : '' }}>Khusus Member</option>
                            </select>
                            @error('default_visibility')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Default Batch Filter -->
                        <div>
                            <label for="default_batch_filter" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Filter Angkatan Default <span class="text-gray-500">(Opsional)</span>
                            </label>
                            <input type="number" 
                                   name="default_batch_filter" 
                                   id="default_batch_filter" 
                                   value="{{ old('default_batch_filter') }}"
                                   min="2020" max="2030"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all"
                                   placeholder="2024">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                                Kosongkan untuk semua angkatan
                            </p>
                            @error('default_batch_filter')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 014 11.5V5zM7 7a1 1 0 012 0v2a1 1 0 11-2 0V7zm3 0a1 1 0 012 0v2a1 1 0 11-2 0V7z" clip-rule="evenodd"/>
                            </svg>
                            Import Semua Media
                        </button>
                        <a href="{{ route('gallery.index') }}" 
                           class="px-8 py-4 bg-gray-100 dark:bg-dark-card text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Instructions -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Format Instructions -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-6 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-semibold text-blue-800 mb-2">Format Input</h3>
                            <div class="text-sm text-blue-700 space-y-2">
                                <p><strong>Format per baris:</strong></p>
                                <code class="block bg-blue-100 p-2 rounded text-xs">URL|Judul|Deskripsi|Tipe</code>
                                <p><strong>Keterangan:</strong></p>
                                <ul class="list-disc list-inside space-y-1 text-xs">
                                    <li><strong>URL:</strong> URL lengkap dari Cloudinary</li>
                                    <li><strong>Judul:</strong> Judul media (wajib)</li>
                                    <li><strong>Deskripsi:</strong> Deskripsi (opsional)</li>
                                    <li><strong>Tipe:</strong> "image" atau "video" (opsional, default: image)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Example -->
                <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-6 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-semibold text-green-800 mb-2">Contoh Input</h3>
                            <div class="text-xs text-green-700 font-mono bg-green-100 p-3 rounded space-y-1">
                                <div>https://res.cloudinary.com/demo/image/upload/sample.jpg|Foto Kegiatan|Dokumentasi kegiatan kajian|image</div>
                                <div>https://res.cloudinary.com/demo/video/upload/sample.mp4|Video Presentasi|Video presentasi materi|video</div>
                                <div>https://res.cloudinary.com/demo/image/upload/folder/pic1.jpg|Foto Grup||image</div>
                            </div>
                            <p class="text-xs text-green-600 mt-2">
                                <strong>Tips:</strong> Deskripsi dan tipe bisa dikosongkan, tapi tetap gunakan separator "|"
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ route('gallery.cloudinary.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Satu Media
                </a>
                
                <a href="{{ route('gallery.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.413V13H5.5z"/>
                    </svg>
                    Upload File Baru
                </a>
            </div>
        </div>
    </div>
</x-app-layout>