<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Video Fix</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .video-test { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .video-container { position: relative; width: 100%; max-width: 600px; height: 300px; margin: 10px 0; }
        .video-element { width: 100%; height: 100%; object-fit: cover; background: #000; }
        .status { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .info { background: #d1ecf1; color: #0c5460; }
        .warning { background: #fff3cd; color: #856404; }
        button { padding: 8px 16px; margin: 5px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; }
        button:hover { background: #0056b3; }
        .btn-success { background: #28a745; }
        .btn-danger { background: #dc3545; }
        .btn-warning { background: #ffc107; color: #212529; }
        .video-loading { position: absolute; inset: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; color: white; }
        .video-error { position: absolute; inset: 0; background: rgba(139,0,0,0.9); display: none; align-items: center; justify-content: center; color: white; }
        .spinner { border: 2px solid #f3f3f3; border-top: 2px solid #3498db; border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Debug Video Fix - Gallery Videos</h1>
        
        <div class="status info">
            <strong>📋 Ditemukan {{ count($videos) }} video di database</strong><br>
            Halaman ini akan test setiap video dan memberikan solusi spesifik.
        </div>

        @foreach($videos as $index => $video)
        <div class="video-test">
            <h3>🎬 Video {{ $index + 1 }}: {{ $video->title }}</h3>
            
            <div class="grid">
                <div>
                    <div class="video-container" data-video-url="{{ $video->file_path }}">
                        <video class="video-element" 
                               controls 
                               preload="metadata"
                               crossorigin="anonymous"
                               onloadstart="logEvent('{{ $video->id }}', 'loadstart')"
                               oncanplay="logEvent('{{ $video->id }}', 'canplay')"
                               onerror="logEvent('{{ $video->id }}', 'error', this.error)"
                               onloadeddata="logEvent('{{ $video->id }}', 'loadeddata')">
                            <source src="{{ $video->file_path }}" type="video/mp4">
                            Video tidak dapat dimuat.
                        </video>
                        
                        <div class="video-loading">
                            <div class="text-center">
                                <div class="spinner"></div>
                                <p style="margin-top: 10px;">Loading...</p>
                            </div>
                        </div>
                        
                        <div class="video-error">
                            <div class="text-center">
                                <div style="font-size: 40px; margin-bottom: 10px;">❌</div>
                                <p>Video Error</p>
                                <button onclick="retryVideo(this)" class="btn-warning">🔄 Retry</button>
                                <a href="{{ $video->file_path }}" target="_blank" class="btn-success">📥 Download</a>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <button onclick="testVideo('{{ $video->id }}')" class="btn-success">▶️ Test Play</button>
                        <button onclick="checkVideoInfo('{{ $video->id }}')" class="btn-warning">ℹ️ Info</button>
                        <button onclick="openVideoUrl('{{ $video->file_path }}')" class="btn-success">🔗 Open URL</button>
                        <button onclick="fixVideo('{{ $video->id }}')" class="btn-danger">🔧 Fix</button>
                    </div>
                </div>
                
                <div>
                    <div class="status info">
                        <strong>Video Info:</strong><br>
                        <strong>ID:</strong> {{ $video->id }}<br>
                        <strong>Title:</strong> {{ $video->title }}<br>
                        <strong>Type:</strong> {{ $video->file_type }}<br>
                        <strong>Visibility:</strong> {{ $video->visibility }}<br>
                        <strong>URL:</strong> <a href="{{ $video->file_path }}" target="_blank" style="word-break: break-all;">{{ $video->file_path }}</a>
                    </div>
                    
                    <div id="log-{{ $video->id }}" class="status warning" style="max-height: 150px; overflow-y: auto; font-size: 12px;">
                        <strong>Event Log:</strong><br>
                        Waiting for events...
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Global Test Results -->
        <div class="video-test">
            <h3>📊 Global Test Results</h3>
            <div id="globalResults" class="status info">
                Test results akan muncul di sini...
            </div>
            <button onclick="testAllVideos()" class="btn-success">🎬 Test All Videos</button>
            <button onclick="clearAllLogs()" class="btn-warning">🗑️ Clear Logs</button>
        </div>

        <!-- Solutions -->
        <div class="video-test">
            <h3>💡 Common Solutions</h3>
            <div class="status info">
                <strong>Jika video tidak bisa play:</strong><br>
                1. <strong>Cek URL langsung</strong> - Klik "Open URL" untuk test di tab baru<br>
                2. <strong>Format tidak didukung</strong> - Pastikan format MP4<br>
                3. <strong>CORS policy</strong> - Video dari domain lain mungkin diblokir<br>
                4. <strong>File corrupt</strong> - Re-upload video ke Cloudinary<br>
                5. <strong>Browser policy</strong> - Beberapa browser blokir autoplay<br><br>
                
                <strong>Solusi umum:</strong><br>
                • Gunakan format MP4 dengan codec H.264<br>
                • Pastikan video accessible via HTTPS<br>
                • Test di browser berbeda (Chrome, Firefox, Safari)<br>
                • Cek ukuran file tidak terlalu besar (max 50MB)
            </div>
        </div>
    </div>

    <script>
        const videoLogs = {};
        
        function logEvent(videoId, eventType, error = null) {
            const timestamp = new Date().toLocaleTimeString();
            const logDiv = document.getElementById(`log-${videoId}`);
            
            if (!videoLogs[videoId]) {
                videoLogs[videoId] = [];
            }
            
            let message = `[${timestamp}] ${eventType}`;
            if (error) {
                const errorMessages = {
                    1: 'MEDIA_ERR_ABORTED',
                    2: 'MEDIA_ERR_NETWORK', 
                    3: 'MEDIA_ERR_DECODE',
                    4: 'MEDIA_ERR_SRC_NOT_SUPPORTED'
                };
                message += ` - ${errorMessages[error.code] || 'Unknown error'}`;
            }
            
            videoLogs[videoId].push(message);
            
            if (logDiv) {
                logDiv.innerHTML = '<strong>Event Log:</strong><br>' + videoLogs[videoId].join('<br>');
                logDiv.scrollTop = logDiv.scrollHeight;
            }
            
            console.log(`Video ${videoId}: ${message}`);
        }
        
        function testVideo(videoId) {
            const container = document.querySelector(`[data-video-url]`);
            const video = container.querySelector('.video-element');
            
            logEvent(videoId, 'Manual test started');
            
            video.play().then(() => {
                logEvent(videoId, 'Play successful ✅');
            }).catch(error => {
                logEvent(videoId, `Play failed: ${error.message} ❌`);
            });
        }
        
        function checkVideoInfo(videoId) {
            const videos = document.querySelectorAll('.video-element');
            const video = videos[videoId - 1]; // Assuming videoId matches index
            
            if (!video) return;
            
            const info = {
                readyState: video.readyState,
                networkState: video.networkState,
                duration: video.duration || 'Unknown',
                currentSrc: video.currentSrc || 'None',
                videoWidth: video.videoWidth || 'Unknown',
                videoHeight: video.videoHeight || 'Unknown',
                error: video.error ? video.error.code : 'None'
            };
            
            const infoText = Object.entries(info).map(([key, value]) => `${key}: ${value}`).join('\n');
            alert(`Video ${videoId} Technical Info:\n\n${infoText}`);
            
            logEvent(videoId, `Info checked - Ready: ${info.readyState}, Error: ${info.error}`);
        }
        
        function openVideoUrl(url) {
            window.open(url, '_blank');
        }
        
        function fixVideo(videoId) {
            logEvent(videoId, 'Fix attempt started');
            
            const videos = document.querySelectorAll('.video-element');
            const video = videos[videoId - 1];
            
            if (!video) return;
            
            // Try multiple fix strategies
            video.load(); // Reload video
            video.currentTime = 0; // Reset position
            
            // Try different source if available
            setTimeout(() => {
                video.play().then(() => {
                    logEvent(videoId, 'Fix successful ✅');
                }).catch(error => {
                    logEvent(videoId, `Fix failed: ${error.message} ❌`);
                });
            }, 1000);
        }
        
        function retryVideo(buttonElement) {
            const container = buttonElement.closest('.video-container');
            const video = container.querySelector('.video-element');
            const errorOverlay = container.querySelector('.video-error');
            const loadingOverlay = container.querySelector('.video-loading');
            
            // Hide error, show loading
            errorOverlay.style.display = 'none';
            loadingOverlay.style.display = 'flex';
            
            // Reload video
            video.load();
            
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 5000);
        }
        
        function testAllVideos() {
            const videos = document.querySelectorAll('.video-element');
            const results = document.getElementById('globalResults');
            
            results.innerHTML = 'Testing all videos...<br>';
            
            videos.forEach((video, index) => {
                const videoId = index + 1;
                
                setTimeout(() => {
                    video.play().then(() => {
                        results.innerHTML += `✅ Video ${videoId}: OK<br>`;
                        video.pause(); // Pause after successful test
                    }).catch(error => {
                        results.innerHTML += `❌ Video ${videoId}: ${error.message}<br>`;
                    });
                }, index * 1000); // Stagger tests
            });
        }
        
        function clearAllLogs() {
            Object.keys(videoLogs).forEach(videoId => {
                videoLogs[videoId] = [];
                const logDiv = document.getElementById(`log-${videoId}`);
                if (logDiv) {
                    logDiv.innerHTML = '<strong>Event Log:</strong><br>Logs cleared...';
                }
            });
            
            document.getElementById('globalResults').innerHTML = 'Logs cleared...';
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Debug Video Fix page loaded');
            
            // Auto-test after 2 seconds
            setTimeout(() => {
                console.log('🔍 Starting auto-analysis...');
                const videos = document.querySelectorAll('.video-element');
                videos.forEach((video, index) => {
                    const videoId = index + 1;
                    logEvent(videoId, 'Page loaded, video initialized');
                    
                    // Check initial state
                    setTimeout(() => {
                        if (video.readyState === 0) {
                            logEvent(videoId, 'Warning: Video not loading after 3 seconds ⚠️');
                        } else {
                            logEvent(videoId, `Video ready state: ${video.readyState} ✅`);
                        }
                    }, 3000);
                });
            }, 2000);
        });
    </script>
</body>
</html>