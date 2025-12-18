<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Video Proxy</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .test { margin: 20px 0; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        video { width: 100%; max-width: 600px; background: #000; margin: 10px 0; }
        .status { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .info { background: #d1ecf1; color: #0c5460; }
        button { padding: 10px 20px; margin: 5px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🔧 Test Video Proxy - CORS Fix</h1>
    
    <div class="test">
        <h3>Test 1: Direct Cloudinary URL (Masalah CORS)</h3>
        <video controls>
            <source src="https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4" type="video/mp4">
        </video>
        <div class="status info">Video langsung dari Cloudinary - kemungkinan CORS error</div>
    </div>

    <div class="test">
        <h3>Test 2: Via Proxy (Solusi CORS)</h3>
        <video controls>
            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
        </video>
        <div class="status success">Video via proxy Laravel - seharusnya bisa play</div>
    </div>

    <div class="test">
        <h3>Test 3: Video Kedua via Proxy</h3>
        <video controls>
            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765264937/VID-20251203-WA0053_h8yxkh.mp4']) }}" type="video/mp4">
        </video>
        <div class="status success">Video BUUS via proxy</div>
    </div>

    <div class="test">
        <h3>📊 Test Results</h3>
        <div id="results">
            <p>Test results akan muncul di sini...</p>
        </div>
        <button onclick="testAllVideos()">Test All Videos</button>
    </div>

    <div class="test">
        <h3>💡 Penjelasan Masalah</h3>
        <div class="status info">
            <strong>Masalah CORS:</strong><br>
            Browser modern memblokir video dari domain lain (Cross-Origin) karena security policy.<br><br>
            
            <strong>Solusi Proxy:</strong><br>
            Laravel server mengambil video dari Cloudinary dan menyajikannya dengan header CORS yang benar.<br><br>
            
            <strong>Cara Kerja:</strong><br>
            1. Browser request video ke Laravel<br>
            2. Laravel fetch video dari Cloudinary<br>
            3. Laravel return video dengan CORS headers<br>
            4. Browser bisa play video tanpa CORS error
        </div>
    </div>

    <script>
        function testAllVideos() {
            const videos = document.querySelectorAll('video');
            const results = document.getElementById('results');
            
            results.innerHTML = 'Testing videos...<br>';
            
            videos.forEach((video, index) => {
                video.addEventListener('canplay', function() {
                    results.innerHTML += `✅ Video ${index + 1}: Can play<br>`;
                });
                
                video.addEventListener('error', function(e) {
                    results.innerHTML += `❌ Video ${index + 1}: Error - ${e.message}<br>`;
                });
                
                video.addEventListener('loadstart', function() {
                    results.innerHTML += `📡 Video ${index + 1}: Loading started<br>`;
                });
                
                // Try to play
                video.play().then(() => {
                    results.innerHTML += `▶️ Video ${index + 1}: Playing<br>`;
                    video.pause(); // Pause after test
                }).catch(error => {
                    results.innerHTML += `❌ Video ${index + 1}: Play failed - ${error.message}<br>`;
                });
            });
        }
        
        // Auto-test after page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(testAllVideos, 2000);
        });
    </script>
</body>
</html>