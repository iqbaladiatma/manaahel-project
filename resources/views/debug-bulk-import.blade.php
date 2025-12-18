<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Bulk Import</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">🔍 Debug Bulk Import</h1>
        
        <!-- Recent Gallery Items -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">📸 Recent Gallery Items</h2>
            <div class="space-y-4">
                @php
                    $recentItems = \App\Models\Gallery::orderBy('created_at', 'desc')->take(10)->get();
                @endphp
                
                @if($recentItems->count() > 0)
                    @foreach($recentItems as $item)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Image Preview -->
                            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                @if($item->file_type === 'video')
                                    <video class="w-full h-full object-cover" controls>
                                        <source src="{{ route('video.stream', ['url' => $item->file_path]) }}" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ $item->file_path }}" alt="{{ $item->title }}" 
                                         class="w-full h-full object-cover"
                                         onerror="this.src='https://via.placeholder.com/400x300/ccc/999?text=Image+Error'">
                                @endif
                            </div>
                            
                            <!-- Info -->
                            <div class="md:col-span-2">
                                <h3 class="font-semibold text-lg mb-2">{{ $item->title }}</h3>
                                <div class="space-y-1 text-sm text-gray-600">
                                    <p><strong>ID:</strong> {{ $item->id }}</p>
                                    <p><strong>Type:</strong> {{ $item->file_type }}</p>
                                    <p><strong>Visibility:</strong> 
                                        <span class="px-2 py-1 rounded text-xs {{ $item->visibility === 'public' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $item->visibility }}
                                        </span>
                                    </p>
                                    <p><strong>User:</strong> {{ $item->user_id ? 'User #' . $item->user_id : 'None' }}</p>
                                    <p><strong>Batch Filter:</strong> {{ $item->batch_filter ?? 'None' }}</p>
                                    <p><strong>Created:</strong> {{ $item->created_at->format('Y-m-d H:i:s') }}</p>
                                    <p><strong>URL:</strong> 
                                        <a href="{{ $item->file_path }}" target="_blank" class="text-blue-500 hover:underline text-xs break-all">
                                            {{ Str::limit($item->file_path, 60) }}
                                        </a>
                                    </p>
                                </div>
                                
                                <!-- Actions -->
                                <div class="mt-3 space-x-2">
                                    <button onclick="makePublic({{ $item->id }})" 
                                            class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                        Make Public
                                    </button>
                                    <button onclick="deleteItem({{ $item->id }})" 
                                            class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-gray-500">No gallery items found.</p>
                @endif
            </div>
        </div>

        <!-- URL Format Fixer -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">🔧 URL Format Fixer</h2>
            <p class="text-gray-600 mb-4">
                Paste URL list yang error (tanpa line breaks) dan akan diperbaiki formatnya:
            </p>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Raw URL List (Error Format):</label>
                    <textarea id="rawUrls" rows="5" 
                              class="w-full p-3 border border-gray-300 rounded-lg font-mono text-sm"
                              placeholder="Paste URL list yang error di sini..."></textarea>
                </div>
                
                <button onclick="fixUrlFormat()" 
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    🔧 Fix Format
                </button>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Fixed URL List:</label>
                    <textarea id="fixedUrls" rows="10" 
                              class="w-full p-3 border border-gray-300 rounded-lg font-mono text-sm bg-gray-50"
                              readonly></textarea>
                </div>
                
                <div class="flex space-x-4">
                    <button onclick="copyFixed()" 
                            class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        📋 Copy Fixed URLs
                    </button>
                    <a href="{{ route('gallery.cloudinary.bulk') }}" 
                       class="px-6 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 inline-block">
                        🚀 Go to Bulk Import
                    </a>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4">⚡ Bulk Actions</h2>
            <div class="space-x-4">
                <button onclick="makeAllPublic()" 
                        class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                    🌍 Make All Public
                </button>
                <button onclick="deleteRecent()" 
                        class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    🗑️ Delete Recent Imports
                </button>
                <a href="{{ route('gallery.index') }}" 
                   class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 inline-block">
                    📸 View Gallery
                </a>
            </div>
        </div>
    </div>

    <script>
        function fixUrlFormat() {
            const rawUrls = document.getElementById('rawUrls').value;
            
            if (!rawUrls.trim()) {
                alert('Please paste the raw URL list first!');
                return;
            }
            
            // Split by URL pattern and rejoin with line breaks
            const urlPattern = /(https:\/\/res\.cloudinary\.com\/[^|]+\|[^|]+\|[^|]+\|[^h]+)/g;
            const matches = rawUrls.match(urlPattern);
            
            if (matches) {
                const fixedList = matches.join('\n');
                document.getElementById('fixedUrls').value = fixedList;
                
                // Show stats
                alert(`✅ Fixed format!\nFound ${matches.length} URLs\nReady to copy and use in bulk import.`);
            } else {
                alert('❌ No valid URL patterns found. Please check the format.');
            }
        }
        
        function copyFixed() {
            const fixedUrls = document.getElementById('fixedUrls').value;
            if (!fixedUrls.trim()) {
                alert('Fix the format first!');
                return;
            }
            
            navigator.clipboard.writeText(fixedUrls).then(() => {
                alert('📋 Fixed URLs copied to clipboard!');
            });
        }
        
        function makePublic(id) {
            if (confirm('Make this item public?')) {
                fetch(`/gallery/make-public/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            }
        }
        
        function deleteItem(id) {
            if (confirm('Delete this item?')) {
                fetch(`/gallery/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            }
        }
        
        function makeAllPublic() {
            if (confirm('Make all recent gallery items public?')) {
                fetch('/gallery/make-all-public', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
            }
        }
        
        function deleteRecent() {
            if (confirm('Delete all recent imports? This cannot be undone!')) {
                fetch('/gallery/delete-recent', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
            }
        }
        
        // Auto-fill example for testing
        document.addEventListener('DOMContentLoaded', function() {
            const exampleRaw = `https://res.cloudinary.com/doykx0ctf/image/upload/P1322736_c5whyc.jpg|P1322736 C5whyc|Imported from Cloudinary|imagehttps://res.cloudinary.com/doykx0ctf/image/upload/P1322625_ww6h7t.jpg|P1322625 Ww6h7t|Imported from Cloudinary|image`;
            document.getElementById('rawUrls').placeholder = `Example error format:\n${exampleRaw}`;
        });
    </script>
</body>
</html>