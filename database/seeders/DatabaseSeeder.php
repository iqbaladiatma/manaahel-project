<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Program;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Users (password: password)
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@manaahel.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'batch_year' => 2024,
            'latitude' => 21.4225,
            'longitude' => 39.8262,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff',
        ]);

        $user1 = User::factory()->create([
            'name' => 'Ahmad Abdullah',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2024,
            'latitude' => 24.7136,
            'longitude' => 46.6753,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Ahmad+Abdullah&background=8b5cf6&color=fff',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Fatimah Hassan',
            'email' => 'fatimah@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2023,
            'latitude' => 26.4207,
            'longitude' => 50.0888,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Fatimah+Hassan&background=ec4899&color=fff',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Muhammad Ali',
            'email' => 'muhammad@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2024,
            'latitude' => 21.2854,
            'longitude' => 40.4167,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Muhammad+Ali&background=06b6d4&color=fff',
        ]);

        $user4 = User::factory()->create([
            'name' => 'Sarah Ahmed',
            'email' => 'sarah@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2024,
            'latitude' => 25.2048,
            'longitude' => 55.2708,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Sarah+Ahmed&background=f59e0b&color=fff',
        ]);

        $user5 = User::factory()->create([
            'name' => 'Omar Ibrahim',
            'email' => 'omar@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'batch_year' => 2023,
            'latitude' => 30.0444,
            'longitude' => 31.2357,
            'avatar_url' => 'https://ui-avatars.com/api/?name=Omar+Ibrahim&background=10b981&color=fff',
        ]);

        // Create Categories
        $categories = [
            ['name' => ['id' => 'Teknologi', 'en' => 'Technology', 'ar' => 'التكنولوجيا'], 'slug' => 'technology'],
            ['name' => ['id' => 'Pendidikan', 'en' => 'Education', 'ar' => 'التعليم'], 'slug' => 'education'],
            ['name' => ['id' => 'Komunitas', 'en' => 'Community', 'ar' => 'المجتمع'], 'slug' => 'community'],
            ['name' => ['id' => 'Acara', 'en' => 'Events', 'ar' => 'الفعاليات'], 'slug' => 'events'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create Articles
        $articles = [
            [
                'title' => ['id' => 'Selamat Datang di Platform Manaahel', 'en' => 'Welcome to Manaahel Platform', 'ar' => 'مرحبا بكم في منصة مناهل'],
                'content' => ['id' => 'Kami dengan senang hati mengumumkan peluncuran platform baru kami. Platform ini akan menjadi pusat pembelajaran, kolaborasi, dan pembangunan komunitas.', 'en' => 'We are excited to announce the launch of our new platform. This platform will serve as a hub for learning, collaboration, and community building.', 'ar' => 'يسعدنا الإعلان عن إطلاق منصتنا الجديدة. ستكون هذه المنصة مركزًا للتعلم والتعاون وبناء المجتمع.'],
                'slug' => 'welcome-to-manaahel-platform',
                'category_id' => 1,
                'is_featured' => true,
            ],
            [
                'title' => ['id' => 'Program Akademi Baru Diluncurkan', 'en' => 'New Academy Program Launched', 'ar' => 'إطلاق برنامج الأكاديمية الجديد'],
                'content' => ['id' => 'Kami sangat senang memperkenalkan program Akademi baru kami yang dirancang untuk meningkatkan keterampilan dan pengetahuan Anda di berbagai bidang.', 'en' => 'We are thrilled to introduce our new Academy program designed to enhance your skills and knowledge in various fields.', 'ar' => 'يسعدنا تقديم برنامج الأكاديمية الجديد المصمم لتعزيز مهاراتك ومعرفتك في مختلف المجالات.'],
                'slug' => 'new-academy-program-launched',
                'category_id' => 2,
                'is_featured' => true,
            ],
            [
                'title' => ['id' => 'Kesuksesan Pertemuan Komunitas', 'en' => 'Community Meetup Success', 'ar' => 'نجاح لقاء المجتمع'],
                'content' => ['id' => 'Pertemuan komunitas kami baru-baru ini sangat sukses dengan lebih dari 100 peserta dari seluruh dunia.', 'en' => 'Our recent community meetup was a great success with over 100 participants from around the world.', 'ar' => 'كان لقاء مجتمعنا الأخير نجاحًا كبيرًا بمشاركة أكثر من 100 مشارك من جميع أنحاء العالم.'],
                'slug' => 'community-meetup-success',
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['id' => 'Kompetisi Mendatang 2024', 'en' => 'Upcoming Competition 2024', 'ar' => 'المسابقة القادمة 2024'],
                'content' => ['id' => 'Bersiaplah untuk kompetisi tahunan kami! Pendaftaran dibuka bulan depan dengan hadiah dan tantangan yang menarik.', 'en' => 'Get ready for our annual competition! Registration opens next month with exciting prizes and challenges.', 'ar' => 'استعد لمسابقتنا السنوية! سيفتح التسجيل الشهر القادم مع جوائز وتحديات مثيرة.'],
                'slug' => 'upcoming-competition-2024',
                'category_id' => 4,
                'is_featured' => true,
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }

        // Create Programs
        $programs = [
            [
                'name' => ['id' => 'Akademi Pengembangan Web', 'en' => 'Web Development Academy', 'ar' => 'أكاديمية تطوير الويب'],
                'description' => ['id' => 'Pelajari pengembangan web modern dengan HTML, CSS, JavaScript, dan framework populer.', 'en' => 'Learn modern web development with HTML, CSS, JavaScript, and popular frameworks.', 'ar' => 'تعلم تطوير الويب الحديث باستخدام HTML و CSS و JavaScript والأطر الشائعة.'],
                'slug' => 'web-development-academy',
                'type' => 'academy',
                'status' => true,
                'fees' => 299.99,
                'start_date' => now()->addDays(30),
            ],
            [
                'name' => ['id' => 'Bootcamp Ilmu Data', 'en' => 'Data Science Bootcamp', 'ar' => 'معسكر علوم البيانات'],
                'description' => ['id' => 'Kuasai ilmu data, pembelajaran mesin, dan AI dengan proyek praktis.', 'en' => 'Master data science, machine learning, and AI with hands-on projects.', 'ar' => 'أتقن علوم البيانات والتعلم الآلي والذكاء الاصطناعي من خلال مشاريع عملية.'],
                'slug' => 'data-science-bootcamp',
                'type' => 'academy',
                'status' => true,
                'fees' => 499.99,
                'start_date' => now()->addDays(45),
            ],
            [
                'name' => ['id' => 'Tantangan Inovasi 2024', 'en' => 'Innovation Challenge 2024', 'ar' => 'تحدي الابتكار 2024'],
                'description' => ['id' => 'Bersaing dengan tim dari seluruh dunia untuk memecahkan masalah nyata dengan solusi inovatif.', 'en' => 'Compete with teams worldwide to solve real-world problems with innovative solutions.', 'ar' => 'تنافس مع فرق من جميع أنحاء العالم لحل مشاكل العالم الحقيقي بحلول مبتكرة.'],
                'slug' => 'innovation-challenge-2024',
                'type' => 'competition',
                'status' => true,
                'fees' => 0.00,
                'start_date' => now()->addDays(60),
            ],
            [
                'name' => ['id' => 'Pengembangan Aplikasi Mobile', 'en' => 'Mobile App Development', 'ar' => 'تطوير تطبيقات الجوال'],
                'description' => ['id' => 'Bangun aplikasi mobile native dan cross-platform untuk iOS dan Android.', 'en' => 'Build native and cross-platform mobile applications for iOS and Android.', 'ar' => 'قم ببناء تطبيقات الجوال الأصلية ومتعددة المنصات لنظامي iOS و Android.'],
                'slug' => 'mobile-app-development',
                'type' => 'academy',
                'status' => true,
                'fees' => 349.99,
                'start_date' => now()->addDays(50),
            ],
        ];

        foreach ($programs as $programData) {
            Program::create($programData);
        }

        // Create Courses
        $courses = [
            [
                'title' => ['id' => 'Pengenalan HTML & CSS', 'en' => 'Introduction to HTML & CSS', 'ar' => 'مقدمة في HTML و CSS'],
                'content' => ['id' => 'Pelajari dasar-dasar HTML dan CSS untuk membangun halaman web yang indah.', 'en' => 'Learn the basics of HTML and CSS to build beautiful web pages.', 'ar' => 'تعلم أساسيات HTML و CSS لبناء صفحات ويب جميلة.'],
                'program_id' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Dasar-dasar JavaScript', 'en' => 'JavaScript Fundamentals', 'ar' => 'أساسيات JavaScript'],
                'content' => ['id' => 'Kuasai pemrograman JavaScript dari dasar hingga konsep lanjutan.', 'en' => 'Master JavaScript programming from basics to advanced concepts.', 'ar' => 'أتقن برمجة JavaScript من الأساسيات إلى المفاهيم المتقدمة.'],
                'program_id' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Python untuk Ilmu Data', 'en' => 'Python for Data Science', 'ar' => 'Python لعلوم البيانات'],
                'content' => ['id' => 'Pelajari pemrograman Python khusus untuk aplikasi ilmu data.', 'en' => 'Learn Python programming specifically for data science applications.', 'ar' => 'تعلم برمجة Python خصيصًا لتطبيقات علوم البيانات.'],
                'program_id' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Dasar-dasar Pembelajaran Mesin', 'en' => 'Machine Learning Basics', 'ar' => 'أساسيات التعلم الآلي'],
                'content' => ['id' => 'Pengenalan algoritma pembelajaran mesin dan aplikasinya.', 'en' => 'Introduction to machine learning algorithms and their applications.', 'ar' => 'مقدمة في خوارزميات التعلم الآلي وتطبيقاتها.'],
                'program_id' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Pengembangan React Native', 'en' => 'React Native Development', 'ar' => 'تطوير React Native'],
                'content' => ['id' => 'Bangun aplikasi mobile cross-platform dengan React Native.', 'en' => 'Build cross-platform mobile apps with React Native.', 'ar' => 'قم ببناء تطبيقات الجوال متعددة المنصات باستخدام React Native.'],
                'program_id' => 4,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        // Create Registrations
        Registration::create([
            'user_id' => $user1->id,
            'program_id' => 1,
            'status' => 'approved',
        ]);

        Registration::create([
            'user_id' => $user2->id,
            'program_id' => 2,
            'status' => 'approved',
        ]);

        Registration::create([
            'user_id' => $user3->id,
            'program_id' => 1,
            'status' => 'pending',
        ]);

        Registration::create([
            'user_id' => $user4->id,
            'program_id' => 3,
            'status' => 'approved',
        ]);

        Registration::create([
            'user_id' => $user5->id,
            'program_id' => 4,
            'status' => 'approved',
        ]);

        // Create Gallery Items
        $galleries = [
            [
                'title' => 'Community Event 2024',
                'file_path' => 'https://picsum.photos/800/600?random=1',
                'batch_filter' => null,
                'visibility' => 'public',
            ],
            [
                'title' => 'Workshop Session',
                'file_path' => 'https://picsum.photos/800/600?random=2',
                'batch_filter' => null,
                'visibility' => 'public',
            ],
            [
                'title' => 'Team Building Activity',
                'file_path' => 'https://picsum.photos/800/600?random=3',
                'batch_filter' => 2024,
                'visibility' => 'member_only',
            ],
            [
                'title' => 'Graduation Ceremony',
                'file_path' => 'https://picsum.photos/800/600?random=4',
                'batch_filter' => 2023,
                'visibility' => 'member_only',
            ],
            [
                'title' => 'Hackathon Winners',
                'file_path' => 'https://picsum.photos/800/600?random=5',
                'batch_filter' => null,
                'visibility' => 'public',
            ],
            [
                'title' => 'Annual Conference',
                'file_path' => 'https://picsum.photos/800/600?random=6',
                'batch_filter' => null,
                'visibility' => 'public',
            ],
        ];

        foreach ($galleries as $galleryData) {
            Gallery::create($galleryData);
        }

        $this->command->info('Database seeded successfully!');
    }
}
