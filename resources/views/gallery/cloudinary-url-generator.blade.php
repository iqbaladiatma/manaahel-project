<x-app-layout>
    <div class="py-12 mt-20 bg-gray-50 dark:bg-dark-bg min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl dark:shadow-dark-border p-8 mb-8 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Cloudinary URL Generator</h1>
                        <p class="text-indigo-100 mt-1">Generate URL list dari folder Cloudinary Anda</p>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-2">
                    📋 Cara Menggunakan Tool Ini
                </h3>
                <ol class="text-blue-700 dark:text-blue-300 space-y-2 list-decimal list-inside">
                    <li><strong>Buka Cloudinary Console</strong> dan masuk ke Media Library</li>
                    <li><strong>Buka folder</strong> yang berisi foto/video Anda</li>
                    <li><strong>Copy informasi</strong> dari browser (cloud name, folder name)</li>
                    <li><strong>Isi form di bawah</strong> untuk generate URL list</li>
                    <li><strong>Copy hasil</strong> ke halaman Bulk Import</li>
                </ol>
            </div>

            <!-- URL Generator Form -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden mb-8">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        🛠️ Generate URL List
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Cloud Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="cloudName" 
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all"
                                   placeholder="doykx0ctf">
                            <p class="text-sm text-gray-500 mt-1">Dari URL Cloudinary Anda</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Folder Name
                            </label>
                            <input type="text" id="folderName" 
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all"
                                   placeholder="gallery (kosongkan jika di root)">
                            <p class="text-sm text-gray-500 mt-1">Nama folder di Cloudinary</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Daftar File Names <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Drag & Drop Area -->
                        <div id="dropArea" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center mb-4 transition-all hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20">
                            <div class="mb-4">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Drop file list here atau klik untuk upload
                            </p>
                            <p class="text-sm text-gray-500">
                                Support: .txt, .csv, atau paste langsung
                            </p>
                            <input type="file" id="fileInput" accept=".txt,.csv" class="hidden">
                            <button type="button" onclick="document.getElementById('fileInput').click()" 
                                    class="mt-4 px-6 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-all">
                                📁 Browse File
                            </button>
                        </div>
                        
                        <textarea id="fileNames" rows="10" 
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all font-mono text-sm"
                                  placeholder="Masukkan nama file satu per baris:

P1211052_ekk4vk.mp4
VID-20251203-WA0053_h8yxkh.mp4
photo1.jpg
photo2.jpg
IMG_001.png

ATAU:
1. Drag & drop file .txt di atas
2. Gunakan Browser Script (lihat instruksi di bawah)
3. Copy-paste dari file manager"></textarea>
                        <p class="text-sm text-gray-500 mt-1">
                            Satu nama file per baris. Include extension (.jpg, .mp4, dll)
                        </p>
                    </div>

                    <div class="flex gap-4 mb-6">
                        <button onclick="generateUrls()" 
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all transform hover:scale-105">
                            🚀 Generate URLs
                        </button>
                        <button onclick="clearAll()" 
                                class="px-8 py-3 bg-gray-500 text-white font-semibold rounded-xl hover:bg-gray-600 transition-all">
                            🗑️ Clear All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Generated URLs -->
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border border border-gray-200 dark:border-dark-border overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        📋 Generated URL List
                    </h2>

                    <div class="mb-4">
                        <div class="flex gap-4 mb-4">
                            <button onclick="copyToClipboard()" 
                                    class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-all">
                                📋 Copy All
                            </button>
                            <button onclick="goToBulkImport()" 
                                    class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all">
                                🚀 Go to Bulk Import
                            </button>
                        </div>
                    </div>

                    <textarea id="generatedUrls" rows="15" 
                              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border font-mono text-sm bg-gray-50 dark:bg-gray-800"
                              placeholder="Generated URLs akan muncul di sini...

Format yang dihasilkan:
URL|Judul|Deskripsi|Tipe

