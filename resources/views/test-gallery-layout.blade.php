<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Gallery Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .video-notification {
            animation: fadeInOut 2s ease-in-out;
        }
        
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-10px); }
            20% { opacity: 1; transform: translateY(0); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
        
        .gallery-card {
            transition: transform 0.3s ease;
        }
        
        .gallery-card:hover {
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">🎬 Test Gallery Layout - Consistent Card Heights</h1>
        
        <!-- Option 1: Fixed Aspect Ratio (Current) -->
        <div class="mb-12">
            <h2 class="text-xl font-semibold mb-4">Option 1: Fixed Aspect Ratio (16:9) - Current</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Video Card -->
                <div class="gallery-card bg-white rounded-2xl border-2 border-gray-100 overflow-hidden shadow-lg">
                    <div class="aspect-video w-full overflow-hidden bg-gray-100 relative">
                        <video class="w-full h-full object-cover" controls 
                               ondblclick="toggleVideoFit(this)"
                               title="Double-click untuk toggle fit">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                🎬 Video
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Video Test</h3>
                        <p class="text-sm text-gray-600 mb-4">Double-click video untuk toggle fit mode</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center mr-2">
                                    <span class="text-white text-xs font-bold">U</span>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-900">Umum</p>
                                    <p class="text-xs text-gray-500">Galeri</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">12 Dec 2025</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 1 -->
                <div class="gallery-card bg-white rounded-2xl border-2 border-gray-100 overflow-hidden shadow-lg">
                    <div class="aspect-video w-full overflow-hidden bg-gray-100 relative">
                        <img src="https://via.placeholder.com/400x300/3B82F6/FFFFFF?text=Image+1" 
                             alt="Test Image 1"
                             class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                📸 Foto
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Test Image 1</h3>
                        <p class="text-sm text-gray-600 mb-4">Ini adalah gambar test untuk membandingkan tinggi card</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center mr-2">
                                    <span class="text-white text-xs font-bold">A</span>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-900">Admin</p>
                                    <p class="text-xs text-gray-500">Galeri</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">12 Dec 2025</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 2 -->
                <div class="gallery-card bg-white rounded-2xl border-2 border-gray-100 overflow-hidden shadow-lg">
                    <div class="aspect-video w-full overflow-hidden bg-gray-100 relative">
                        <img src="https://via.placeholder.com/400x300/10B981/FFFFFF?text=Image+2" 
                             alt="Test Image 2"
                             class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                📸 Foto
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Test Image 2</h3>
                        <p class="text-sm text-gray-600 mb-4">Card ini memiliki tinggi yang sama dengan yang lain</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center mr-2">
                                    <span class="text-white text-xs font-bold">M</span>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-900">Member</p>
                                    <p class="text-xs text-gray-500">Angkatan 2024</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">11 Dec 2025</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">💡 Instructions</h3>
            <ul class="text-blue-700 space-y-2">
                <li>• <strong>Double-click video</strong> untuk toggle antara "cover" dan "contain"</li>
                <li>• <strong>Cover mode:</strong> Video mengisi penuh container (mungkin terpotong)</li>
                <li>• <strong>Contain mode:</strong> Video utuh terlihat (mungkin ada black bars)</li>
                <li>• <strong>Semua card</strong> memiliki tinggi yang sama (aspect-video)</li>
                <li>• <strong>Layout konsisten</strong> untuk grid yang rapi</li>
            </ul>
        </div>

        <!-- Controls -->
        <div class="mt-8 text-center">
            <button onclick="toggleAllVideos('cover')" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 mr-4">
                Set All Videos: Cover
            </button>
            <button onclick="toggleAllVideos('contain')" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600">
                Set All Videos: Contain
            </button>
        </div>
    </div>

    <script>
        // Toggle video object-fit between cover and contain
        function toggleVideoFit(videoElement) {
            const currentFit = videoElement.style.objectFit || 'cover';
            
            if (currentFit === 'cover' || videoElement.classList.contains('object-cover')) {
                videoElement.classList.remove('object-cover');
                videoElement.classList.add('object-contain');
                videoElement.style.objectFit = 'contain';
                console.log('🎬 Video fit changed to: contain');
                showVideoNotification(videoElement, '📐 Contain Mode');
            } else {
                videoElement.classList.remove('object-contain');
                videoElement.classList.add('object-cover');
                videoElement.style.objectFit = 'cover';
                console.log('🎬 Video fit changed to: cover');
                showVideoNotification(videoElement, '📐 Cover Mode');
            }
        }
        
        // Show temporary notification
        function showVideoNotification(videoElement, message) {
            const container = videoElement.closest('.relative');
            
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
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 2000);
        }
        
        // Toggle all videos to specific mode
        function toggleAllVideos(mode) {
            const videos = document.querySelectorAll('video');
            videos.forEach(video => {
                if (mode === 'cover') {
                    video.classList.remove('object-contain');
                    video.classList.add('object-cover');
                    video.style.objectFit = 'cover';
                    showVideoNotification(video, '📐 Cover Mode');
                } else {
                    video.classList.remove('object-cover');
                    video.classList.add('object-contain');
                    video.style.objectFit = 'contain';
                    showVideoNotification(video, '📐 Contain Mode');
                }
            });
        }
    </script>
</body>
</html>