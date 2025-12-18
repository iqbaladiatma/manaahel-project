<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Program;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\AcademyProgram;
use App\Models\Registration;
use App\Models\Gallery;
use App\Models\Achievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "🌱 Memulai seeding database...\n\n";

        // ============================================
        // 1. USERS
        // ============================================
        echo "👤 Membuat users...\n";
        
        $admin = User::create([
            'name' => 'Admin Manaahel',
            'email' => 'admin@manaahel.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'batch_year' => 2024,
            'phone' => '081234567890',
            'bio' => 'Administrator platform Manaahel',
            'city' => 'Jakarta',
        ]);

        $user1 = User::create([
            'name' => 'Ahmad Abdullah',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2024,
            'phone' => '081234567891',
            'bio' => 'Pelajar yang antusias dalam bidang teknologi',
            'city' => 'Bandung',
        ]);

        $user2 = User::create([
            'name' => 'Fatimah Hassan',
            'email' => 'fatimah@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2023,
            'phone' => '081234567892',
            'bio' => 'Pengembang web dan desainer',
            'city' => 'Surabaya',
        ]);

        $user3 = User::create([
            'name' => 'Muhammad Ali',
            'email' => 'muhammad@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2024,
            'phone' => '081234567893',
            'bio' => 'Data scientist dan AI enthusiast',
            'city' => 'Yogyakarta',
        ]);

        echo "   ✓ 4 users berhasil dibuat\n\n";

        // ============================================
        // 2. CATEGORIES
        // ============================================
        echo "📁 Membuat categories...\n";
        
        $catTech = Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        $catEdu = Category::create([
            'name' => 'Pendidikan',
            'slug' => 'pendidikan',
        ]);

        $catCommunity = Category::create([
            'name' => 'Komunitas',
            'slug' => 'komunitas',
        ]);

        $catEvent = Category::create([
            'name' => 'Acara',
            'slug' => 'acara',
        ]);

        echo "   ✓ 4 categories berhasil dibuat\n\n";

        // ============================================
        // 3. ARTICLES
        // ============================================
        echo "📝 Membuat articles...\n";
        
        Article::create([
            'title' => 'Selamat Datang di Platform Manaahel',
            'content' => '<p>Kami dengan senang hati mengumumkan peluncuran platform baru kami. Platform Manaahel dirancang untuk menjadi pusat pembelajaran, kolaborasi, dan pembangunan komunitas yang inklusif.</p><p>Bergabunglah dengan kami dalam perjalanan transformasi pendidikan dan pengembangan diri. Bersama-sama kita akan menciptakan ekosistem pembelajaran yang lebih baik.</p>',
            'slug' => 'selamat-datang-di-platform-manaahel',
            'category_id' => $catCommunity->id,
            'author_id' => $admin->id,
            'is_published' => true,
            'is_featured' => true,
            'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop',
        ]);

        Article::create([
            'title' => 'Program Academy Baru Diluncurkan',
            'content' => '<p>Kami sangat senang memperkenalkan program Academy baru kami yang dirancang untuk meningkatkan keterampilan dan pengetahuan Anda di berbagai bidang.</p><p>Program ini mencakup pembelajaran interaktif, proyek praktis, dan bimbingan dari para ahli industri. Daftar sekarang dan mulai perjalanan belajar Anda!</p>',
            'slug' => 'program-academy-baru-diluncurkan',
            'category_id' => $catEdu->id,
            'author_id' => $admin->id,
            'is_published' => true,
            'is_featured' => true,
            'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&h=600&fit=crop',
        ]);

        Article::create([
            'title' => 'Tips Belajar Efektif untuk Pemula',
            'content' => '<p>Memulai perjalanan belajar bisa menantang. Berikut adalah beberapa tips yang telah terbukti membantu ribuan pelajar mencapai tujuan mereka:</p><ul><li>Buat jadwal belajar yang konsisten</li><li>Fokus pada satu topik dalam satu waktu</li><li>Praktikkan apa yang Anda pelajari</li><li>Bergabung dengan komunitas pembelajar</li><li>Jangan takut untuk bertanya</li></ul>',
            'slug' => 'tips-belajar-efektif-untuk-pemula',
            'category_id' => $catEdu->id,
            'author_id' => $user1->id,
            'is_published' => true,
            'is_featured' => false,
            'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&h=600&fit=crop',
        ]);

        Article::create([
            'title' => 'Teknologi Terbaru dalam Pendidikan',
            'content' => '<p>Dunia pendidikan terus berkembang dengan teknologi baru. Dari AI hingga VR, mari kita jelajahi bagaimana teknologi mengubah cara kita belajar dan mengajar.</p><p>Platform kami mengintegrasikan teknologi terkini untuk pengalaman belajar yang optimal dan menyenangkan.</p>',
            'slug' => 'teknologi-terbaru-dalam-pendidikan',
            'category_id' => $catTech->id,
            'author_id' => $user3->id,
            'is_published' => true,
            'is_featured' => false,
            'image_url' => 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=800&h=600&fit=crop',
        ]);

        echo "   ✓ 4 articles berhasil dibuat\n\n";

        // ============================================
        // 4. PROGRAMS
        // ============================================
        echo "🎓 Membuat programs...\n";
        
        $program1 = Program::create([
            'name' => 'Akademi Pengembangan Web',
            'description' => 'Pelajari pengembangan web modern dengan HTML, CSS, JavaScript, dan framework populer seperti React dan Vue.js. Program ini dirancang untuk pemula hingga menengah.',
            'syllabus' => '<ul><li>HTML & CSS Fundamentals</li><li>JavaScript ES6+</li><li>React.js</li><li>Node.js & Express</li><li>Database & API</li><li>Deployment</li></ul>',
            'slug' => 'akademi-pengembangan-web',
            'type' => 'academy',
            'delivery_type' => 'online_course',
            'status' => true,
            'fees' => 299000,
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(120),
            'creator_id' => $admin->id,
        ]);

        $program2 = Program::create([
            'name' => 'Bootcamp Data Science',
            'description' => 'Kuasai ilmu data, pembelajaran mesin, dan AI dengan proyek praktis. Belajar Python, pandas, scikit-learn, dan TensorFlow dari dasar hingga mahir.',
            'syllabus' => '<ul><li>Python untuk Data Science</li><li>Statistik & Probabilitas</li><li>Machine Learning</li><li>Deep Learning</li><li>Data Visualization</li><li>Real-world Projects</li></ul>',
            'slug' => 'bootcamp-data-science',
            'type' => 'academy',
            'delivery_type' => 'online_zoom',
            'status' => true,
            'fees' => 499000,
            'start_date' => now()->addDays(45),
            'end_date' => now()->addDays(135),
            'creator_id' => $admin->id,
        ]);

        $program3 = Program::create([
            'name' => 'Kompetisi Inovasi 2024',
            'description' => 'Bersaing dengan tim dari seluruh Indonesia untuk memecahkan masalah nyata dengan solusi inovatif. Hadiah total puluhan juta rupiah!',
            'syllabus' => '<ul><li>Pendaftaran Tim</li><li>Submission Proposal</li><li>Babak Penyisihan</li><li>Babak Final</li><li>Pitching & Demo</li></ul>',
            'slug' => 'kompetisi-inovasi-2024',
            'type' => 'competition',
            'delivery_type' => 'online_zoom',
            'status' => true,
            'fees' => 0,
            'start_date' => now()->addDays(60),
            'end_date' => now()->addDays(150),
            'creator_id' => $admin->id,
        ]);

        echo "   ✓ 3 programs berhasil dibuat\n\n";

        // ============================================
        // 5. COURSES & MODULES
        // ============================================
        echo "📚 Membuat courses & modules...\n";
        
        // Course 1: HTML & CSS
        $course1 = Course::create([
            'title' => 'Pengenalan HTML & CSS',
            'description' => 'Pelajari dasar-dasar HTML dan CSS untuk membangun halaman web yang indah dan responsif.',
            'program_id' => $program1->id,
            'slug' => 'pengenalan-html-css',
            'order' => 1,
            'is_published' => true,
            'creator_id' => $admin->id,
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Pengenalan HTML',
            'description' => 'Belajar struktur dasar HTML dan elemen-elemen penting',
            'content' => '<p>HTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. Dalam modul ini, Anda akan mempelajari:</p><ul><li>Struktur dasar dokumen HTML</li><li>Tag dan elemen HTML</li><li>Atribut HTML</li><li>Semantic HTML</li></ul>',
            'order' => 1,
            'duration_minutes' => 45,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Styling dengan CSS',
            'description' => 'Membuat tampilan web yang menarik dengan CSS',
            'content' => '<p>CSS (Cascading Style Sheets) digunakan untuk mengatur tampilan halaman web. Pelajari:</p><ul><li>Selector CSS</li><li>Properties dan Values</li><li>Box Model</li><li>Flexbox dan Grid</li></ul>',
            'order' => 2,
            'duration_minutes' => 60,
            'is_published' => true,
        ]);

        // Course 2: JavaScript
        $course2 = Course::create([
            'title' => 'JavaScript Fundamentals',
            'description' => 'Kuasai pemrograman JavaScript dari dasar hingga konsep lanjutan.',
            'program_id' => $program1->id,
            'slug' => 'javascript-fundamentals',
            'order' => 2,
            'is_published' => true,
            'creator_id' => $admin->id,
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Dasar-dasar JavaScript',
            'description' => 'Variabel, tipe data, dan operator',
            'content' => '<p>JavaScript adalah bahasa pemrograman yang membuat web menjadi interaktif. Pelajari:</p><ul><li>Variabel (let, const, var)</li><li>Tipe data</li><li>Operator</li><li>Conditional statements</li></ul>',
            'order' => 1,
            'duration_minutes' => 50,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Functions dan Array',
            'description' => 'Memahami functions dan manipulasi array',
            'content' => '<p>Functions adalah building blocks dalam JavaScript. Pelajari:</p><ul><li>Function declaration</li><li>Arrow functions</li><li>Array methods</li><li>Higher-order functions</li></ul>',
            'order' => 2,
            'duration_minutes' => 60,
            'is_published' => true,
        ]);

        // Course 3: Python untuk Data Science
        $course3 = Course::create([
            'title' => 'Python untuk Data Science',
            'description' => 'Pelajari Python khusus untuk aplikasi data science dan machine learning.',
            'program_id' => $program2->id,
            'slug' => 'python-untuk-data-science',
            'order' => 1,
            'is_published' => true,
            'creator_id' => $admin->id,
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Pengenalan Python',
            'description' => 'Dasar-dasar pemrograman Python',
            'content' => '<p>Python adalah bahasa pemrograman yang powerful dan mudah dipelajari. Pelajari:</p><ul><li>Sintaks dasar Python</li><li>Variabel dan tipe data</li><li>Control flow</li><li>Functions</li></ul>',
            'order' => 1,
            'duration_minutes' => 45,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'NumPy dan Pandas',
            'description' => 'Library fundamental untuk data science',
            'content' => '<p>NumPy dan Pandas adalah library essential untuk data science. Pelajari:</p><ul><li>NumPy arrays</li><li>Pandas DataFrame</li><li>Data manipulation</li><li>Data cleaning</li></ul>',
            'order' => 2,
            'duration_minutes' => 75,
            'is_published' => true,
        ]);

        echo "   ✓ 3 courses dengan 6 modules berhasil dibuat\n\n";

        // ============================================
        // 6. ACADEMY PROGRAMS
        // ============================================
        echo "🎯 Membuat academy programs...\n";
        
        AcademyProgram::create([
            'name' => 'Program Tahfidz Intensif',
            'description' => 'Program menghafal Al-Quran dengan metode yang efektif dan terstruktur. Dibimbing oleh ustadz berpengalaman.',
            'details' => '<ul><li>Durasi: 6 bulan</li><li>Target: 3 Juz</li><li>Pertemuan: 3x seminggu via Zoom</li><li>Muroja\'ah rutin</li><li>Sertifikat kelulusan</li></ul>',
            'slug' => 'program-tahfidz-intensif',
            'whatsapp_group_link' => 'https://chat.whatsapp.com/example-tahfidz',
            'price' => 500000,
            'start_date' => now()->addDays(14),
            'end_date' => now()->addMonths(6),
            'is_active' => true,
            'max_participants' => 30,
        ]);

        AcademyProgram::create([
            'name' => 'Kelas Bahasa Arab Dasar',
            'description' => 'Belajar bahasa Arab dari nol hingga bisa membaca dan memahami teks Arab sederhana.',
            'details' => '<ul><li>Durasi: 3 bulan</li><li>Materi: Nahwu & Shorof dasar</li><li>Pertemuan: 2x seminggu</li><li>Modul lengkap</li><li>Praktek percakapan</li></ul>',
            'slug' => 'kelas-bahasa-arab-dasar',
            'whatsapp_group_link' => 'https://chat.whatsapp.com/example-arabic',
            'price' => 0,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
            'max_participants' => 50,
        ]);

        AcademyProgram::create([
            'name' => 'Kajian Fiqih Kontemporer',
            'description' => 'Membahas masalah-masalah fiqih yang relevan dengan kehidupan modern.',
            'details' => '<ul><li>Durasi: 2 bulan</li><li>Topik: Fiqih muamalah, teknologi, dll</li><li>Pertemuan: 1x seminggu</li><li>Diskusi interaktif</li><li>Materi PDF</li></ul>',
            'slug' => 'kajian-fiqih-kontemporer',
            'whatsapp_group_link' => 'https://chat.whatsapp.com/example-fiqh',
            'price' => 250000,
            'start_date' => now()->addDays(21),
            'end_date' => now()->addMonths(2),
            'is_active' => true,
            'max_participants' => 40,
        ]);

        echo "   ✓ 3 academy programs berhasil dibuat\n\n";

        // ============================================
        // 7. REGISTRATIONS
        // ============================================
        echo "📋 Membuat registrations...\n";
        
        Registration::create([
            'user_id' => $user1->id,
            'program_id' => $program1->id,
            'status' => 'approved',
        ]);

        Registration::create([
            'user_id' => $user2->id,
            'program_id' => $program2->id,
            'status' => 'approved',
        ]);

        Registration::create([
            'user_id' => $user3->id,
            'program_id' => $program1->id,
            'status' => 'pending',
        ]);

        echo "   ✓ 3 registrations berhasil dibuat\n\n";

        // ============================================
        // 8. ACHIEVEMENTS
        // ============================================
        echo "🏆 Membuat achievements...\n";
        
        Achievement::create([
            'user_id' => $user1->id,
            'title' => 'Menyelesaikan Course HTML & CSS',
            'description' => 'Berhasil menyelesaikan seluruh modul dalam course Pengenalan HTML & CSS',
            'order' => 1,
        ]);

        Achievement::create([
            'user_id' => $user2->id,
            'title' => 'Juara 1 Kompetisi Web Design',
            'description' => 'Memenangkan kompetisi web design tingkat nasional 2023',
            'order' => 1,
        ]);

        echo "   ✓ 2 achievements berhasil dibuat\n\n";

        // ============================================
        // 9. GALLERY FOLDERS
        // ============================================
        echo "📁 Membuat gallery folders...\n";
        
        $this->call(GalleryFolderSeeder::class);

        // ============================================
        // SELESAI
        // ============================================
        echo "✅ Seeding database selesai!\n";
        echo "\n📊 Summary:\n";
        echo "   - Users: 4\n";
        echo "   - Categories: 4\n";
        echo "   - Articles: 4\n";
        echo "   - Programs: 3\n";
        echo "   - Courses: 3\n";
        echo "   - Course Modules: 6\n";
        echo "   - Academy Programs: 3\n";
        echo "   - Registrations: 3\n";
        echo "   - Achievements: 2\n";
        echo "   - Gallery Folders: 8\n";
        echo "\n🔐 Login Credentials:\n";
        echo "   Admin: admin@manaahel.com / password\n";
        echo "   User: ahmad@example.com / password\n";
        echo "\n";
    }
}
