# Manaahel Academy

Sistem pendaftaran program khusus untuk Manaahel Academy yang terpisah dari sistem course/program utama.

## Fitur

### 1. Halaman Publik
- **Daftar Program** (`/academy`) - Menampilkan semua program academy yang aktif
- **Detail Program** (`/academy/{slug}`) - Menampilkan detail program dan form pendaftaran
  - User login: Pendaftaran 1-klik menggunakan data profil
  - Guest: Form manual pendaftaran
  - Validasi profil lengkap untuk user login
  - Cek duplikasi pendaftaran
- **Halaman Sukses** (`/academy-success/{registration}`) - Menampilkan konfirmasi pendaftaran dan link WhatsApp grup

### 2. Admin Panel (Filament)
- **Academy Programs** - Kelola program academy (CRUD)
- **Academy Registrations** - Kelola pendaftaran peserta

### 3. Fitur Utama
- **Pendaftaran Cepat untuk User Login**: 1-klik daftar menggunakan data profil
- **Validasi Profil**: Sistem cek kelengkapan data (nama, email, phone)
- **Cegah Duplikasi**: User tidak bisa daftar 2x di program yang sama
- **Guest Registration**: Tetap bisa daftar tanpa login (form manual)
- Otomatis mendapat link WhatsApp grup setelah mendaftar
- Support multi-bahasa (ID, EN, AR)
- Responsive design dengan tema Islamic
- Upload gambar program
- Set harga program (bisa gratis)
- Set kuota peserta
- Tracking status pendaftaran (pending, approved, rejected)
- Relasi dengan User account (opsional)

## Database

### Tabel: `academy_programs`
- `id` - Primary key
- `name` - JSON (multi-bahasa)
- `slug` - Unique identifier
- `description` - JSON (multi-bahasa)
- `details` - JSON (multi-bahasa, rich text)
- `whatsapp_group_link` - Link grup WhatsApp
- `price` - Harga program
- `start_date` - Tanggal mulai
- `end_date` - Tanggal selesai
- `image` - Gambar program
- `is_active` - Status aktif/non-aktif
- `max_participants` - Kuota maksimal peserta

### Tabel: `academy_registrations`
- `id` - Primary key
- `academy_program_id` - Foreign key ke academy_programs
- `user_id` - Foreign key ke users (nullable, untuk user login)
- `name` - Nama peserta
- `email` - Email peserta
- `phone` - No. WhatsApp peserta
- `notes` - Catatan dari peserta
- `status` - Status (pending, approved, rejected)
- `whatsapp_group_link` - Link grup WhatsApp (copy dari program)

## Routes

```php
// Public routes
GET  /academy                          - Daftar program
GET  /academy/{slug}                   - Detail program
POST /academy/{slug}/register          - Submit pendaftaran
GET  /academy-success/{registration}   - Halaman sukses
```

## Cara Menggunakan

### Untuk Admin:
1. Login ke admin panel
2. Buka menu "Manaahel Academy" > "Programs"
3. Buat program baru dengan mengisi:
   - Nama program (multi-bahasa)
   - Deskripsi
   - Detail program
   - Link WhatsApp grup
   - Harga
   - Tanggal mulai & selesai
   - Upload gambar (opsional)
   - Set kuota peserta (opsional)
4. Aktifkan program
5. Lihat pendaftaran di menu "Registrations"

### Untuk Peserta (User Login):
1. Login ke akun Anda
2. Kunjungi `/academy`
3. Pilih program yang diinginkan
4. Klik "Daftar Sekarang" (data otomatis diambil dari profil)
5. Tambahkan catatan jika perlu (opsional)
6. Submit
7. Akan diarahkan ke halaman sukses dengan link WhatsApp grup
8. Klik tombol untuk join grup WhatsApp

**Catatan:** Jika profil belum lengkap (nama, email, atau phone kosong), sistem akan meminta untuk melengkapi profil terlebih dahulu.

### Untuk Peserta (Guest):
1. Kunjungi `/academy`
2. Pilih program yang diinginkan
3. Klik "Login Sekarang" untuk pendaftaran cepat, atau scroll ke bawah untuk isi form manual
4. Isi form pendaftaran:
   - Nama lengkap
   - Email
   - No. WhatsApp
   - Catatan (opsional)
5. Submit
6. Akan diarahkan ke halaman sukses dengan link WhatsApp grup
7. Klik tombol untuk join grup WhatsApp

## Perbedaan dengan Program Utama

| Fitur | Program Utama | Manaahel Academy |
|-------|---------------|------------------|
| Course/Modul | ✅ Ada | ❌ Tidak ada |
| Perlu Login | ✅ Ya | ❌ Tidak |
| Approval | ✅ Manual | ✅ Otomatis |
| WhatsApp Grup | ❌ Tidak | ✅ Ya |
| Tipe | Academy/Competition | Academy only |
| Delivery | Online Course/Zoom | Tidak relevan |

## Seeder

Untuk menambahkan data contoh:
```bash
php artisan db:seed --class=AcademyProgramSeeder
```

## File yang Dibuat

### Models
- `app/Models/AcademyProgram.php`
- `app/Models/AcademyRegistration.php`

### Controllers
- `app/Http/Controllers/AcademyController.php`

### Views
- `resources/views/academy/index.blade.php`
- `resources/views/academy/show.blade.php`
- `resources/views/academy/success.blade.php`

### Migrations
- `database/migrations/2025_12_06_212710_create_academy_programs_table.php`
- `database/migrations/2025_12_06_212749_create_academy_registrations_table.php`

### Filament Resources
- `app/Filament/Resources/AcademyPrograms/AcademyProgramResource.php`
- `app/Filament/Resources/AcademyRegistrations/AcademyRegistrationResource.php`

### Seeders
- `database/seeders/AcademyProgramSeeder.php`