Siap untuk di-copy ke halaman Bulk Import!"
                              readonly></textarea>

                    <div id="urlStats" class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        Ready to generate URLs...
                    </div>
                </div>
            </div>

            <!-- Auto Extract Script -->
            <div class="mt-8 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800 dark:text-green-200 mb-2">
                    🤖 Auto Extract Script (RECOMMENDED untuk 1GB+ files)
                </h3>
                <p class="text-green-700 dark:text-green-300 mb-4">
                    Malas input manual? Gunakan script otomatis ini:
                </p>
                <ol class="text-green-700 dark:text-green-300 space-y-2 list-decimal list-inside text-sm">
                    <li><strong>Buka Cloudinary Media Library</strong> di browser</li>
                    <li><strong>Navigate ke folder</strong> yang ingin di-extract</li>
                    <li><strong>Tekan F12</strong> → buka Console tab</li>
                    <li><strong>Copy-paste script</strong> dari file <code>cloudinary-extractor.js</code></li>
                    <li><strong>Tekan Enter</strong> → script akan auto-scroll dan extract semua file names</li>
                    <li><strong>Download otomatis</strong> file .txt dengan daftar nama file</li>
                    <li><strong>Upload file .txt</strong> ke drag & drop area di atas</li>
                </ol>
                
                <div class="mt-4 p-4 bg-green-100 dark:bg-green-800 rounded-lg">
                    <p class="text-green-800 dark:text-green-200 font-semibold mb-2">📁 Script File:</p>
                    <p class="text-green-700 dark:text-green-300 text-sm">
                        File <code>cloudinary-extractor.js</code> sudah dibuat di project root.<br>
                        Buka file tersebut, copy semua isinya, paste di browser console.
                    </p>
                    <button onclick="showScript()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-all text-sm">
                        📋 Show Script
                    </button>
                </div>
            </div>

            <!-- Manual Tips -->
            <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">
                    💡 Alternative Methods
                </h3>
                <ul class="text-yellow-700 dark:text-yellow-300 space-y-2">
                    <li>• <strong>File Manager:</strong> Buka folder lokal → Select all → Copy names</li>
                    <li>• <strong>Command Line:</strong> <code>ls > filelist.txt</code> (Linux/Mac) atau <code>dir > filelist.txt</code> (Windows)</li>
                    <li>• <strong>Cloudinary API:</strong> Gunakan API untuk list semua files (advanced)</li>
                    <li>• <strong>Browser Network Tab:</strong> F12 → Network → Lihat request file names</li>
                </ul>
            </div>

            <!-- Script Modal -->
            <div id="scriptModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl max-h-[80vh] overflow-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">🤖 Cloudinary Auto-Extract Script</h3>
                            <button onclick="hideScript()" class="text-gray-500 hover:text-gray-700">✕</button>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg font-mono text-sm overflow-auto max-h-96">
                            <pre id="scriptContent">Loading script...</pre>
                        </div>
                        <div class="mt-4 flex gap-4">
                            <button onclick="copyScript()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                📋 Copy Script
                            </button>
                            <button onclick="hideScript()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateUrls() {
            const cloudName = document.getElementById('cloudName').value.trim();
            const folderName = document.getElementById('folderName').value.trim();
            const fileNames = document.getElementById('fileNames').value.trim();
            
            if (!cloudName) {
                alert('Cloud Name wajib diisi!');
                return;
            }
            
            if (!fileNames) {
                alert('File Names wajib diisi!');
                return;
            }
            
            const files = fileNames.split('\n').filter(line => line.trim());
            const generatedUrls = [];
            
            files.forEach(fileName => {
                fileName = fileName.trim();
                if (!fileName) return;
                
                // Determine if it's image or video
                const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
                const extension = fileName.split('.').pop().toLowerCase();
                const isVideo = videoExtensions.includes(extension);
                const resourceType = isVideo ? 'video' : 'image';
                const mediaType = isVideo ? 'video' : 'image';
                
                // Build URL
                let url = `https://res.cloudinary.com/${cloudName}/${resourceType}/upload/`;
                
                if (folderName) {
                    url += `${folderName}/`;
                }
                
                url += fileName;
                
                // Generate title from filename
                const title = fileName
                    .replace(/\.[^/.]+$/, '') // Remove extension
                    .replace(/[_-]/g, ' ') // Replace _ and - with spaces
                    .replace(/\b\w/g, l => l.toUpperCase()); // Capitalize words
                
                // Create entry
                const entry = `${url}|${title}|Imported from Cloudinary|${mediaType}`;
                generatedUrls.push(entry);
            });
            
            // Display results
            const resultTextarea = document.getElementById('generatedUrls');
            resultTextarea.value = generatedUrls.join('\n');
            
            // Update stats
            const stats = document.getElementById('urlStats');
            const imageCount = generatedUrls.filter(url => url.endsWith('|image')).length;
            const videoCount = generatedUrls.filter(url => url.endsWith('|video')).length;
            
            stats.innerHTML = `
                <div class="bg-green-100 dark:bg-green-900/20 p-3 rounded-lg">
                    ✅ Generated ${generatedUrls.length} URLs<br>
                    📸 Images: ${imageCount} | 🎬 Videos: ${videoCount}<br>
                    📋 Ready to copy to Bulk Import!
                </div>
            `;
        }
        
        function copyToClipboard() {
            const textarea = document.getElementById('generatedUrls');
            if (!textarea.value) {
                alert('Generate URLs dulu sebelum copy!');
                return;
            }
            
            textarea.select();
            document.execCommand('copy');
            
            // Show feedback
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = '✅ Copied!';
            button.classList.add('bg-green-600');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-600');
            }, 2000);
        }
        
        function goToBulkImport() {
            const textarea = document.getElementById('generatedUrls');
            if (!textarea.value) {
                alert('Generate URLs dulu!');
                return;
            }
            
            // Store in localStorage to transfer to bulk import page
            localStorage.setItem('cloudinaryBulkUrls', textarea.value);
            
            // Redirect to bulk import
            window.location.href = '{{ route("gallery.cloudinary.bulk") }}';
        }
        
        function clearAll() {
            document.getElementById('cloudName').value = '';
            document.getElementById('folderName').value = '';
            document.getElementById('fileNames').value = '';
            document.getElementById('generatedUrls').value = '';
            document.getElementById('urlStats').innerHTML = 'Ready to generate URLs...';
        }
        
        // Drag & Drop functionality
        function setupDragDrop() {
            const dropArea = document.getElementById('dropArea');
            const fileInput = document.getElementById('fileInput');
            const fileNames = document.getElementById('fileNames');
            
            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });
            
            // Highlight drop area when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            // Handle dropped files
            dropArea.addEventListener('drop', handleDrop, false);
            fileInput.addEventListener('change', handleFileSelect, false);
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            function highlight(e) {
                dropArea.classList.add('border-indigo-500', 'bg-indigo-50');
            }
            
            function unhighlight(e) {
                dropArea.classList.remove('border-indigo-500', 'bg-indigo-50');
            }
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }
            
            function handleFileSelect(e) {
                const files = e.target.files;
                handleFiles(files);
            }
            
            function handleFiles(files) {
                ([...files]).forEach(processFile);
            }
            
            function processFile(file) {
                if (file.type === 'text/plain' || file.name.endsWith('.txt') || file.name.endsWith('.csv')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const content = e.target.result;
                        fileNames.value = content;
                        
                        // Show success message
                        showNotification('✅ File loaded successfully!', 'success');
                    };
                    reader.readAsText(file);
                } else {
                    showNotification('❌ Please upload a .txt or .csv file', 'error');
                }
            }
        }
        
        // Show notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        // Script modal functions
        function showScript() {
            document.getElementById('scriptModal').classList.remove('hidden');
            
            // Load script content (in real implementation, you'd fetch from the file)
            const scriptContent = `// Cloudinary File Name Extractor - Paste this in browser console
(function() {
    console.log('🚀 Cloudinary File Extractor Started...');
    
    function extractFileNames() {
        const fileNames = [];
        const selectors = [
            '[data-testid="media-library-asset"]',
            '.media-library-asset',
            '.asset-card',
            '[title*="."]',
            'img[src*="cloudinary.com"]',
            'video[src*="cloudinary.com"]'
        ];
        
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(el => {
                let fileName = el.getAttribute('title') || 
                              el.getAttribute('alt') || 
                              el.getAttribute('data-public-id');
                
                if (!fileName && el.src) {
                    const matches = el.src.match(/\\/([^\\/]+\\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv))$/i);
                    if (matches) fileName = matches[1];
                }
                
                if (fileName && !fileNames.includes(fileName)) {
                    fileNames.push(fileName);
                }
            });
        });
        
        return fileNames;
    }
    
    function scrollAndExtract() {
        return new Promise((resolve) => {
            let allFiles = [];
            let scrollCount = 0;
            
            function doScroll() {
                const currentFiles = extractFileNames();
                allFiles = [...new Set([...allFiles, ...currentFiles])];
                console.log(\`📄 Scroll \${scrollCount + 1}: Found \${allFiles.length} files\`);
                
                window.scrollTo(0, document.body.scrollHeight);
                scrollCount++;
                
                setTimeout(() => {
                    if (scrollCount < 50) doScroll();
                    else resolve(allFiles);
                }, 2000);
            }
            doScroll();
        });
    }
    
    scrollAndExtract().then(files => {
        const fileList = files.join('\\n');
        const blob = new Blob([fileList], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        
        const a = document.createElement('a');
        a.href = url;
        a.download = 'cloudinary-files.txt';
        a.click();
        
        navigator.clipboard.writeText(fileList);
        alert(\`🎉 Found \${files.length} files! Downloaded and copied to clipboard.\`);
    });
})();`;
            
            document.getElementById('scriptContent').textContent = scriptContent;
        }
        
        function hideScript() {
            document.getElementById('scriptModal').classList.add('hidden');
        }
        
        function copyScript() {
            const scriptContent = document.getElementById('scriptContent').textContent;
            navigator.clipboard.writeText(scriptContent).then(() => {
                showNotification('📋 Script copied to clipboard!', 'success');
            });
        }
        
        // Auto-fill from localStorage if coming from this page
        document.addEventListener('DOMContentLoaded', function() {
            // Setup drag & drop
            setupDragDrop();
            
            // Example data for demo
            document.getElementById('cloudName').value = 'doykx0ctf';
            document.getElementById('folderName').value = '';
            document.getElementById('fileNames').value = `P1211052_ekk4vk.mp4
VID-20251203-WA0053_h8yxkh.mp4
sample1.jpg
sample2.jpg`;
        });
    </script>
</x-app-layout>