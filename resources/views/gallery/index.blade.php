<x-app-layout>
    <style>
        /* Optimize image rendering for crisp display */
        .gallery-image {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: -moz-crisp-edges;
            image-rendering: crisp-edges;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            will-change: transform;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Prevent blur on hover transform */
        .gallery-card:hover .gallery-image {
            -webkit-transform: translateZ(0) scale(1.05);
            transform: translateZ(0) scale(1.05);
        }
        
        /* Add toggle functionality for images too */
        .gallery-image {
            cursor: pointer;
        }
        
        .gallery-image:hover::after {
            content: '📐 Click to toggle fit';
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .gallery-card:hover .gallery-image:hover::after {
            opacity: 1;
        }
        
        /* Enhanced lightbox styles */
        #lightbox {
            backdrop-filter: blur(2px);
        }
        
        #lightbox-image {
            max-width: 95vw;
            max-height: 85vh;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        /* Ensure proper aspect ratio handling */
        #lightbox-image.object-contain {
            object-fit: contain !important;
        }
        
        #lightbox-image.object-cover {
            object-fit: cover !important;
        }
    </style>
    
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-dark-bg dark:to-dark-card pt-32 pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Arabic Text -->
            <div class="mb-4">
                <p class="text-3xl text-gold dark:text-gold-light mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                    مَعْرِضُ الصُّوَرِ
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 italic">Ma'ridhush Shuwar - Galeri Foto</p>
            </div>

            <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4 animate-fade-in">
                Galeri Manaahel
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 animate-slide-up">
                Dokumentasi kegiatan dan momen berharga Manaahel
            </p>
            
            <!-- Action Buttons -->
            @auth
                <div class="mt-8 flex flex-wrap gap-4 justify-center">
                    @if(Auth::user()->isMemberAngkatan() || Auth::user()->isAdmin())
                        <a href="{{ route('gallery.create') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 dark:from-gold-dark dark:to-gold text-white font-semibold rounded-xl hover:shadow-xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105 shadow-lg dark:shadow-dark-border">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            Upload File
                        </a>
                    @endif
                    
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('gallery.cloudinary.create') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                            + Cloudinary
                        </a>
                        
                        <a href="{{ route('gallery.bulk-import') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            🚀 Auto Import
                        </a>
                        
                        <a href="{{ route('admin.folders.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                            </svg>
                            📁 Kelola Folder
                        </a>
                    @endif
                </div>
            @else
                <!-- Not logged in -->
                <div class="mt-6">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gray-200 dark:bg-dark-card text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-dark-border transition-all duration-300">
                        Login untuk Upload File
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Main Gallery Content -->
    <div class="pb-16 bg-gray-50 dark:bg-dark-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($galleries->isEmpty())
                <!-- Empty State -->
                <div class="bg-white dark:bg-dark-card rounded-3xl border-2 border-gray-200 dark:border-dark-border p-16 text-center shadow-xl dark:shadow-dark-border">
                    <div class="w-32 h-32 gradient-blue rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl dark:shadow-gold/20">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <!-- Arabic Text -->
                    <div class="mb-4">
                        <p class="text-3xl text-gold dark:text-gold-light mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                            قَرِيبًا
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 italic">Qariiban - Segera Hadir</p>
                    </div>

                    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Belum Ada Foto</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                        Galeri masih kosong. Jadilah yang pertama mengunggah foto dokumentasi kegiatan Manaahel!
                    </p>

                    @auth
                        @if(Auth::user()->isMemberAngkatan() || Auth::user()->isAdmin())
                            <a href="{{ route('gallery.create') }}" 
                               class="inline-flex items-center px-10 py-4 gradient-gold text-white font-bold rounded-xl hover:shadow-2xl dark:hover:shadow-gold/20 transition-all transform hover:scale-105">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                </svg>
                                Upload Foto Pertama
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-10 py-4 gradient-blue text-white font-bold rounded-xl hover:shadow-2xl dark:hover:shadow-gold/20 transition-all transform hover:scale-105">
                            Login untuk Upload
                        </a>
                    @endauth
                </div>
            @else
                <!-- Gallery Grid -->
                <div>
                    <!-- Header -->
                    <div class="mb-8 flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Galeri Foto</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $galleries->total() }} foto tersedia</p>
                        </div>


                    </div>



                    <!-- Folders Section (if no specific folder selected) -->
                    @if(!request('folder') && isset($folders) && $folders->count() > 0)
                        <div class="mb-12">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">📁 Folder</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                                @foreach($folders as $folder)
                                    @php
                                        $fileCount = isset($folderStats) ? ($folderStats->get($folder->folder)?->count ?? 0) : 0;
                                    @endphp
                                    <div class="bg-white dark:bg-dark-card rounded-2xl border-2 border-gray-100 dark:border-dark-border p-6 text-center hover:border-blue-primary dark:hover:border-gold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer"
                                         onclick="openFolder('{{ $folder->folder }}')">
                                        
                                        <!-- Folder Icon -->
                                        <div class="text-5xl mb-4 text-blue-500 dark:text-blue-400">
                                            📁
                                        </div>
                                        
                                        <!-- Folder Name -->
                                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">
                                            {{ $folder->folder }}
                                        </h4>
                                        
                                        <!-- File Count -->
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            {{ $fileCount }} file{{ $fileCount != 1 ? 's' : '' }}
                                        </p>
                                        
                                        <!-- Description -->
                                        @if($folder->description)
                                            <p class="text-xs text-gray-500 dark:text-gray-500 line-clamp-2 mb-3">
                                                {{ $folder->description }}
                                            </p>
                                        @endif
                                        
                                        <!-- Creator Info -->
                                        @if($folder->creator)
                                            <div class="flex items-center justify-center">
                                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center mr-2">
                                                    <span class="text-white text-xs font-bold">
                                                        {{ strtoupper(substr($folder->creator->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-500 dark:text-gray-500">
                                                    {{ $folder->creator->name }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Files Grid -->
                    @if(!request('folder'))
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                            🌐 File Global
                        </h3>
                    @endif
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($galleries as $gallery)
                            <div class="group gallery-card bg-white dark:bg-dark-card rounded-2xl border-2 border-gray-100 dark:border-dark-border overflow-hidden hover:border-blue-primary dark:hover:border-gold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-1">
                                <!-- Media (Image or Video) -->
                                <div class="w-full h-64 overflow-hidden bg-gray-100 dark:bg-dark-card relative">
                                    @if($gallery->isVideo())
                                        <!-- Video -->
                                        @php
                                            $originalVideoUrl = str_starts_with($gallery->file_path, 'http') 
                                                ? $gallery->file_path 
                                                : asset('storage/' . $gallery->file_path);
                                            
                                            // Try direct URL first (test without proxy)
                                            if (str_contains($gallery->file_path, 'cloudinary.com')) {
                                                $videoUrl = $originalVideoUrl; // Direct URL for testing
                                                // Fix Cloudinary video thumbnail URL - simple
                                                $thumbnailUrl = str_replace('/video/upload/', '/video/upload/w_600,h_400,c_fit,so_0,f_jpg/', $gallery->file_path);
                                            } else {
                                                $videoUrl = $originalVideoUrl;
                                                $thumbnailUrl = null;
                                            }
                                        @endphp
                                        
                                        <!-- Video Container - Enhanced -->
                                        <div class="relative w-full h-full video-container" data-video-url="{{ $videoUrl }}">
                                            
                                            <!-- Fit Mode Indicator -->
                                            <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded z-10 opacity-0 hover:opacity-100 transition-opacity">
                                                📐 Double-click to toggle fit
                                            </div>
                                            
                                            <!-- Video Player - Simplified for debugging -->
                                            <video class="w-full h-full object-contain video-element" 
                                                   controls 
                                                   preload="metadata"
                                                   @if($thumbnailUrl) poster="{{ $thumbnailUrl }}" @endif
                                                   playsinline
                                                   onloadstart="console.log('✅ Video loading started:', this.src)"
                                                   oncanplay="console.log('✅ Video can play:', this.src)"
                                                   onerror="console.error('❌ Video error:', this.error, 'URL:', this.src); handleVideoError(this)"
                                                   onloadeddata="console.log('✅ Video data loaded:', this.src)"
                                                   ondblclick="toggleVideoFit(this)"
                                                   title="Double-click untuk toggle antara fit modes (contain/cover)"
                                                
                                                <!-- Primary video source -->
                                                <source src="{{ $videoUrl }}" type="video/mp4">
                                                
                                                <!-- Fallback: try proxy if direct fails -->
                                                @if(str_contains($gallery->file_path, 'cloudinary.com'))
                                                    <source src="{{ route('video.stream', ['url' => $originalVideoUrl]) }}" type="video/mp4">
                                                @endif
                                                
                                                <!-- Fallback content -->
                                                <div class="w-full h-full bg-gray-800 flex items-center justify-center text-white">
                                                    <div class="text-center p-4">
                                                        <div class="text-4xl mb-2">⚠️</div>
                                                        <p class="mb-2">Browser tidak mendukung video</p>
                                                        <a href="{{ $videoUrl }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm" target="_blank">
                                                            📥 Download Video
                                                        </a>
                                                        <br>
                                                        <button onclick="retryVideo(this)" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                                            🔄 Retry Load
                                                        </button>
                                                    </div>
                                                </div>
                                            </video>
                                            
                                            <!-- Loading Indicator -->
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center video-loading" style="display: none;">
                                                <div class="text-white text-center">
                                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-white mx-auto mb-2"></div>
                                                    <p class="text-sm">Loading video...</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Error Overlay -->
                                            <div class="absolute inset-0 bg-red-900 bg-opacity-90 flex items-center justify-center video-error" style="display: none;">
                                                <div class="text-white text-center p-4">
                                                    <div class="text-4xl mb-2">❌</div>
                                                    <p class="mb-2 text-sm">Video tidak dapat dimuat</p>
                                                    <div class="space-y-2">
                                                        <a href="{{ $videoUrl }}" class="block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm" target="_blank">
                                                            📥 Download Video
                                                        </a>
                                                        <button onclick="retryVideo(this)" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                                            🔄 Retry
                                                        </button>
                                                        <button onclick="showVideoInfo(this)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-sm">
                                                            ℹ️ Info
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Video Info Overlay -->
                                            <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                                🎬 {{ $gallery->getTranslatedTitle() }}
                                            </div>
                                        </div>
                                    @else
                                        <!-- Image -->
                                        @if($gallery->file_path)
                                            @php
                                                // Handle both Cloudinary URLs and local files
                                                $imageUrl = str_starts_with($gallery->file_path, 'http') 
                                                    ? $gallery->file_path 
                                                    : asset('storage/' . $gallery->file_path);
                                                
                                                // For Cloudinary URLs, add optimization parameters
                                                if (str_contains($gallery->file_path, 'cloudinary.com')) {
                                                    // Use original image first to test
                                                    $imageUrl = $gallery->file_path;
                                                    // Full size for lightbox
                                                    $fullImageUrl = $gallery->file_path;
                                                } else {
                                                    $fullImageUrl = $imageUrl;
                                                }
                                            @endphp
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $gallery->getTranslatedTitle() }}"
                                                 class="w-full h-full object-contain gallery-image transition-transform duration-200 cursor-pointer"
                                                 loading="lazy"
                                                 decoding="async"
                                                 onclick="openLightbox('{{ $fullImageUrl ?? $imageUrl }}', '{{ $gallery->getTranslatedTitle() }}')"
                                                 ondblclick="toggleImageFit(this)"
                                                 title="Click: Lightbox | Double-click: Toggle fit mode"
                                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center\'><svg class=\'w-16 h-16 text-gray-300\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'/></svg></div>'">
                                        @else
                                            <!-- No media -->
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Media type indicator -->
                                    <div class="absolute top-3 right-3">
                                        @if($gallery->isVideo())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM5 8a1 1 0 011-1h1a1 1 0 010 2H6a1 1 0 01-1-1zm6 1a1 1 0 100 2h3a1 1 0 100-2H11z"/>
                                                </svg>
                                                Video
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                </svg>
                                                Foto
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2">
                                        {{ $gallery->getTranslatedTitle() }}
                                    </h3>

                                    <!-- Description -->
                                    @if($gallery->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2 leading-relaxed">
                                            {{ $gallery->description }}
                                        </p>
                                    @endif

                                    <!-- Folder Tag -->
                                    @if($gallery->folder)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="inline-block px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-medium rounded-full">
                                                📂 {{ $gallery->folder }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-dark-border">
                                        <!-- Member Info -->
                                        @if($gallery->user)
                                            <div class="flex items-center">
                                                @if($gallery->user->avatar_url)
                                                    <img src="{{ $gallery->user->avatar_url }}" 
                                                         alt="{{ $gallery->user->name }}"
                                                         class="w-8 h-8 rounded-full object-cover mr-2 border-2 border-blue-100 dark:border-gold/30">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-2 border-2 border-blue-100 dark:border-gold/30">
                                                        <span class="text-white text-xs font-bold">
                                                            {{ strtoupper(substr($gallery->user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="text-xs font-semibold text-gray-900 dark:text-gray-100">{{ $gallery->user->name }}</p>
                                                    @if($gallery->user->batch_year)
                                                        <p class="text-xs text-gray-500 dark:text-gray-500">Angkatan {{ $gallery->user->batch_year }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center mr-2">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-semibold text-gray-900 dark:text-gray-100">Umum</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-500">Galeri</p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Date -->
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 dark:text-gray-500">
                                                {{ $gallery->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $galleries->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden flex items-center justify-center p-4">
        <div class="relative w-full h-full flex items-center justify-center">
            <!-- Close button -->
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10 bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <!-- Toggle Fit Button -->
            <button onclick="toggleLightboxFit()" class="absolute top-4 left-4 text-white hover:text-gray-300 transition-colors z-10 bg-black bg-opacity-50 rounded-full p-2" title="Toggle fit mode">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h6v2H6v4H4V4zm10 0h6v6h-2V6h-4V4zM4 14h2v4h4v2H4v-6zm16 0v6h-6v-2h4v-4h2z"/>
                </svg>
            </button>
            
            <!-- Image Container -->
            <div class="w-full h-full flex items-center justify-center">
                <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg transition-all duration-300" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
            </div>
            
            <!-- Title -->
            <div id="lightbox-title" class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-70 text-white p-4 rounded-lg text-center">
            </div>
            
            <!-- Instructions -->
            <div class="absolute bottom-16 left-4 right-4 text-white text-sm text-center opacity-70">
                <p>ESC: Tutup • F/Space: Toggle Fit • Click Background: Tutup</p>
            </div>
        </div>
    </div>

    <script>
        // Enhanced Lightbox functionality
        function openLightbox(imageSrc, title) {
            const lightboxImage = document.getElementById('lightbox-image');
            lightboxImage.src = imageSrc;
            lightboxImage.style.objectFit = 'contain'; // Reset to contain
            lightboxImage.classList.remove('object-cover');
            lightboxImage.classList.add('object-contain');
            
            document.getElementById('lightbox-title').textContent = title;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            console.log('🖼️ Lightbox opened:', imageSrc);
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Toggle lightbox image fit mode
        function toggleLightboxFit() {
            const lightboxImage = document.getElementById('lightbox-image');
            const currentFit = lightboxImage.style.objectFit || 'contain';
            
            if (currentFit === 'contain' || lightboxImage.classList.contains('object-contain')) {
                lightboxImage.classList.remove('object-contain');
                lightboxImage.classList.add('object-cover');
                lightboxImage.style.objectFit = 'cover';
                console.log('🖼️ Lightbox fit changed to: cover');
                
                // Show notification
                showLightboxNotification('📐 Fit: Cover (Fill Screen)');
            } else {
                lightboxImage.classList.remove('object-cover');
                lightboxImage.classList.add('object-contain');
                lightboxImage.style.objectFit = 'contain';
                console.log('🖼️ Lightbox fit changed to: contain');
                
                // Show notification
                showLightboxNotification('📐 Fit: Contain (Full Image)');
            }
        }
        
        // Show notification in lightbox
        function showLightboxNotification(message) {
            const lightbox = document.getElementById('lightbox');
            
            // Remove existing notification
            const existingNotification = lightbox.querySelector('.lightbox-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = 'lightbox-notification absolute top-16 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-75 text-white px-4 py-2 rounded-lg text-sm z-20';
            notification.textContent = message;
            notification.style.pointerEvents = 'none';
            
            lightbox.appendChild(notification);
            
            // Remove after 2 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 2000);
        }

        // Enhanced keyboard shortcuts for lightbox
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox.classList.contains('hidden')) {
                switch(e.key) {
                    case 'Escape':
                        closeLightbox();
                        break;
                    case 'f':
                    case 'F':
                        toggleLightboxFit();
                        break;
                    case ' ':
                        e.preventDefault();
                        toggleLightboxFit();
                        break;
                }
            }
        });

        // Close lightbox on background click
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Enhanced video error handling
        function handleVideoError(videoElement) {
            console.error('🎬 Video Error:', videoElement.error);
            
            const container = videoElement.closest('.video-container');
            const errorOverlay = container.querySelector('.video-error');
            const loadingOverlay = container.querySelector('.video-loading');
            
            // Hide loading, show error
            if (loadingOverlay) loadingOverlay.style.display = 'none';
            if (errorOverlay) errorOverlay.style.display = 'flex';
            
            // Log detailed error info
            if (videoElement.error) {
                const errorMessages = {
                    1: 'MEDIA_ERR_ABORTED - Video loading aborted',
                    2: 'MEDIA_ERR_NETWORK - Network error while loading video',
                    3: 'MEDIA_ERR_DECODE - Video decoding error',
                    4: 'MEDIA_ERR_SRC_NOT_SUPPORTED - Video format not supported'
                };
                
                const errorMsg = errorMessages[videoElement.error.code] || 'Unknown video error';
                console.error('Video Error Details:', errorMsg);
            }
        }
        
        // Retry video loading
        function retryVideo(buttonElement) {
            const container = buttonElement.closest('.video-container');
            const video = container.querySelector('.video-element');
            const errorOverlay = container.querySelector('.video-error');
            const loadingOverlay = container.querySelector('.video-loading');
            
            console.log('🔄 Retrying video load...');
            
            // Hide error, show loading
            if (errorOverlay) errorOverlay.style.display = 'none';
            if (loadingOverlay) loadingOverlay.style.display = 'flex';
            
            // Reload video
            video.load();
            
            // Hide loading after timeout
            setTimeout(() => {
                if (loadingOverlay) loadingOverlay.style.display = 'none';
            }, 5000);
        }
        
        // Show video technical info
        function showVideoInfo(buttonElement) {
            const container = buttonElement.closest('.video-container');
            const video = container.querySelector('.video-element');
            const videoUrl = container.dataset.videoUrl;
            
            const info = {
                url: videoUrl,
                readyState: video.readyState,
                networkState: video.networkState,
                duration: video.duration,
                currentSrc: video.currentSrc,
                error: video.error ? video.error.code : 'None'
            };
            
            alert(`Video Info:\n\nURL: ${info.url}\nReady State: ${info.readyState}\nNetwork State: ${info.networkState}\nDuration: ${info.duration}\nCurrent Source: ${info.currentSrc}\nError Code: ${info.error}`);
        }
        
        // Toggle video object-fit between cover and contain
        function toggleVideoFit(videoElement) {
            const currentFit = videoElement.style.objectFit || 'contain';
            
            if (currentFit === 'contain' || videoElement.classList.contains('object-contain')) {
                videoElement.classList.remove('object-contain');
                videoElement.classList.add('object-cover');
                videoElement.style.objectFit = 'cover';
                console.log('🎬 Video fit changed to: cover (fill container)');
                
                // Show temporary notification
                showVideoNotification(videoElement, '📐 Fit: Cover (Fill Container)');
            } else {
                videoElement.classList.remove('object-cover');
                videoElement.classList.add('object-contain');
                videoElement.style.objectFit = 'contain';
                console.log('🎬 Video fit changed to: contain (full video visible)');
                
                // Show temporary notification
                showVideoNotification(videoElement, '📐 Fit: Contain (Full Video)');
            }
        }
        
        // Toggle image object-fit between cover and contain
        function toggleImageFit(imageElement) {
            const currentFit = imageElement.style.objectFit || 'contain';
            
            if (currentFit === 'contain' || imageElement.classList.contains('object-contain')) {
                imageElement.classList.remove('object-contain');
                imageElement.classList.add('object-cover');
                imageElement.style.objectFit = 'cover';
                console.log('🖼️ Image fit changed to: cover (fill container)');
                
                // Show temporary notification
                showImageNotification(imageElement, '📐 Fit: Cover (Fill Container)');
            } else {
                imageElement.classList.remove('object-cover');
                imageElement.classList.add('object-contain');
                imageElement.style.objectFit = 'contain';
                console.log('🖼️ Image fit changed to: contain (full image visible)');
                
                // Show temporary notification
                showImageNotification(imageElement, '📐 Fit: Contain (Full Image)');
            }
        }
        
        // Show temporary notification on image
        function showImageNotification(imageElement, message) {
            const container = imageElement.closest('.gallery-card');
            
            // Remove existing notification
            const existingNotification = container.querySelector('.image-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = 'image-notification absolute top-2 left-2 bg-black bg-opacity-75 text-white px-3 py-1 rounded text-sm z-20';
            notification.textContent = message;
            notification.style.pointerEvents = 'none';
            
            container.style.position = 'relative';
            container.appendChild(notification);
            
            // Remove after 2 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 2000);
        }
        
        // Open folder function
        function openFolder(folder) {
            window.location.href = `{{ route('gallery.index') }}?folder=${folder}`;
        }
        
        // Show temporary notification on video
        function showVideoNotification(videoElement, message) {
            const container = videoElement.closest('.video-container');
            
            // Remove existing notification
            const existingNotification = container.querySelector('.video-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = 'video-notification absolute top-2 left-2 bg-black bg-opacity-70 text-white px-3 py-1 rounded text-sm z-10';
            notification.textContent = message;
            
            container.appendChild(notification);
            
            // Remove after 2 seconds
            setTimeout(() => {
                notification.remove();
            }, 2000);
        }

        // Initialize video players on page load
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.video-element');
            
            videos.forEach((video, index) => {
                console.log(`🎬 Initializing video ${index + 1}`);
                
                // Add comprehensive event listeners
                video.addEventListener('loadstart', function() {
                    console.log(`📡 Video ${index + 1}: Load started`);
                    const container = video.closest('.video-container');
                    const loading = container.querySelector('.video-loading');
                    if (loading) loading.style.display = 'flex';
                });
                
                video.addEventListener('canplay', function() {
                    console.log(`✅ Video ${index + 1}: Can play`);
                    const container = video.closest('.video-container');
                    const loading = container.querySelector('.video-loading');
                    if (loading) loading.style.display = 'none';
                });
                
                video.addEventListener('error', function(e) {
                    console.error(`❌ Video ${index + 1}: Error occurred`);
                    handleVideoError(video);
                });
                
                video.addEventListener('play', function() {
                    console.log(`▶️ Video ${index + 1}: Playing`);
                });
                
                video.addEventListener('pause', function() {
                    console.log(`⏸️ Video ${index + 1}: Paused`);
                });
                
                // Test video accessibility
                setTimeout(() => {
                    if (video.readyState === 0) {
                        console.warn(`⚠️ Video ${index + 1}: Still not ready after 3 seconds`);
                    }
                }, 3000);
            });
        });
    </script>
</x-app-layout>
