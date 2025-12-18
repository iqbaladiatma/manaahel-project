<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Video Player</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .video-test { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .video-container { position: relative; width: 100%; height: 300px; background: #000; border-radius: 8px; overflow: hidden; }
        .video-thumbnail { position: relative; width: 100%; height: 100%; cursor: pointer; }
        .video-player { width: 100%; height: 100%; object-fit: cover; }
        .play-button { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; }
        .play-button:hover { background: white; transform: translate(-50%, -50%) scale(1.1); }
        .play-icon { width: 24px; height: 24px; margin-left: 3px; }
        .thumbnail-img { width: 100%; height: 100%; object-fit: cover; }
        .fallback-thumbnail { width: 100%; height: 100%; background: #333; display: flex; align-items: center; justify-content: center; color: #999; }
        .hidden { display: none !important; }
        .info { background: #e7f3ff; padding: 15px; border-left: 4px solid #007bff; margin-bottom: 20px; }
        .error { background: #f8d7da; padding: 15px; border-left: 4px solid #dc3545; margin-bottom: 20px; color: #721c24; }
        .success { background: #d4edda; padding: 15px; border-left: 4px solid #28a745; margin-bottom: 20px; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎥 Test Video Player</h1>
        
        <div class="info">
            <strong>Test berbagai jenis video:</strong><br>
            1. Video Cloudinary dengan thumbnail otomatis<br>
            2. Video Cloudinary tanpa thumbnail<br>
            3. Video lokal<br>
            4. Video dengan error handling
        </div>

        <!-- Test 1: Cloudinary Video dengan Thumbnail -->
        <div class="video-test">
            <h3>Test 1: Cloudinary Video (dengan thumbnail)</h3>
            <div class="video-container" data-video-url="https://res.cloudinary.com/demo/video/upload/sample.mp4">
                <div class="video-thumbnail" onclick="playVideo(this)">
                    <img src="https://res.cloudinary.com/demo/video/upload/w_400,h_300,c_fill,so_0,f_jpg/sample.mp4" 
                         alt="Video Thumbnail" 
                         class="thumbnail-img"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="fallback-thumbnail" style="display: none;">
                        <div style="text-center">
                            <div style="font-size: 48px;">🎬</div>
                            <p>Video Thumbnail</p>
                        </div>
                    </div>
                    <div class="play-button">
                        <svg class="play-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                </div>
                <video class="video-player hidden" controls preload="metadata">
                    <source src="https://res.cloudinary.com/demo/video/upload/sample.mp4" type="video/mp4">
                    <p>Browser tidak mendukung video. <a href="https://res.cloudinary.com/demo/video/upload/sample.mp4" target="_blank">Download</a></p>
                </video>
            </div>
        </div>

        <!-- Test 2: Video dengan URL Custom -->
        <div class="video-test">
            <h3>Test 2: Custom Video URL</h3>
            <div style="margin-bottom: 10px;">
                <input type="url" id="custom-video-url" placeholder="Masukkan URL video Cloudinary Anda" style="width: 70%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <button onclick="loadCustomVideo()" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Test Video</button>
            </div>
            <div id="custom-video-container"></div>
        </div>

        <!-- Test 3: Direct Video Player -->
        <div class="video-test">
            <h3>Test 3: Direct Video Player (tanpa thumbnail)</h3>
            <video controls style="width: 100%; max-height: 300px; background: #000; border-radius: 8px;">
                <source src="https://res.cloudinary.com/demo/video/upload/sample.mp4" type="video/mp4">
                <p>Browser tidak mendukung video.</p>
            </video>
        </div>

        <!-- Test Results -->
        <div class="video-test">
            <h3>📊 Test Results</h3>
            <div id="test-results">
                <p>Klik tombol play pada video di atas untuk test...</p>
            </div>
        </div>

        <!-- Troubleshooting -->
        <div class="video-test">
            <h3>🔧 Troubleshooting</h3>
            <ul>
                <li><strong>Video tidak muncul:</strong> Cek URL video valid</li>
                <li><strong>Thumbnail tidak muncul:</strong> Cek URL thumbnail Cloudinary</li>
                <li><strong>Video tidak bisa play:</strong> Cek format video (MP4 recommended)</li>
                <li><strong>Error CORS:</strong> Pastikan video dari domain yang sama atau CORS enabled</li>
            </ul>
            
            <h4>Format URL Cloudinary Video:</h4>
            <ul>
                <li><strong>Video:</strong> https://res.cloudinary.com/demo/video/upload/sample.mp4</li>
                <li><strong>Thumbnail:</strong> https://res.cloudinary.com/demo/video/upload/w_400,h_300,c_fill,so_0,f_jpg/sample.mp4</li>
            </ul>
        </div>
    </div>

    <script>
        let testResults = [];

        // Video player functionality
        function playVideo(thumbnailElement) {
            const videoContainer = thumbnailElement.closest('.video-container');
            const thumbnail = videoContainer.querySelector('.video-thumbnail');
            const video = videoContainer.querySelector('.video-player');
            
            addTestResult('🎬 Attempting to play video...', 'info');
            
            if (video && thumbnail) {
                // Hide thumbnail
                thumbnail.style.display = 'none';
                
                // Show and play video
                video.classList.remove('hidden');
                video.style.display = 'block';
                
                // Try to play video
                const playPromise = video.play();
                
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        addTestResult('✅ Video started playing successfully!', 'success');
                    }).catch(error => {
                        addTestResult('❌ Error playing video: ' + error.message, 'error');
                        showVideoError(videoContainer, 'Tidak dapat memutar video. Klik untuk download.');
                    });
                }
                
                // Add event listeners
                video.addEventListener('ended', function() {
                    addTestResult('🏁 Video playback ended', 'info');
                    video.classList.add('hidden');
                    thumbnail.style.display = 'block';
                });
                
                video.addEventListener('error', function(e) {
                    addTestResult('❌ Video error: ' + e.message, 'error');
                    showVideoError(videoContainer, 'Error loading video.');
                });
                
                video.addEventListener('loadstart', function() {
                    addTestResult('📥 Video loading started...', 'info');
                });
                
                video.addEventListener('canplay', function() {
                    addTestResult('✅ Video can start playing', 'success');
                });
            } else {
                addTestResult('❌ Video or thumbnail element not found', 'error');
            }
        }
        
        // Show video error
        function showVideoError(container, message) {
            const videoUrl = container.dataset.videoUrl;
            container.innerHTML = `
                <div style="width: 100%; height: 100%; background: #f8d7da; display: flex; align-items: center; justify-content: center; border: 2px solid #f5c6cb; border-radius: 8px;">
                    <div style="text-center; padding: 20px;">
                        <div style="font-size: 48px; margin-bottom: 10px;">⚠️</div>
                        <p style="color: #721c24; margin-bottom: 10px;">${message}</p>
                        <a href="${videoUrl}" target="_blank" style="display: inline-block; padding: 8px 16px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px;">Download Video</a>
                    </div>
                </div>
            `;
        }
        
        // Load custom video
        function loadCustomVideo() {
            const url = document.getElementById('custom-video-url').value;
            const container = document.getElementById('custom-video-container');
            
            if (!url) {
                addTestResult('❌ Please enter a video URL', 'error');
                return;
            }
            
            // Generate thumbnail URL for Cloudinary
            let thumbnailUrl = '';
            if (url.includes('cloudinary.com') && url.includes('/video/upload/')) {
                thumbnailUrl = url.replace('/video/upload/', '/video/upload/w_400,h_300,c_fill,so_0,f_jpg/');
            }
            
            container.innerHTML = `
                <div class="video-container" data-video-url="${url}">
                    <div class="video-thumbnail" onclick="playVideo(this)">
                        ${thumbnailUrl ? `<img src="${thumbnailUrl}" alt="Video Thumbnail" class="thumbnail-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">` : ''}
                        <div class="fallback-thumbnail" ${thumbnailUrl ? 'style="display: none;"' : ''}>
                            <div style="text-center">
                                <div style="font-size: 48px;">🎬</div>
                                <p>Custom Video</p>
                            </div>
                        </div>
                        <div class="play-button">
                            <svg class="play-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                        </div>
                    </div>
                    <video class="video-player hidden" controls preload="metadata">
                        <source src="${url}" type="video/mp4">
                        <p>Browser tidak mendukung video. <a href="${url}" target="_blank">Download</a></p>
                    </video>
                </div>
            `;
            
            addTestResult('🔄 Custom video loaded: ' + url, 'info');
        }
        
        // Add test result
        function addTestResult(message, type) {
            const timestamp = new Date().toLocaleTimeString();
            const resultDiv = document.getElementById('test-results');
            const className = type === 'error' ? 'error' : type === 'success' ? 'success' : 'info';
            
            resultDiv.innerHTML += `<div class="${className}" style="margin-bottom: 10px; padding: 10px; border-radius: 4px;">[${timestamp}] ${message}</div>`;
            resultDiv.scrollTop = resultDiv.scrollHeight;
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            addTestResult('🚀 Video test page loaded', 'success');
        });
    </script>
</body>
</html>