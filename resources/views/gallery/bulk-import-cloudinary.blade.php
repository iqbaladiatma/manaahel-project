<x-app-layout>
    <div class="py-12 mt-20 bg-gray-50 dark:bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-blue-600 rounded-2xl shadow-xl dark:shadow-dark-border p-8 mb-8 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 014 11.5V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Bulk Import Cloudinary</h1>
                        <p class="text-green-100 mt-1">Import ratusan foto sekaligus dengan mudah</p>
                    </div>
                </div>
            </div>

            <!-- Method 1: Auto Import dari Cloudinary API -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden mb-8">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        🤖 Method 1: Auto Import (Recommended)
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Sistem otomatis mengambil semua foto dari Cloudinary menggunakan API
                    </p>

                    <form action="{{ route('gallery.cloudinary.auto-import') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Link Folder Cloudinary atau Nama Folder
                                </label>
                                <input type="text" name="folder" 
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all"
                                       placeholder="Paste link folder atau ketik nama folder (contoh: gallery, photos)">
                                <p class="text-sm text-gray-500 mt-1">
                                    Bisa paste link folder Cloudinary atau ketik nama folder saja<br>
                                    Contoh: https://console.cloudinary.com/console/c-xxx/media_library/folders/gallery<br>
                                    Atau cukup: gallery
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Maksimal Import
                                </label>
                                <select name="limit" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                    <option value="50">50 foto</option>
                                    <option value="100" selected>100 foto</option>
                                    <option value="200">200 foto</option>
                                    <option value="500">500 foto</option>
                                    <option value="1000">1000 foto</option>
                                </select>
                            </div>
                        </div>

                        <!-- Folder Options -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                📁 Opsi Folder Tujuan
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        Folder
                                    </label>
                                    <select name="target_folder" id="targetFolder"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 transition-all">
                                        <option value="">Tanpa Folder (Global)</option>
                                        <option value="__new__">+ Buat Folder Baru</option>
                                        @php
                                            $existingFolders = \App\Models\GalleryFolder::orderBy('folder')->get();
                                        @endphp
                                        @foreach($existingFolders as $folderItem)
                                            <option value="{{ $folderItem->folder }}">
                                                📁 {{ $folderItem->folder }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- New Folder Fields -->
                                <div id="newFolderFields" class="hidden">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Nama Folder Baru
                                    </label>
                                    <input type="text" name="new_folder_name" 
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 transition-all mb-2"
                                           placeholder="Contoh: Batch 2024">
                                    
                                    <input type="text" name="new_folder_description" 
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 transition-all"
                                           placeholder="Deskripsi folder (opsional)">
                                    <input type="hidden" name="create_new_folder" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Visibilitas Default
                                </label>
                                <select name="visibility" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                    <option value="public">Publik</option>
                                    <option value="member_only">Khusus Member</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Filter Angkatan (Opsional)
                                </label>
                                <input type="number" name="batch_filter" min="2020" max="2030"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all"
                                       placeholder="2024">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            🚀 Auto Import Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <!-- Method 2: Manual List -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden mb-8">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        📝 Method 2: Manual List
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Copy-paste daftar URL foto dari Cloudinary
                    </p>

                    <form action="{{ route('gallery.cloudinary.bulk-store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Daftar URL Foto
                            </label>
                            <textarea name="media_list" rows="10" 
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all font-mono text-sm"
                                      placeholder="Format: URL|Judul|Deskripsi|Tipe

Contoh:
https://res.cloudinary.com/demo/image/upload/photo1.jpg|Foto Kegiatan 1|Dokumentasi kegiatan|image
https://res.cloudinary.com/demo/image/upload/photo2.jpg|Foto Kegiatan 2|Dokumentasi kegiatan|image
https://res.cloudinary.com/demo/video/upload/video1.mp4|Video Kegiatan|Video dokumentasi|video

Tips: Judul, deskripsi, dan tipe bisa dikosongkan
https://res.cloudinary.com/demo/image/upload/photo3.jpg|||image"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Visibilitas Default
                                </label>
                                <select name="default_visibility" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                    <option value="public">Publik</option>
                                    <option value="member_only">Khusus Member</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Filter Angkatan Default
                                </label>
                                <input type="number" name="default_batch_filter" min="2020" max="2030"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all"
                                       placeholder="2024">
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                📝 Import dari List
                            </button>
                            <a href="{{ route('gallery.url-generator') }}" class="px-6 py-4 bg-indigo-500 text-white rounded-xl font-semibold hover:bg-indigo-600 transition-all flex items-center">
                                🛠️ URL Generator
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Method 3: URL Generator Helper -->
            <div class="bg-indigo-50 dark:bg-indigo-900/20 border-l-4 border-indigo-500 p-6 rounded-lg mb-8">
                <h3 class="text-lg font-semibold text-indigo-800 dark:text-indigo-200 mb-2">
                    🛠️ Method 3: URL Generator Helper
                </h3>
                <p class="text-indigo-700 dark:text-indigo-300 mb-4">
                    Tool khusus untuk generate URL list dari folder Cloudinary Anda:
                </p>
                <div class="space-y-2 text-indigo-700 dark:text-indigo-300 text-sm">
                    <p>1. Masukkan Cloud Name dan Folder Name</p>
                    <p>2. Copy-paste daftar nama file dari Cloudinary</p>
                    <p>3. Generate URL list otomatis</p>
                    <p>4. Copy hasil ke Method 2 di atas</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('gallery.url-generator') }}" 
                       class="inline-flex items-center px-6 py-3 bg-indigo-500 text-white font-semibold rounded-lg hover:bg-indigo-600 transition-all">
                        🛠️ Buka URL Generator
                    </a>
                </div>
            </div>

            <!-- Method 4: Command Line -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-2">
                    ⚡ Method 4: Command Line (Super Cepat)
                </h3>
                <p class="text-blue-700 dark:text-blue-300 mb-4">
                    Untuk developer yang suka command line, bisa pakai artisan command:
                </p>
                <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg font-mono text-sm">
                    <div class="text-blue-800 dark:text-blue-200">
                        # Import semua foto<br>
                        php artisan cloudinary:import<br><br>
                        
                        # Import dari folder tertentu<br>
                        php artisan cloudinary:import --folder=gallery<br><br>
                        
                        # Import dengan limit<br>
                        php artisan cloudinary:import --limit=500<br><br>
                        
                        # Lihat daftar foto di Cloudinary<br>
                        php artisan cloudinary:list
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">
                    💡 Tips untuk Import Banyak Foto
                </h3>
                <ul class="text-yellow-700 dark:text-yellow-300 space-y-2">
                    <li>• <strong>Gunakan Method 1 (Auto Import)</strong> untuk cara tercepat</li>
                    <li>• <strong>Organisir foto</strong> di Cloudinary dalam folder sebelum import</li>
                    <li>• <strong>Beri nama file</strong> yang deskriptif di Cloudinary</li>
                    <li>• <strong>Import bertahap</strong> jika foto sangat banyak (500+ foto)</li>
                    <li>• <strong>Cek hasil</strong> di gallery setelah import</li>
                    <li>• <strong>Backup database</strong> sebelum import besar-besaran</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Handle folder selection
        document.getElementById('targetFolder').addEventListener('change', function() {
            const newFolderFields = document.getElementById('newFolderFields');
            const createNewFolderInput = document.querySelector('input[name="create_new_folder"]');
            
            if (this.value === '__new__') {
                newFolderFields.classList.remove('hidden');
                createNewFolderInput.value = '1';
            } else {
                newFolderFields.classList.add('hidden');
                createNewFolderInput.value = '0';
            }
        });



        // Auto-fill from URL Generator if data exists
        document.addEventListener('DOMContentLoaded', function() {
            const bulkUrls = localStorage.getItem('cloudinaryBulkUrls');
            if (bulkUrls) {
                const textarea = document.querySelector('textarea[name="media_list"]');
                if (textarea) {
                    textarea.value = bulkUrls;
                    
                    // Show notification
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                    notification.textContent = '✅ URL list loaded from generator!';
                    document.body.appendChild(notification);
                    
                    // Remove notification after 3 seconds
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                    
                    // Clear localStorage
                    localStorage.removeItem('cloudinaryBulkUrls');
                }
            }
        });
    </script>
</x-app-layout>