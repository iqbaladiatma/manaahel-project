# Requirements Document

## Introduction

Manaahel Platform adalah sistem web terintegrasi berbasis Laravel 12 dan FilamentPHP v4 yang berfungsi sebagai pusat informasi, pendaftaran program (Academy & Competition), manajemen komunitas alumni/anggota, dan sarana E-Learning. Sistem ini dirancang untuk mendukung tiga bahasa (Indonesia, Inggris, Arab) dengan dukungan penuh untuk tata letak RTL (Right-to-Left) pada bahasa Arab.

## Glossary

- **System**: Manaahel Platform web application
- **User**: Pengunjung yang belum terautentikasi
- **Member**: Pengguna yang telah terdaftar dan terautentikasi dengan akses ke konten eksklusif
- **Admin**: Pengguna dengan hak akses penuh untuk mengelola konten dan data sistem
- **Program**: Layanan yang ditawarkan (Academy atau Competition)
- **Registration**: Proses pendaftaran program oleh User atau Member
- **Article**: Konten blog yang dapat dikategorikan
- **Gallery**: Koleksi foto/video dokumentasi
- **Course**: Materi pembelajaran dalam sistem E-Learning
- **RTL**: Right-to-Left layout untuk bahasa Arab
- **LTR**: Left-to-Right layout untuk bahasa Indonesia dan Inggris
- **Translatable Content**: Konten yang tersimpan dalam multiple bahasa (ID/EN/AR)

## Requirements

### Requirement 1

**User Story:** Sebagai pengunjung, saya ingin dapat mengganti bahasa tampilan situs, sehingga saya dapat membaca konten dalam bahasa yang saya pahami.

#### Acceptance Criteria

1. WHEN a User selects a language from the language switcher THEN the System SHALL display all interface elements and translatable content in the selected language
2. WHEN a User selects Arabic language THEN the System SHALL change the layout direction to RTL
3. WHEN a User selects Indonesian or English language THEN the System SHALL change the layout direction to LTR
4. THE System SHALL persist the selected language preference across page navigations within the same session
5. THE System SHALL support three languages: Indonesian, English, and Arabic

### Requirement 2

**User Story:** Sebagai pengunjung, saya ingin melihat informasi tentang program yang ditawarkan, sehingga saya dapat memahami layanan yang tersedia sebelum mendaftar.

#### Acceptance Criteria

1. WHEN a User navigates to the programs page THEN the System SHALL display a list of all active programs with their basic information
2. WHEN a User clicks on a program THEN the System SHALL display the complete program details including description, fees, and dates in the selected language
3. WHERE a program has status set to closed THEN the System SHALL indicate that registration is not currently available
4. THE System SHALL display program information in the User's selected language
5. THE System SHALL support two program types: Academy and Competition

### Requirement 3

**User Story:** Sebagai pengunjung atau member, saya ingin mendaftar ke program yang tersedia, sehingga saya dapat mengikuti Academy atau Competition.

#### Acceptance Criteria

1. WHEN a User submits a registration form with valid data THEN the System SHALL create a new registration record with status pending
2. WHEN a User uploads payment proof during registration THEN the System SHALL store the file and associate it with the registration record
3. IF a User attempts to submit registration without required fields THEN the System SHALL prevent submission and display validation errors
4. WHEN a registration is created THEN the System SHALL set the initial status to pending
5. THE System SHALL require authentication before allowing registration submission

### Requirement 4

**User Story:** Sebagai admin, saya ingin dapat memverifikasi bukti pembayaran pendaftar, sehingga saya dapat mengonfirmasi pendaftaran yang valid.

#### Acceptance Criteria

1. WHEN an Admin views a pending registration THEN the System SHALL display the registration details including payment proof image
2. WHEN an Admin approves a registration THEN the System SHALL update the registration status to approved
3. WHEN an Admin rejects a registration THEN the System SHALL update the registration status to rejected
4. THE System SHALL only allow Admin role users to change registration status
5. WHEN a registration status changes THEN the System SHALL persist the new status to the database immediately

### Requirement 5

**User Story:** Sebagai pengunjung, saya ingin membaca artikel blog, sehingga saya dapat memperoleh informasi dan update terbaru.

#### Acceptance Criteria

1. WHEN a User navigates to the blog page THEN the System SHALL display a list of published articles with title, excerpt, and category
2. WHEN a User filters articles by category THEN the System SHALL display only articles belonging to the selected category
3. WHEN a User clicks on an article THEN the System SHALL display the full article content in the selected language
4. THE System SHALL support article categories: General, Prestasi, Tutor Kuliah Dalam Negeri, and Tutor Kuliah Luar Negeri
5. THE System SHALL display article content in the User's selected language

