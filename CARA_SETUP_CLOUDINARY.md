# Cara Setup Cloudinary - Langkah demi Langkah

## 1. Daftar Akun Cloudinary

1. Buka browser dan kunjungi: https://cloudinary.com
2. Klik "Sign Up for Free"
3. Isi form pendaftaran atau login dengan Google/GitHub
4. Verifikasi email jika diminta

## 2. Dapatkan Kredensial dari Dashboard

Setelah login, Anda akan melihat Dashboard Cloudinary:

1. Di bagian atas dashboard, ada kotak "Account Details"
2. Catat informasi berikut:
   - **Cloud name**: (contoh: `dxample123`)
   - **API Key**: (contoh: `123456789012345`)
   - **API Secret**: (klik "Reveal" untuk melihat, contoh: `abcdefghijklmnopqrstuvwxyz123456`)

## 3. Update File .env

Buka file `.env` di root project Anda dan update bagian Cloudinary:

```env
# Cloudinary Configuration
CLOUDINARY_CLOUD_NAME=dxample123
CLOUDINARY_API_KEY=123456789012345
CLOUDINARY_API_SECRET=abcdefghijklmnopqrstuvwxyz123456
CLOUDINARY_URL=cloudinary://123456789012345:abcdefghijklmnopqrstuvwxyz123456@dxample123
```

**PENTING**: Ganti nilai di atas dengan kredensial Anda yang sebenarnya!

## 4. Test Koneksi

Jalankan command ini untuk test apakah koneksi berhasil:

```bash
php artisan cloudinary:test
```

Jika berhasil, Anda akan melihat:
```
✓ Cloudinary configuration found
✓ Cloudinary connection successful!
✓ Account Plan: Free
✓ Storage Used: 0.00 MB
✓ Bandwidth Used: 0.00 MB

Cloudinary is ready to use! 🎉
```

## 5. Upload Media ke Cloudinary (Opsional)

Jika Anda sudah punya foto/video di komputer dan ingin upload ke Cloudinary:

### Cara 1: Upload via Dashboard Cloudinary
1. Login ke dashboard Cloudinary
2. Klik "Media Library" di menu kiri
3. Klik "Upload" dan pilih file
4. Upload ke folder `manaahel/gallery` (buat folder jika belum ada)

### Cara 2: Upload via Website
1. Buka website Anda: `http://localhost/gallery`
2. Login sebagai admin atau member angkatan
3. Klik "Upload Media"
4. Pilih foto atau video dan upload

## 6. Import Media yang Sudah Ada

Jika Anda sudah upload banyak file ke Cloudinary sebelumnya:

```bash
# Lihat semua media di Cloudinary
php artisan cloudinary:list

# Import semua media ke database
php artisan cloudinary:import

# Atau import dari folder tertentu
php artisan cloudinary:import --folder=nama_folder_anda
```

## 7. Akses Gallery

Buka browser dan kunjungi: `http://localhost/gallery`

Anda akan melihat semua foto dan video yang sudah diimport!

## Troubleshooting

### Error: "Invalid cloud_name"
- Pastikan `CLOUDINARY_CLOUD_NAME` hanya berisi nama cloud, bukan URL
- Contoh yang benar: `dxample123`
- Contoh yang salah: `https://cloudinary.com/dxample123`

### Error: "Invalid API key"
- Pastikan tidak ada spasi di awal atau akhir kredensial
- Copy-paste langsung dari dashboard Cloudinary
- Pastikan API Secret sudah di-reveal di dashboard

### Error: "No media found"
- Coba lihat dulu apa yang ada di Cloudinary: `php artisan cloudinary:list`
- Jika kosong, upload beberapa file dulu via dashboard Cloudinary
- Jika ada file tapi di folder lain, gunakan: `php artisan cloudinary:import --folder=nama_folder`

### Website tidak bisa akses
- Pastikan server Laravel sudah jalan: `php artisan serve`
- Buka: `http://localhost:8000/gallery`

## Tips

1. **Free Tier Cloudinary**: 25GB storage dan 25GB bandwidth per bulan
2. **Format yang didukung**: 
   - Foto: JPG, PNG, GIF (max 5MB)
   - Video: MP4, AVI, MOV, WMV, FLV, WEBM, MKV (max 50MB)
3. **Optimasi otomatis**: Cloudinary akan mengoptimalkan gambar untuk web
4. **Backup lokal**: File juga disimpan di server sebagai backup

## Contoh Lengkap

Misalnya kredensial Cloudinary Anda:
- Cloud name: `manaahel-gallery`
- API Key: `987654321098765`
- API Secret: `zyxwvutsrqponmlkjihgfedcba987654`

Maka file `.env` Anda:
```env
CLOUDINARY_CLOUD_NAME=manaahel-gallery
CLOUDINARY_API_KEY=987654321098765
CLOUDINARY_API_SECRET=zyxwvutsrqponmlkjihgfedcba987654
CLOUDINARY_URL=cloudinary://987654321098765:zyxwvutsrqponmlkjihgfedcba987654@manaahel-gallery
```