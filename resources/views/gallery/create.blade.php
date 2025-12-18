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
                    {{ __('Back to Gallery') }}
                </a>
            </div>

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-xl dark:shadow-dark-border p-8 mb-8 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Upload Media ke Galeri</h1>
                        <p class="text-blue-100 mt-1">
                            @if(Auth::user()->isAdmin())
                                Upload foto dan video sebagai administrator
                            @else
                                Bagikan momen Anda dengan komunitas
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Admin Badge -->
                @if(Auth::user()->isAdmin())
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ __('Admin Mode') }}</span>
                    </div>
                @endif
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <!-- Media Upload -->
                    <div class="mb-6">
                        <label for="media" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Foto atau Video <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-dark-border border-dashed rounded-xl hover:border-blue-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="media" class="relative cursor-pointer bg-white dark:bg-dark-card rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload file</span>
                                        <input id="media" name="media" type="file" class="sr-only" accept="image/*,video/*" required onchange="previewMedia(event)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-500">
                                    Foto: PNG, JPG, GIF (max 5MB)<br>
                                    Video: MP4, AVI, MOV, WMV, FLV, WEBM, MKV (max 50MB)
                                </p>
                            </div>
                        </div>
                        @error('media')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Media Preview -->
                        <div id="mediaPreview" class="mt-4 hidden">
                            <img id="imagePreview" class="w-full h-64 object-cover rounded-xl border-2 border-gray-200 dark:border-dark-border hidden" alt="Preview">
                            <video id="videoPreview" class="w-full h-64 object-cover rounded-xl border-2 border-gray-200 dark:border-dark-border hidden" controls>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <!-- Assign to Member (Admin Only) -->
                    @if(Auth::user()->isAdmin())
                        <div class="mb-6">
                            <label for="member_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                {{ __('Assign to Member Angkatan') }} <span class="text-gray-500 dark:text-gray-500">({{ __('Optional') }})</span>
                            </label>
                            <select name="member_id" 
                                    id="member_id"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                                <option value="">{{ __('-- General Gallery (No specific member) --') }}</option>
                                @foreach(\App\Models\User::where('role', 'member_angkatan')->orderBy('name')->get() as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} @if($member->batch_year)({{ $member->batch_year }})@endif
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                                {{ __('Select a member if this photo belongs to them, or leave empty for general gallery') }}
                            </p>
                            @error('member_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

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
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
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
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
                                  placeholder="Ceritakan tentang foto atau video ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Folder -->
                    <div class="mb-6">
                        <label for="folder" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Folder
                        </label>
                        <div class="relative">
                            <select name="folder_select" 
                                    id="folder_select" 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all mb-2"
                                    onchange="handleFolderSelection()">
                                <option value="">-- Pilih Folder yang Ada --</option>
                                <option value="__new__">+ Buat Folder Baru</option>
                                @php
                                    $existingFolders = \App\Models\GalleryFolder::orderBy('folder')->get();
                                @endphp
                                @foreach($existingFolders as $folderItem)
                                    <option value="{{ $folderItem->folder }}">
                                        📁 {{ $folderItem->folder }}
                                        @if($folderItem->description)
                                            - {{ Str::limit($folderItem->description, 30) }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            
                            <input type="text" 
                                   name="folder" 
                                   id="folder" 
                                   value="{{ old('folder') }}"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
                                   placeholder="Atau ketik nama folder baru..."
                                   style="display: none;">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Pilih folder yang sudah ada atau buat folder baru</p>
                        @error('folder')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 gradient-blue text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            Upload Media
                        </button>
                        <a href="{{ route('gallery.index') }}" 
                           class="px-8 py-4 bg-gray-100 dark:bg-dark-card text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 dark:bg-blue-dark/20 border-l-4 border-blue-500 p-6 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-semibold text-blue-800 mb-2">Panduan Upload</h3>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Ukuran maksimal foto: 5MB</li>
                            <li>• Ukuran maksimal video: 50MB</li>
                            <li>• Format foto: JPG, PNG, GIF</li>
                            <li>• Format video: MP4, AVI, MOV, WMV, FLV, WEBM, MKV</li>
                            <li>• Media akan disimpan di Cloudinary untuk performa optimal</li>
                            <li>• Media Anda akan terlihat oleh semua anggota</li>
                            <li>• Harap upload konten yang sesuai saja</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewMedia(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                const mediaPreview = document.getElementById('mediaPreview');
                const imagePreview = document.getElementById('imagePreview');
                const videoPreview = document.getElementById('videoPreview');
                
                // Hide both previews first
                imagePreview.classList.add('hidden');
                videoPreview.classList.add('hidden');
                
                if (file.type.startsWith('image/')) {
                    // Show image preview
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        mediaPreview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    // Show video preview
                    reader.onload = function(e) {
                        videoPreview.src = e.target.result;
                        videoPreview.classList.remove('hidden');
                        mediaPreview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            }
        }

        // Handle folder selection
        function handleFolderSelection() {
            const folderSelect = document.getElementById('folder_select');
            const folderInput = document.getElementById('folder');
            
            if (folderSelect.value === '__new__') {
                // Show input for new folder
                folderSelect.style.display = 'none';
                folderInput.style.display = 'block';
                folderInput.focus();
                folderInput.value = '';
            } else if (folderSelect.value) {
                // Use existing folder
                folderInput.value = folderSelect.value;
            } else {
                // No folder selected
                folderInput.value = '';
            }
        }
        
        // Allow switching back to folder select
        document.getElementById('folder').addEventListener('blur', function() {
            if (this.value === '') {
                document.getElementById('folder_select').style.display = 'block';
                this.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
