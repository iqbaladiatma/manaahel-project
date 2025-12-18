<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Video Sizing</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .test-section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .video-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .video-card { border: 2px solid #ddd; border-radius: 8px; overflow: hidden; background: #f8f9fa; }
        .video-container { position: relative; background: #000; }
        
        /* Different sizing options */
        .aspect-video { aspect-ratio: 16/9; }
        .aspect-square { aspect-ratio: 1/1; }
        .aspect-4-3 { aspect-ratio: 4/3; }
        .aspect-auto { height: auto; }
        .fixed-height { height: 250px; }
        
        .video-fit-cover { object-fit: cover; }
        .video-fit-contain { object-fit: contain; }
        .video-fit-fill { object-fit: fill; }
        .video-fit-none { object-fit: none; }
        
        video { width: 100%; height: 100%; }
        .card-title { padding: 10px; font-weight: bold; background: #e9ecef; }
        .card-info { padding: 10px; font-size: 12px; color: #666; }
        
        button { padding: 5px 10px; margin: 2px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 11px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎬 Test Video Sizing Options</h1>
        
        <div class="test-section">
            <h3>📐 Berbagai Opsi Aspect Ratio & Object Fit</h3>
            <p>Pilih kombinasi yang paling cocok untuk video Anda:</p>
            
            <div class="video-grid">
                <!-- Option 1: 16:9 Cover -->
                <div class="video-card">
                    <div class="card-title">16:9 + Cover (Default)</div>
                    <div class="video-container aspect-video">
                        <video controls class="video-fit-cover">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Aspect: 16:9, Object-fit: cover<br>
                        Video dipotong untuk fit container
                    </div>
                </div>

                <!-- Option 2: 16:9 Contain -->
                <div class="video-card">
                    <div class="card-title">16:9 + Contain</div>
                    <div class="video-container aspect-video">
                        <video controls class="video-fit-contain">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Aspect: 16:9, Object-fit: contain<br>
                        Video utuh, mungkin ada black bars
                    </div>
                </div>

                <!-- Option 3: Auto Height -->
                <div class="video-card">
                    <div class="card-title">Auto Height</div>
                    <div class="video-container aspect-auto">
                        <video controls style="width: 100%; height: auto;">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Height: auto<br>
                        Mengikuti aspect ratio asli video
                    </div>
                </div>

                <!-- Option 4: 4:3 Contain -->
                <div class="video-card">
                    <div class="card-title">4:3 + Contain</div>
                    <div class="video-container aspect-4-3">
                        <video controls class="video-fit-contain">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Aspect: 4:3, Object-fit: contain<br>
                        Untuk video portrait/square
                    </div>
                </div>

                <!-- Option 5: Fixed Height Cover -->
                <div class="video-card">
                    <div class="card-title">Fixed Height + Cover</div>
                    <div class="video-container fixed-height">
                        <video controls class="video-fit-cover">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Height: 250px fixed, Object-fit: cover<br>
                        Tinggi tetap, lebar responsif
                    </div>
                </div>

                <!-- Option 6: Fixed Height Contain -->
                <div class="video-card">
                    <div class="card-title">Fixed Height + Contain</div>
                    <div class="video-container fixed-height">
                        <video controls class="video-fit-contain">
                            <source src="{{ route('video.stream', ['url' => 'https://res.cloudinary.com/doykx0ctf/video/upload/v1765265167/P1211052_ekk4vk.mp4']) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-info">
                        Height: 250px fixed, Object-fit: contain<br>
                        Video utuh dalam container tetap
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Info -->
        <div class="test-section">
            <h3>📊 Video Information</h3>
            <div id="videoInfo">
                <p>Klik "Get Video Info" untuk melihat dimensi asli video</p>
            </div>
            <button onclick="getVideoInfo()">Get Video Info</button>
            <button onclick="testAllOptions()">Test All Options</button>
        </div>

        <!-- Recommendations -->
        <div class="test-section">
            <h3>💡 Recommendations</h3>
            <div id="recommendations">
                <ul>
                    <li><strong>Auto Height:</strong> Terbaik untuk mempertahankan aspect ratio asli</li>
                    <li><strong>16:9 + Contain:</strong> Bagus untuk landscape video</li>
                    <li><strong>4:3 + Contain:</strong> Cocok untuk portrait/square video</li>
                    <li><strong>Fixed Height + Contain:</strong> Konsisten untuk grid layout</li>
                    <li><strong>Cover:</strong> Mengisi penuh tapi mungkin memotong video</li>
                    <li><strong>Contain:</strong> Video utuh tapi mungkin ada space kosong</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function getVideoInfo() {
            const video = document.querySelector('video');
            const infoDiv = document.getElementById('videoInfo');
            
            video.addEventListener('loadedmetadata', function() {
                const width = video.videoWidth;
                const height = video.videoHeight;
                const aspectRatio = (width / height).toFixed(2);
                const duration = video.duration.toFixed(2);
                
                let aspectType = 'Unknown';
                if (aspectRatio > 1.7) aspectType = 'Landscape (16:9-ish)';
                else if (aspectRatio > 1.2) aspectType = 'Landscape (4:3-ish)';
                else if (aspectRatio > 0.8) aspectType = 'Square-ish';
                else aspectType = 'Portrait';
                
                infoDiv.innerHTML = `
                    <div style="background: #e7f3ff; padding: 15px; border-radius: 5px;">
                        <strong>Video Dimensions:</strong><br>
                        Width: ${width}px<br>
                        Height: ${height}px<br>
                        Aspect Ratio: ${aspectRatio} (${aspectType})<br>
                        Duration: ${duration} seconds<br><br>
                        
                        <strong>Recommended CSS:</strong><br>
                        ${getRecommendation(aspectRatio)}
                    </div>
                `;
            });
            
            video.load();
        }
        
        function getRecommendation(aspectRatio) {
            if (aspectRatio > 1.6) {
                return `
                    <code>aspect-ratio: 16/9; object-fit: contain;</code><br>
                    Atau <code>height: auto;</code> untuk aspect ratio asli
                `;
            } else if (aspectRatio > 1.2) {
                return `
                    <code>aspect-ratio: 4/3; object-fit: contain;</code><br>
                    Atau <code>height: auto;</code> untuk aspect ratio asli
                `;
            } else {
                return `
                    <code>height: auto;</code> (recommended)<br>
                    Atau <code>aspect-ratio: 1/1; object-fit: contain;</code>
                `;
            }
        }
        
        function testAllOptions() {
            const videos = document.querySelectorAll('video');
            videos.forEach((video, index) => {
                video.addEventListener('canplay', function() {
                    console.log(`Video ${index + 1}: Can play - ${video.videoWidth}x${video.videoHeight}`);
                });
                
                video.load();
            });
        }
        
        // Auto-load first video info
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(getVideoInfo, 2000);
        });
    </script>
</body>
</html>