### Requirement 6

**User Story:** Sebagai pengunjung, saya ingin melihat peta persebaran anggota Manaahel, sehingga saya dapat mengetahui jangkauan geografis komunitas.

#### Acceptance Criteria

1. WHEN a User navigates to the distribution map page THEN the System SHALL display an interactive map with member location markers
2. WHEN a Member updates their profile with latitude and longitude coordinates THEN the System SHALL include their location on the distribution map
3. THE System SHALL display markers for all Members who have provided location coordinates
4. WHEN a User clicks on a map marker THEN the System SHALL display basic member information associated with that location
5. THE System SHALL render the map using Leaflet.js library

### Requirement 7

**User Story:** Sebagai member, saya ingin mengakses galeri foto dan video angkatan saya, sehingga saya dapat melihat dokumentasi kegiatan.

#### Acceptance Criteria

1. WHEN a Member navigates to the gallery page THEN the System SHALL display only gallery items that match their batch year or have no batch filter
2. WHEN a User who is not authenticated attempts to access member-only gallery THEN the System SHALL redirect them to the login page
3. WHERE a gallery item has visibility set to public THEN the System SHALL display it to all Users regardless of authentication status
4. WHERE a gallery item has visibility set to member-only THEN the System SHALL display it only to authenticated Members
5. THE System SHALL prevent search engines from indexing member-only gallery content

### Requirement 8

**User Story:** Sebagai member, saya ingin mengakses materi pembelajaran online, sehingga saya dapat belajar sesuai dengan program yang saya ikuti.

#### Acceptance Criteria

1. WHEN a Member navigates to the e-learning section THEN the System SHALL display a list of courses available to them
2. WHEN a Member clicks on a course THEN the System SHALL display the course content including video and textual materials
3. WHEN a course contains a video URL THEN the System SHALL embed and display the video player
4. THE System SHALL only allow authenticated Members to access e-learning content
5. WHERE a course is associated with a specific program THEN the System SHALL display it to Members enrolled in that program

### Requirement 9

**User Story:** Sebagai admin, saya ingin mengelola konten situs melalui admin panel, sehingga saya dapat memperbarui informasi tanpa mengubah kode.

#### Acceptance Criteria

1. WHEN an Admin creates or updates an article THEN the System SHALL save the content in all three supported languages
2. WHEN an Admin creates or updates a program THEN the System SHALL save the translatable fields in all three supported languages
3. WHEN an Admin creates a gallery item THEN the System SHALL allow setting visibility and batch filter options
4. THE System SHALL provide CRUD operations for Articles, Programs, Galleries, and Courses through the Filament admin panel
5. THE System SHALL only allow users with Admin role to access the admin panel

### Requirement 10

**User Story:** Sebagai user, saya ingin mendaftar akun dan login, sehingga saya dapat mengakses fitur member area.

#### Acceptance Criteria

1. WHEN a User submits a registration form with valid email and password THEN the System SHALL create a new user account with role set to user
2. WHEN a User registers THEN the System SHALL send an email verification link to the provided email address
3. WHEN a User clicks the verification link THEN the System SHALL mark the email as verified and allow login
4. WHEN a User submits valid login credentials THEN the System SHALL authenticate the user and create a session
5. IF a User submits invalid login credentials THEN the System SHALL reject the login attempt and display an error message

### Requirement 11

**User Story:** Sebagai member, saya ingin memperbarui profil saya termasuk lokasi, sehingga informasi saya tetap akurat dan saya dapat muncul di peta persebaran.

#### Acceptance Criteria

1. WHEN a Member updates their profile THEN the System SHALL save the changes to the database immediately
2. WHEN a Member provides latitude and longitude coordinates THEN the System SHALL validate that they are valid decimal numbers
3. WHEN a Member updates their location coordinates THEN the System SHALL reflect the changes on the distribution map
4. THE System SHALL allow Members to update their name, batch year, avatar, and location coordinates
5. THE System SHALL only allow authenticated Members to update their own profile

### Requirement 12

**User Story:** Sebagai admin, saya ingin melihat statistik dashboard, sehingga saya dapat memantau aktivitas platform.

#### Acceptance Criteria

1. WHEN an Admin accesses the dashboard THEN the System SHALL display the total count of pending registrations
2. WHEN an Admin accesses the dashboard THEN the System SHALL display the total count of published articles
3. WHEN an Admin accesses the dashboard THEN the System SHALL display the total count of registered members
4. THE System SHALL update dashboard statistics in real-time when underlying data changes
5. THE System SHALL only display the dashboard to users with Admin role
