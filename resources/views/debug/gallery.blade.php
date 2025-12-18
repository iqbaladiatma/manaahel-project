<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Debug</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .status { padding: 10px; border-radius: 4px; margin-bottom: 10px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .warning { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .btn-success { background: #28a745; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-danger { background: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .url { max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Gallery System Debug</h1>
        
        <!-- Status Overview -->
        <div class="card">
            <h2>📊 System Status</h2>
            
            @if($current_user)
                <div class="status {{ $is_admin ? 'success' : 'warning' }}">
                    <strong>User:</strong> {{ $current_user->name }} ({{ $current_user->email }})
                    <br><strong>Role:</strong> {{ $current_user->role }}
                    @if($is_admin)
                        ✅ Admin access granted
                    @else
                        ⚠️ Not admin - cannot add Cloudinary media
                    @endif
                </div>
            @else
                <div class="status error">
                    ❌ Not logged in - <a href="{{ route('login') }}">Login here</a>
                </div>
            @endif
            
            <div class="status success">
                <strong>Database:</strong> {{ $total_galleries }} gallery items found
                <br><strong>Admin Users:</strong> {{ $admin_count }} users
            </div>
        </div>

        <div class="grid">
            <!-- Quick Test -->
            <div class="card">
                <h2>🧪 Quick Test</h2>
                <p>Test apakah sistem bisa menambah gallery item:</p>
                
                @if($is_admin)
                    <button class="btn btn-success" onclick="testCloudinary()">
                        Test Tambah Gallery Item
                    </button>
                    <div id="test-result" style="margin-top: 10px;"></div>
                @else
                    <div class="status warning">
                        Login sebagai admin untuk test ini
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h2>🚀 Quick Actions</h2>
                <a href="{{ route('gallery.index') }}" class="btn">📸 View Gallery</a>
                
                @if($is_admin)
                    <a href="{{ route('gallery.cloudinary.create') }}" class="btn btn-warning">+ Add Cloudinary</a>
                    <a href="{{ route('gallery.cloudinary.bulk') }}" class="btn btn-warning">📦 Bulk Import</a>
                @endif
                
                <a href="{{ route('gallery.create') }}" class="btn">📤 Upload File</a>
            </div>
        </div>

        <!-- Manual Test Form -->
        @if($is_admin)
        <div class="card">
            <h2>📝 Manual Test Form</h2>
            <form action="{{ route('gallery.cloudinary.store') }}" method="POST">
                @csrf
                <div class="grid">
                    <div>
                        <div class="form-group">
                            <label>Cloudinary URL</label>
                            <input type="url" name="cloudinary_url" required 
                                   value="https://res.cloudinary.com/demo/image/upload/sample.jpg">
                        </div>
                        
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" required 
                                   value="Test Manual - {{ now()->format('H:i:s') }}">
                        </div>
                        
                        <div class="form-group">
                            <label>File Type</label>
                            <select name="file_type" required>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="3">Test manual dari debug page</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Visibility</label>
                            <select name="visibility" required>
                                <option value="public">Public</option>
                                <option value="member_only">Member Only</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit Test</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif

        <!-- Recent Gallery Items -->
        <div class="card">
            <h2>📸 Recent Gallery Items ({{ $total_galleries }} total)</h2>
            
            @if($galleries->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Visibility</th>
                            <th>URL</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>{{ is_array($gallery->title) ? ($gallery->title['id'] ?? 'No title') : $gallery->title }}</td>
                            <td>{{ $gallery->file_type ?? 'unknown' }}</td>
                            <td>{{ $gallery->visibility ?? 'unknown' }}</td>
                            <td class="url">{{ $gallery->file_path }}</td>
                            <td>{{ $gallery->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="status warning">
                    No gallery items found
                </div>
            @endif
        </div>

        <!-- Troubleshooting -->
        <div class="card">
            <h2>🔧 Troubleshooting</h2>
            <h3>Common Issues:</h3>
            <ul>
                <li><strong>Form tidak submit:</strong> Cek browser console untuk JavaScript errors</li>
                <li><strong>Error 403:</strong> Pastikan login sebagai admin</li>
                <li><strong>Error 422:</strong> Validasi gagal - cek URL format</li>
                <li><strong>Data tidak muncul:</strong> Cek apakah data tersimpan di database</li>
            </ul>
            
            <h3>Valid Cloudinary URL Examples:</h3>
            <ul>
                <li>https://res.cloudinary.com/demo/image/upload/sample.jpg</li>
                <li>https://res.cloudinary.com/demo/video/upload/sample.mp4</li>
                <li>https://res.cloudinary.com/your-cloud/image/upload/v1234567890/folder/image.jpg</li>
            </ul>
        </div>
    </div>

    <script>
        // Set CSRF token for AJAX requests
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        function testCloudinary() {
            const resultDiv = document.getElementById('test-result');
            resultDiv.innerHTML = '<div class="status warning">Testing...</div>';
            
            fetch('/debug/test-cloudinary', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.innerHTML = `
                        <div class="status success">
                            ✅ ${data.message}<br>
                            Gallery ID: ${data.id}<br>
                            <a href="${data.redirect}" class="btn">View Gallery</a>
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="status error">
                            ❌ Error: ${data.error}
                        </div>
                    `;
                }
            })
            .catch(error => {
                resultDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network Error: ${error.message}
                    </div>
                `;
            });
        }
    </script>
</body>
</html>