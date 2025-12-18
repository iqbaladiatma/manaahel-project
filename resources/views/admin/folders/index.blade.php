<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-dark-bg dark:to-dark-card pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    📁 Manajemen Folder
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Kelola kategori dan folder untuk galeri
                </p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 dark:text-green-300 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-red-700 dark:text-red-300 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Create New Folder -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                            ➕ Buat Folder Baru
                        </h2>

                        <form action="{{ route('admin.folders.store') }}" method="POST">
                            @csrf
                            
                            <!-- Folder Name -->
                            <div class="mb-4">
                                <label for="folder" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Folder <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="folder" id="folder" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
                                       placeholder="Contoh: Batch 2024, Kegiatan Rutin, dll">
                                @error('folder')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Deskripsi
                                </label>
                                <textarea name="description" id="description" rows="3"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
                                          placeholder="Deskripsi folder (opsional)"></textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full gradient-blue text-white px-6 py-3 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                </svg>
                                Buat Folder
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Existing Folders -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                📂 Folder yang Ada
                            </h2>
                            <button onclick="toggleFileManager()" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5L9 2H4z"/>
                                </svg>
                                Kelola File
                            </button>
                        </div>

                        @if($folders->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($folders as $folderData)
                                    @php
                                        $fileCount = $folderStats->get($folderData->folder)?->count ?? 0;
                                    @endphp
                                    <div class="bg-gray-50 dark:bg-dark-border rounded-xl p-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $folderData->folder }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $fileCount }} file</p>
                                                @if($folderData->description)
                                                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $folderData->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('gallery.index', ['folder' => $folderData->folder]) }}" 
                                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('admin.folders.destroy') }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus folder ini dan semua isinya?')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="folder" value="{{ $folderData->folder }}">
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada folder yang dibuat</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Buat folder pertama di sebelah kiri</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- File Manager Section -->
            <div id="fileManager" class="hidden mt-8">
                <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            📁 Kelola File - Pindahkan ke Folder
                        </h2>
                        <div class="flex gap-3">
                            <button onclick="selectAllFiles()" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                Pilih Semua
                            </button>
                            <button onclick="clearSelection()" 
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                Batal Pilih
                            </button>
                        </div>
                    </div>

                    <!-- Move to Folder Form -->
                    <div class="bg-gray-50 dark:bg-dark-border rounded-xl p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            🎯 Pindahkan File Terpilih
                        </h3>
                        <form id="moveFilesForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Folder Tujuan
                                </label>
                                <select name="target_folder" id="targetFolder" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 transition-all">
                                    <option value="">Pilih Folder</option>
                                    <option value="__new__">+ Buat Folder Baru</option>
                                    @foreach($folders as $folderData)
                                        <option value="{{ $folderData->folder }}">
                                            📁 {{ $folderData->folder }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <input type="text" name="new_folder_name" id="newFolderName" 
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 transition-all mt-2 hidden"
                                       placeholder="Nama folder baru...">
                            </div>
                            
                            <div class="flex items-end">
                                <button type="submit" 
                                        class="w-full gradient-blue text-white px-6 py-3 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5L9 2H4z"/>
                                    </svg>
                                    Pindahkan File
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-4 flex gap-3">
                            <button onclick="removeFromFolder()" 
                                    class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                                📤 Pindah ke Global (Tanpa Folder)
                            </button>
                            <div id="selectedCount" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm">
                                0 file terpilih
                            </div>
                        </div>
                    </div>

                    <!-- Unorganized Files -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            🌐 File Tanpa Folder ({{ $unorganizedFiles->total() }} file)
                        </h3>
                        
                        @if($unorganizedFiles->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                                @foreach($unorganizedFiles as $file)
                                    <div class="file-item bg-gray-50 dark:bg-dark-border rounded-xl p-3 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer"
                                         onclick="toggleFileSelection({{ $file->id }}, this)">
                                        
                                        <!-- File Preview -->
                                        <div class="w-full h-20 mb-2 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if($file->isVideo())
                                                @php
                                                    $thumbnailUrl = null;
                                                    if (str_contains($file->file_path, 'cloudinary.com')) {
                                                        $thumbnailUrl = str_replace('/video/upload/', '/video/upload/w_150,h_100,c_fit,so_0,f_jpg/', $file->file_path);
                                                    }
                                                @endphp
                                                
                                                @if($thumbnailUrl)
                                                    <img src="{{ $thumbnailUrl }}" alt="{{ $file->getTranslatedTitle() }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                                    </svg>
                                                @endif
                                                
                                                <!-- Video indicator -->
                                                <div class="absolute top-1 right-1 bg-red-500 text-white text-xs px-1 rounded">
                                                    🎬
                                                </div>
                                            @else
                                                @php
                                                    $imageUrl = str_starts_with($file->file_path, 'http') 
                                                        ? $file->file_path 
                                                        : asset('storage/' . $file->file_path);
                                                @endphp
                                                <img src="{{ $imageUrl }}" alt="{{ $file->getTranslatedTitle() }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        
                                        <!-- File Info -->
                                        <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">
                                            {{ Str::limit($file->getTranslatedTitle(), 15) }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500">
                                            {{ $file->isVideo() ? 'Video' : 'Image' }}
                                        </p>
                                        
                                        <!-- Selection indicator -->
                                        <div class="selection-indicator hidden absolute top-2 left-2 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $unorganizedFiles->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5L9 2H4z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Semua file sudah terorganisir dalam folder</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back to Gallery -->
            <div class="text-center mt-8">
                <a href="{{ route('gallery.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-dark-border text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>

    <script>
        let selectedFiles = [];

        // Toggle file manager visibility
        function toggleFileManager() {
            const fileManager = document.getElementById('fileManager');
            fileManager.classList.toggle('hidden');
        }

        // Toggle file selection
        function toggleFileSelection(fileId, element) {
            const indicator = element.querySelector('.selection-indicator');
            
            if (selectedFiles.includes(fileId)) {
                // Remove from selection
                selectedFiles = selectedFiles.filter(id => id !== fileId);
                element.classList.remove('ring-4', 'ring-blue-500');
                indicator.classList.add('hidden');
            } else {
                // Add to selection
                selectedFiles.push(fileId);
                element.classList.add('ring-4', 'ring-blue-500');
                indicator.classList.remove('hidden');
            }
            
            updateSelectedCount();
        }

        // Select all files
        function selectAllFiles() {
            selectedFiles = [];
            const fileItems = document.querySelectorAll('.file-item');
            
            fileItems.forEach(item => {
                const fileId = parseInt(item.getAttribute('onclick').match(/\d+/)[0]);
                selectedFiles.push(fileId);
                item.classList.add('ring-4', 'ring-blue-500');
                item.querySelector('.selection-indicator').classList.remove('hidden');
            });
            
            updateSelectedCount();
        }

        // Clear selection
        function clearSelection() {
            selectedFiles = [];
            const fileItems = document.querySelectorAll('.file-item');
            
            fileItems.forEach(item => {
                item.classList.remove('ring-4', 'ring-blue-500');
                item.querySelector('.selection-indicator').classList.add('hidden');
            });
            
            updateSelectedCount();
        }

        // Update selected count display
        function updateSelectedCount() {
            document.getElementById('selectedCount').textContent = `${selectedFiles.length} file terpilih`;
        }

        // Handle folder selection
        document.getElementById('targetFolder').addEventListener('change', function() {
            const newFolderInput = document.getElementById('newFolderName');
            
            if (this.value === '__new__') {
                newFolderInput.classList.remove('hidden');
                newFolderInput.required = true;
            } else {
                newFolderInput.classList.add('hidden');
                newFolderInput.required = false;
                newFolderInput.value = '';
            }
        });



        // Handle move files form submission
        document.getElementById('moveFilesForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (selectedFiles.length === 0) {
                alert('Pilih file yang ingin dipindahkan terlebih dahulu!');
                return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');

            
            let targetFolder;
            if (document.getElementById('targetFolder').value === '__new__') {
                targetFolder = document.getElementById('newFolderName').value;
                if (!targetFolder) {
                    alert('Masukkan nama folder baru!');
                    return;
                }
            } else {
                targetFolder = document.getElementById('targetFolder').value;
            }
            
            formData.append('target_folder', targetFolder);
            
            selectedFiles.forEach(fileId => {
                formData.append('file_ids[]', fileId);
            });
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<svg class="animate-spin w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memindahkan...';
            submitBtn.disabled = true;
            
            fetch('{{ route("admin.folders.move-files") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Refresh page to show updated files
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memindahkan file');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // Remove files from folder (move to global)
        function removeFromFolder() {
            if (selectedFiles.length === 0) {
                alert('Pilih file yang ingin dipindahkan ke global terlebih dahulu!');
                return;
            }
            
            if (!confirm(`Yakin ingin memindahkan ${selectedFiles.length} file ke global (tanpa folder)?`)) {
                return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            
            selectedFiles.forEach(fileId => {
                formData.append('file_ids[]', fileId);
            });
            
            fetch('{{ route("admin.folders.remove-from-folder") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memindahkan file');
            });
        }
    </script>
</x-app-layout>