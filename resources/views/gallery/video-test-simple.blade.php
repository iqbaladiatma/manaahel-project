<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Video Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .test-section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .video-container { width: 100%; max-width: 600px; margin: 0 auto; }
        video { width: 100%; height: auto; border-radius: 8px; background: #000; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .status { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .info { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎬 Simple Video Test</h1>
        
        <div class="test-section">
            <h3>Test 1: Direct Video Player</h3>
            <p>Video langsung dengan controls, tanpa JavaScript:</p>
            <div class="video-container">
                <video controls preload="metadata" poster="https://res.cloudinary.com/demo/video/upload/w_600,h_400,c_fill,so_0,f_jpg/sample.mp4">
                    <source src="https://res.cloudinary.com/demo/video/upload/sample.mp4" type="video/mp4">
                    <p>Browser tidak mendukung video. <a href="https://res.cloudinary.com/demo/video/upload/sample.mp4" target="_blank">Download</a></p>
                </video>
            </div>
            <div id="status1" class="status info">Klik play button pada video di atas</div>
        </div>

        <div class="test-section">
            <h3>Test 2: Custom Video URL</h3>
            <input type="url" id="customUrl" placeholder="Masukkan URL video Cloudinary" style="width: 70%; padding: 8px; margin-bottom: 10px;">
            <button class="btn" onclick="loadCustomVideo()">Load Video</button>
            <div id="customVideoContainer"></div>
        </div>

        <div class="test-section">
            <h3>Test 3: Video dengan JavaScript Control</h3>
            <div class="video-container">
                <video id="jsVideo" controls preload="metadata" style="display: none;">
                    <source src="https://res.cloudinary.com/demo/video/upload/sample.mp4" type="video/mp4">
                </video>
                <div id="videoPlaceholder" style="width: 100%; height: 300px; background: #333; display: flex; align-items: center; justify-content: center; border-radius: 8px; cursor: pointer;" onclick="showVideo()">
                    <div style="text-center; color: white;">
                        <div style="font-size: 60px; margin-bottom: 10px;">▶️</div>
                        <p>Klik untuk load video</p>
                    </div>
                </div>
            </div>
            <div id="status3" class="status info">Klik placeholder di atas untuk load video</div>
        </div>

        <div class="test-section">
            <h3>📊 Test Results</h3>
            <div id="results">
                <p>Hasil test akan muncul di sini...</p>
            </div>
        </div>

        <div class="test-section">
            <h3>🔧 Troubleshooting</h3>
            <ul>
                <li><strong>Video tidak muncul:</strong> Cek URL valid dan accessible</li>
                <li><strong>Video muncul tapi tidak play:</strong> Cek format (MP4 recommended)</li>
                <li><strong>Error loading:</strong> Cek network connection</li>
                <li><strong>Controls tidak muncul:</strong> Cek browser compatibility</li>
            </ul>
            
            <h4>URL Format Cloudinary:</h4>
            <ul>
                <li><strong>Video:</strong> https://res.cloudinary.com/demo/video/upload/sample.mp4</li>
                <li><strong>Poster:</strong> https://res.cloudinary.com/demo/video/upload/w_600,h_400,c_fill,so_0,f_jpg/sample.mp4</li>
            </ul>
        </div>
    </div>

    <script>
        // Add event listeners to track video events
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('video');
            
            videos.forEach((video, index) => {
                video.addEventListener('loadstart', () => addResult(`Video ${index + 1}: Loading started`));
                video.addEventListener('canplay', () => addResult(`Video ${index + 1}: Can play`));
                video.addEventListener('play', () => addResult(`Video ${index + 1}: Playing`));
                video.addEventListener('pause', () => addResult(`Video ${index + 1}: Paused`));
                video.addEventListener('error', (e) => addResult(`Video ${index + 1}: Error - ${e.message}`, 'error'));
            });
        });

        function loadCustomVideo() {
            const url = document.getElementById('customUrl').value;
            const container = document.getElementById('customVideoContainer');
            
            if (!url) {
                addResult('Please enter a video URL', 'error');
                return;
            }
            
            // Generate poster URL if Cloudinary
            let posterUrl = '';
            if (url.includes('cloudinary.com') && url.includes('/video/upload/')) {
                posterUrl = url.replace('/video/upload/', '/video/upload/w_600,h_400,c_fill,so_0,f_jpg/');
            }
            
            container.innerHTML = `
                <div class="video-container" style="margin-top: 10px;">
                    <video controls preload="metadata" ${posterUrl ? `poster="${posterUrl}"` : ''}>
                        <source src="${url}" type="video/mp4">
                        <p>Cannot load video. <a href="${url}" target="_blank">Download</a></p>
                    </video>
                </div>
            `;
            
            addResult(`Custom video loaded: ${url}`);
        }

        function showVideo() {
            const placeholder = document.getElementById('videoPlaceholder');
            const video = document.getElementById('jsVideo');
            const status = document.getElementById('status3');
            
            placeholder.style.display = 'none';
            video.style.display = 'block';
            status.textContent = 'Video loaded! Use controls to play.';
            status.className = 'status success';
            
            addResult('JavaScript video loaded successfully');
        }

        function addResult(message, type = 'info') {
            const results = document.getElementById('results');
            const timestamp = new Date().toLocaleTimeString();
            const className = type === 'error' ? 'error' : type === 'success' ? 'success' : 'info';
            
            results.innerHTML += `<div class="status ${className}">[${timestamp}] ${message}</div>`;
        }
    </script>
</body>
</html>