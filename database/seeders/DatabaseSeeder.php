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
                'content' => ['id' => 'Kami dengan senang hati mengumumkan peluncuran platform baru kami. Platform ini akan menjadi pusat pembelajaran, kolaborasi, dan pembangunan komunitas. Bergabunglah dengan kami dalam perjalanan transformasi pendidikan dan pengembangan diri.', 'en' => 'We are excited to announce the launch of our new platform. This platform will serve as a hub for learning, collaboration, and community building. Join us in this journey of educational transformation and personal development.', 'ar' => 'يسعدنا الإعلان عن إطلاق منصتنا الجديدة. ستكون هذه المنصة مركزًا للتعلم والتعاون وبناء المجتمع. انضم إلينا في هذه الرحلة من التحول التعليمي والتطوير الشخصي.'],
                'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop',
                'slug' => 'welcome-to-manaahel-platform',
                'category_id' => 1,
                'is_featured' => true,
            ],
            [
                'title' => ['id' => 'Program Akademi Baru Diluncurkan', 'en' => 'New Academy Program Launched', 'ar' => 'إطلاق برنامج الأكاديمية الجديد'],
                'content' => ['id' => 'Kami sangat senang memperkenalkan program Akademi baru kami yang dirancang untuk meningkatkan keterampilan dan pengetahuan Anda di berbagai bidang. Program ini mencakup pembelajaran interaktif, proyek praktis, dan bimbingan dari para ahli industri.', 'en' => 'We are thrilled to introduce our new Academy program designed to enhance your skills and knowledge in various fields. This program includes interactive learning, hands-on projects, and mentorship from industry experts.', 'ar' => 'يسعدنا تقديم برنامج الأكاديمية الجديد المصمم لتعزيز مهاراتك ومعرفتك في مختلف المجالات. يتضمن هذا البرنامج التعلم التفاعلي والمشاريع العملية والإرشاد من خبراء الصناعة.'],
                'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&h=600&fit=crop',
                'slug' => 'new-academy-program-launched',
                'category_id' => 2,
                'is_featured' => true,
            ],
            [
                'title' => ['id' => 'Kesuksesan Pertemuan Komunitas', 'en' => 'Community Meetup Success', 'ar' => 'نجاح لقاء المجتمع'],
                'content' => ['id' => 'Pertemuan komunitas kami baru-baru ini sangat sukses dengan lebih dari 100 peserta dari seluruh dunia. Acara ini menampilkan sesi networking, workshop, dan berbagi pengalaman yang menginspirasi dari para anggota komunitas.', 'en' => 'Our recent community meetup was a great success with over 100 participants from around the world. The event featured networking sessions, workshops, and inspiring experience sharing from community members.', 'ar' => 'كان لقاء مجتمعنا الأخير نجاحًا كبيرًا بمشاركة أكثر من 100 مشارك من جميع أنحاء العالم. تضمن الحدث جلسات التواصل وورش العمل ومشاركة التجارب الملهمة من أعضاء المجتمع.'],
                'image_url' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                'slug' => 'community-meetup-success',
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['id' => 'Kompetisi Mendatang 2024', 'en' => 'Upcoming Competition 2024', 'ar' => 'المسابقة القادمة 2024'],
                'content' => ['id' => 'Bersiaplah untuk kompetisi tahunan kami! Pendaftaran dibuka bulan depan dengan hadiah dan tantangan yang menarik. Ini adalah kesempatan sempurna untuk menunjukkan keterampilan Anda dan bersaing dengan talenta terbaik dari seluruh dunia.', 'en' => 'Get ready for our annual competition! Registration opens next month with exciting prizes and challenges. This is the perfect opportunity to showcase your skills and compete with the best talents from around the world.', 'ar' => 'استعد لمسابقتنا السنوية! سيفتح التسجيل الشهر القادم مع جوائز وتحديات مثيرة. هذه فرصة مثالية لعرض مهاراتك والتنافس مع أفضل المواهب من جميع أنحاء العالم.'],
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
                'slug' => 'upcoming-competition-2024',
                'category_id' => 4,
                'is_featured' => true,
            ],
            [
                'title' => ['id' => 'Tips Belajar Efektif untuk Pemula', 'en' => 'Effective Learning Tips for Beginners', 'ar' => 'نصائح التعلم الفعال للمبتدئين'],
                'content' => ['id' => 'Memulai perjalanan belajar bisa menantang. Berikut adalah beberapa tips yang telah terbukti membantu ribuan pelajar mencapai tujuan mereka. Konsistensi adalah kunci, dan kami di sini untuk mendukung Anda di setiap langkah.', 'en' => 'Starting your learning journey can be challenging. Here are some proven tips that have helped thousands of learners achieve their goals. Consistency is key, and we are here to support you every step of the way.', 'ar' => 'يمكن أن يكون بدء رحلة التعلم الخاصة بك أمرًا صعبًا. إليك بعض النصائح المثبتة التي ساعدت الآلاف من المتعلمين على تحقيق أهدافهم. الاتساق هو المفتاح، ونحن هنا لدعمك في كل خطوة.'],
                'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&h=600&fit=crop',
                'slug' => 'effective-learning-tips-for-beginners',
                'category_id' => 2,
                'is_featured' => false,
            ],
            [
                'title' => ['id' => 'Teknologi Terbaru dalam Pendidikan', 'en' => 'Latest Technology in Education', 'ar' => 'أحدث التقنيات في التعليم'],
                'content' => ['id' => 'Dunia pendidikan terus berkembang dengan teknologi baru. Dari AI hingga VR, mari kita jelajahi bagaimana teknologi mengubah cara kita belajar dan mengajar. Platform kami mengintegrasikan teknologi terkini untuk pengalaman belajar yang optimal.', 'en' => 'The world of education continues to evolve with new technology. From AI to VR, let\'s explore how technology is transforming the way we learn and teach. Our platform integrates the latest technology for an optimal learning experience.', 'ar' => 'يستمر عالم التعليم في التطور مع التكنولوجيا الجديدة. من الذكاء الاصطناعي إلى الواقع الافتراضي، دعونا نستكشف كيف تغير التكنولوجيا الطريقة التي نتعلم ونعلم بها. تدمج منصتنا أحدث التقنيات لتجربة تعليمية مثالية.'],
                'image_url' => 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=800&h=600&fit=crop',
                'slug' => 'latest-technology-in-education',
                'category_id' => 1,
                'is_featured' => false,
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
                'description' => ['id' => 'Pelajari dasar-dasar HTML dan CSS.', 'en' => 'Learn HTML & CSS basics.', 'ar' => 'تعلم أساسيات HTML و CSS.'],
                'program_id' => 1,
                'slug' => 'intro-html-css',
                'module_content' => ['id' => 'Pelajari dasar-dasar HTML dan CSS untuk membangun halaman web yang indah.', 'en' => 'Learn the basics of HTML and CSS to build beautiful web pages.', 'ar' => 'تعلم أساسيات HTML و CSS لبناء صفحات ويب جميلة.'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Dasar-dasar JavaScript', 'en' => 'JavaScript Fundamentals', 'ar' => 'أساسيات JavaScript'],
                'description' => ['id' => 'Kuasai pemrograman JavaScript.', 'en' => 'Master JavaScript programming.', 'ar' => 'أتقن برمجة JavaScript.'],
                'program_id' => 1,
                'slug' => 'js-fundamentals',
                'module_content' => ['id' => 'Kuasai pemrograman JavaScript dari dasar hingga konsep lanjutan.', 'en' => 'Master JavaScript programming from basics to advanced concepts.', 'ar' => 'أتقن برمجة JavaScript من الأساسيات إلى المفاهيم المتقدمة.'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Python untuk Ilmu Data', 'en' => 'Python for Data Science', 'ar' => 'Python لعلوم البيانات'],
                'description' => ['id' => 'Pelajari Python untuk Data Science.', 'en' => 'Learn Python for Data Science.', 'ar' => 'تعلم Python لعلوم البيانات.'],
                'program_id' => 2,
                'slug' => 'python-data-science',
                'module_content' => ['id' => 'Pelajari pemrograman Python khusus untuk aplikasi ilmu data.', 'en' => 'Learn Python programming specifically for data science applications.', 'ar' => 'تعلم برمجة Python خصيصًا لتطبيقات علوم البيانات.'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Dasar-dasar Pembelajaran Mesin', 'en' => 'Machine Learning Basics', 'ar' => 'أساسيات التعلم الآلي'],
                'description' => ['id' => 'Pengenalan Machine Learning.', 'en' => 'Introduction to Machine Learning.', 'ar' => 'مقدمة في التعلم الآلي.'],
                'program_id' => 2,
                'slug' => 'ml-basics',
                'module_content' => ['id' => 'Pengenalan algoritma pembelajaran mesin dan aplikasinya.', 'en' => 'Introduction to machine learning algorithms and their applications.', 'ar' => 'مقدمة في خوارزميات التعلم الآلي وتطبيقاتها.'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => ['id' => 'Pengembangan React Native', 'en' => 'React Native Development', 'ar' => 'تطوير React Native'],
                'description' => ['id' => 'Bangun aplikasi mobile dengan React Native.', 'en' => 'Build mobile apps with React Native.', 'ar' => 'قم ببناء تطبيقات الجوال باستخدام React Native.'],
                'program_id' => 4,
                'slug' => 'react-native-dev',
                'module_content' => ['id' => 'Bangun aplikasi mobile cross-platform dengan React Native.', 'en' => 'Build cross-platform mobile apps with React Native.', 'ar' => 'قم ببناء تطبيقات الجوال متعددة المنصات باستخدام React Native.'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
        ];

        foreach ($courses as $courseData) {
            $moduleContent = $courseData['module_content'];
            $videoUrl = $courseData['video_url'];
            
            unset($courseData['module_content']);
            unset($courseData['video_url']);
            
            $course = Course::create($courseData);

            // Create multiple modules for each course
            if ($course->slug === 'python-data-science') {
                // Python for Data Science - Multiple modules
                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Pengenalan Python', 'en' => 'Introduction to Python', 'ar' => 'مقدمة في Python'],
                    'description' => ['id' => 'Pelajari dasar-dasar pemrograman Python', 'en' => 'Learn Python programming basics', 'ar' => 'تعلم أساسيات برمجة Python'],
                    'content' => ['id' => 'Dalam modul ini, Anda akan mempelajari sintaks dasar Python, variabel, tipe data, dan struktur kontrol. Python adalah bahasa pemrograman yang powerful dan mudah dipelajari untuk data science.', 'en' => 'In this module, you will learn basic Python syntax, variables, data types, and control structures. Python is a powerful and easy-to-learn programming language for data science.', 'ar' => 'في هذه الوحدة، ستتعلم بناء جملة Python الأساسي والمتغيرات وأنواع البيانات وهياكل التحكم. Python هي لغة برمجة قوية وسهلة التعلم لعلوم البيانات.'],
                    'video_url' => 'https://www.youtube.com/watch?v=rfscVS0vtbw',
                    'duration_minutes' => 45,
                    'order' => 1,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'NumPy dan Array', 'en' => 'NumPy and Arrays', 'ar' => 'NumPy والمصفوفات'],
                    'description' => ['id' => 'Bekerja dengan NumPy untuk komputasi numerik', 'en' => 'Working with NumPy for numerical computing', 'ar' => 'العمل مع NumPy للحوسبة الرقمية'],
                    'content' => ['id' => 'NumPy adalah library fundamental untuk komputasi ilmiah di Python. Pelajari cara membuat dan memanipulasi array, melakukan operasi matematika, dan menggunakan fungsi NumPy untuk analisis data.', 'en' => 'NumPy is a fundamental library for scientific computing in Python. Learn how to create and manipulate arrays, perform mathematical operations, and use NumPy functions for data analysis.', 'ar' => 'NumPy هي مكتبة أساسية للحوسبة العلمية في Python. تعلم كيفية إنشاء ومعالجة المصفوفات وإجراء العمليات الرياضية واستخدام وظائف NumPy لتحليل البيانات.'],
                    'video_url' => 'https://www.youtube.com/watch?v=QUT1VHiLmmI',
                    'duration_minutes' => 60,
                    'order' => 2,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Pandas untuk Analisis Data', 'en' => 'Pandas for Data Analysis', 'ar' => 'Pandas لتحليل البيانات'],
                    'description' => ['id' => 'Manipulasi dan analisis data dengan Pandas', 'en' => 'Data manipulation and analysis with Pandas', 'ar' => 'معالجة وتحليل البيانات باستخدام Pandas'],
                    'content' => ['id' => 'Pandas adalah library Python yang powerful untuk manipulasi dan analisis data. Pelajari DataFrame, Series, membaca data dari berbagai sumber, cleaning data, dan melakukan analisis eksploratori.', 'en' => 'Pandas is a powerful Python library for data manipulation and analysis. Learn about DataFrames, Series, reading data from various sources, data cleaning, and performing exploratory analysis.', 'ar' => 'Pandas هي مكتبة Python قوية لمعالجة وتحليل البيانات. تعلم عن DataFrames و Series وقراءة البيانات من مصادر مختلفة وتنظيف البيانات وإجراء التحليل الاستكشافي.'],
                    'video_url' => 'https://www.youtube.com/watch?v=vmEHCJofslg',
                    'duration_minutes' => 75,
                    'order' => 3,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Visualisasi Data dengan Matplotlib', 'en' => 'Data Visualization with Matplotlib', 'ar' => 'تصور البيانات باستخدام Matplotlib'],
                    'description' => ['id' => 'Membuat visualisasi data yang menarik', 'en' => 'Creating compelling data visualizations', 'ar' => 'إنشاء تصورات بيانات مقنعة'],
                    'content' => ['id' => 'Visualisasi adalah kunci untuk memahami data. Pelajari cara membuat berbagai jenis plot dengan Matplotlib: line plots, bar charts, scatter plots, histograms, dan lebih banyak lagi.', 'en' => 'Visualization is key to understanding data. Learn how to create various types of plots with Matplotlib: line plots, bar charts, scatter plots, histograms, and more.', 'ar' => 'التصور هو مفتاح فهم البيانات. تعلم كيفية إنشاء أنواع مختلفة من الرسوم البيانية باستخدام Matplotlib: الرسوم البيانية الخطية والرسوم البيانية الشريطية والرسوم البيانية المبعثرة والرسوم البيانية التكرارية والمزيد.'],
                    'video_url' => 'https://www.youtube.com/watch?v=3Xc3CA655Y4',
                    'duration_minutes' => 50,
                    'order' => 4,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Statistik untuk Data Science', 'en' => 'Statistics for Data Science', 'ar' => 'الإحصاء لعلوم البيانات'],
                    'description' => ['id' => 'Konsep statistik penting untuk analisis data', 'en' => 'Important statistical concepts for data analysis', 'ar' => 'المفاهيم الإحصائية المهمة لتحليل البيانات'],
                    'content' => ['id' => 'Memahami statistik adalah fundamental dalam data science. Pelajari descriptive statistics, probability distributions, hypothesis testing, dan correlation analysis.', 'en' => 'Understanding statistics is fundamental in data science. Learn about descriptive statistics, probability distributions, hypothesis testing, and correlation analysis.', 'ar' => 'فهم الإحصاء أمر أساسي في علوم البيانات. تعلم عن الإحصاء الوصفي وتوزيعات الاحتمالات واختبار الفرضيات وتحليل الارتباط.'],
                    'video_url' => null,
                    'duration_minutes' => 90,
                    'order' => 5,
                    'is_published' => true,
                ]);
            } elseif ($course->slug === 'js-fundamentals') {
                // JavaScript Fundamentals - Multiple modules
                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Pengenalan JavaScript', 'en' => 'Introduction to JavaScript', 'ar' => 'مقدمة في JavaScript'],
                    'description' => ['id' => 'Dasar-dasar JavaScript dan sintaks', 'en' => 'JavaScript basics and syntax', 'ar' => 'أساسيات JavaScript وبناء الجملة'],
                    'content' => ['id' => 'JavaScript adalah bahasa pemrograman yang membuat web menjadi interaktif. Pelajari variabel, tipe data, operator, dan struktur dasar JavaScript.', 'en' => 'JavaScript is the programming language that makes the web interactive. Learn about variables, data types, operators, and basic JavaScript structures.', 'ar' => 'JavaScript هي لغة البرمجة التي تجعل الويب تفاعليًا. تعلم عن المتغيرات وأنواع البيانات والعوامل والهياكل الأساسية لـ JavaScript.'],
                    'video_url' => 'https://www.youtube.com/watch?v=W6NZfCO5SIk',
                    'duration_minutes' => 50,
                    'order' => 1,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Functions dan Scope', 'en' => 'Functions and Scope', 'ar' => 'الوظائف والنطاق'],
                    'description' => ['id' => 'Memahami functions dan scope di JavaScript', 'en' => 'Understanding functions and scope in JavaScript', 'ar' => 'فهم الوظائف والنطاق في JavaScript'],
                    'content' => ['id' => 'Functions adalah building blocks dalam JavaScript. Pelajari cara membuat functions, parameter, return values, arrow functions, dan konsep scope.', 'en' => 'Functions are the building blocks in JavaScript. Learn how to create functions, parameters, return values, arrow functions, and the concept of scope.', 'ar' => 'الوظائف هي اللبنات الأساسية في JavaScript. تعلم كيفية إنشاء الوظائف والمعلمات وقيم الإرجاع ووظائف الأسهم ومفهوم النطاق.'],
                    'video_url' => 'https://www.youtube.com/watch?v=N8ap4k_1QEQ',
                    'duration_minutes' => 60,
                    'order' => 2,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'Arrays dan Objects', 'en' => 'Arrays and Objects', 'ar' => 'المصفوفات والكائنات'],
                    'description' => ['id' => 'Bekerja dengan struktur data kompleks', 'en' => 'Working with complex data structures', 'ar' => 'العمل مع هياكل البيانات المعقدة'],
                    'content' => ['id' => 'Arrays dan Objects adalah struktur data fundamental di JavaScript. Pelajari cara membuat, mengakses, dan memanipulasi arrays dan objects.', 'en' => 'Arrays and Objects are fundamental data structures in JavaScript. Learn how to create, access, and manipulate arrays and objects.', 'ar' => 'المصفوفات والكائنات هي هياكل بيانات أساسية في JavaScript. تعلم كيفية إنشاء والوصول ومعالجة المصفوفات والكائنات.'],
                    'video_url' => 'https://www.youtube.com/watch?v=R8rmfD9Y5-c',
                    'duration_minutes' => 70,
                    'order' => 3,
                    'is_published' => true,
                ]);

                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => ['id' => 'DOM Manipulation', 'en' => 'DOM Manipulation', 'ar' => 'معالجة DOM'],
                    'description' => ['id' => 'Memanipulasi elemen HTML dengan JavaScript', 'en' => 'Manipulating HTML elements with JavaScript', 'ar' => 'معالجة عناصر HTML باستخدام JavaScript'],
                    'content' => ['id' => 'Document Object Model (DOM) memungkinkan JavaScript berinteraksi dengan HTML. Pelajari cara memilih, mengubah, dan membuat elemen HTML secara dinamis.', 'en' => 'The Document Object Model (DOM) allows JavaScript to interact with HTML. Learn how to select, modify, and create HTML elements dynamically.', 'ar' => 'يسمح نموذج كائن المستند (DOM) لـ JavaScript بالتفاعل مع HTML. تعلم كيفية تحديد وتعديل وإنشاء عناصر HTML ديناميكيًا.'],
                    'video_url' => 'https://www.youtube.com/watch?v=5fb2aPlgoys',
                    'duration_minutes' => 65,
                    'order' => 4,
                    'is_published' => true,
                ]);
            } else {
                // Default single module for other courses
                \App\Models\CourseModule::create([
                    'course_id' => $course->id,
                    'title' => $courseData['title'],
                    'description' => $courseData['description'],
                    'content' => $moduleContent,
                    'video_url' => $videoUrl,
                    'duration_minutes' => 60,
                    'order' => 1,
                    'is_published' => true,
                ]);
            }
        }

        // Call ArabicProgramSeeder
        $this->call(ArabicProgramSeeder::class);

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

        // Call Test Seeders
        $this->call([
            TestUserSeeder::class,
            TestRegistrationSeeder::class,
        ]);

        $this->command->info('Database seeded successfully!');
    }
}
