# Setup Cloudinary untuk Gallery

## Langkah-langkah Setup

### 1. Daftar Akun Cloudinary
1. Kunjungi [cloudinary.com](https://cloudinary.com)
2. Daftar akun gratis
3. Setelah login, buka Dashboard

### 2. Dapatkan Kredensial Cloudinary
Di Dashboard Cloudinary, Anda akan melihat:
- **Cloud Name**: nama cloud Anda
- **API Key**: kunci API
- **API Secret**: secret key

### 3. Konfigurasi Environment Variables
Buka file `.env` dan update konfigurasi Cloudinary:

```env
# Cloudinary Configuration
CLOUDINARY_CLOUD_NAME=your_cloud_name_here
CLOUDINARY_API_KEY=your_api_key_here
CLOUDINARY_API_SECRET=your_api_secret_here
CLOUDINARY_URL=cloudinary://your_api_key:your_api_secret@your_cloud_name
```

**Ganti nilai berikut:**
- `your_cloud_name_here` dengan Cloud Name Anda
- `your_api_key_here` dengan API Key Anda  
- `your_api_secret_here` dengan API Secret Anda

### 4. Test Konfigurasi
Jalankan command berikut untuk test koneksi:

```bash
php artisan cloudinary:test
```

## Mengimpor Media yang Sudah Ada di Cloudinary

### 1. Lihat Semua Media di Cloudinary
```bash
# Lihat semua media
php artisan cloudinary:list

# Lihat media di folder tertentu
php artisan cloudinary:list --folder=manaahel/gallery

# Batasi jumlah yang ditampilkan
php artisan cloudinary:list --limit=20
```

### 2. Import Media ke Database
```bash
# Import semua media dari folder default
php artisan cloudinary:import

# Import dari folder tertentu
php artisan cloudinary:import --folder=your_folder_name

# Batasi jumlah import
php artisan cloudinary:import --limit=50

# Import dari root Cloudinary (tanpa folder)
php artisan cloudinary:import --folder=""
```

### 3. Contoh Penggunaan
```bash
# Jika foto/video Anda ada di root Cloudinary
php artisan cloudinary:import --folder="" --limit=100

# Jika foto/video Anda ada di folder "gallery"
php artisan cloudinary:import --folder=gallery --limit=100

# Jika foto/video Anda ada di folder "photos"
php artisan cloudinary:import --folder=photos --limit=100
```

## Fitur yang Sudah Diimplementasi

### Upload Media Baru
- Support foto (JPG, PNG, GIF) hingga 5MB
- Support video (MP4, AVI, MOV, WMV, FLV, WEBM, MKV) hingga 50MB
- Otomatis upload ke Cloudinary dengan fallback ke local storage
- Auto-detect tipe file (image/video)

### Gallery Display
- Optimized image delivery dari Cloudinary
- Video player dengan thumbnail
- Lightbox untuk view gambar full size
- Responsive design untuk mobile dan desktop
- Media type indicator (foto/video)

### Import dari Cloudinary
- Import semua media yang sudah ada
- Auto-generate title dari nama file
- Deteksi otomatis tipe media (image/video)
- Skip file yang sudah ada di database

### Cloudinary Features
- Auto quality optimization
- Auto format selection (WebP, AVIF untuk browser yang support)
- Responsive images
- Video transcoding otomatis

## Struktur Folder di Cloudinary
- Upload baru akan disimpan di: `manaahel/gallery/`
- Import bisa dari folder manapun yang Anda tentukan

## Backup Strategy
- Semua file tetap disimpan di local storage sebagai backup
- Jika Cloudinary gagal, sistem akan fallback ke local file
- Database menyimpan kedua path (Cloudinary dan local)

## Commands yang Tersedia

### Test Koneksi
```bash
php artisan cloudinary:test
```

### Lihat Media di Cloudinary
```bash
php artisan cloudinary:list [--folder=nama_folder] [--limit=50]
```

### Import Media ke Database
```bash
php artisan cloudinary:import [--folder=nama_folder] [--limit=100]
```

## Troubleshooting

### Error: "Invalid cloud_name"
- Pastikan CLOUDINARY_CLOUD_NAME sudah benar
- Jangan gunakan URL, hanya nama cloud

### Error: "Invalid API key"
- Pastikan CLOUDINARY_API_KEY dan CLOUDINARY_API_SECRET benar
- Pastikan tidak ada spasi di awal/akhir

### "No media found"
- Cek apakah folder yang ditentukan benar
- Coba tanpa folder: `--folder=""`
- Gunakan `cloudinary:list` untuk melihat struktur folder

### Upload Gagal
- Cek koneksi internet
- Pastikan file size tidak melebihi limit
- Cek format file yang didukung

## Performance Tips
- Cloudinary otomatis mengoptimalkan gambar
- Video akan di-transcode untuk web delivery
- Gunakan lazy loading untuk gallery dengan banyak item

## Monitoring Usage
- Login ke Cloudinary Dashboard untuk melihat usage
- Free tier: 25GB storage, 25GB bandwidth per bulan
- Monitor transformasi dan delivery stats