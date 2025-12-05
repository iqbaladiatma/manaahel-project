<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\ProgramSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArabicProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Program 1: Kitab Jurumiyah (Online Course)
        $jurumiyah = Program::create([
            'name' => [
                'ar' => 'متن الآجرومية',
                'id' => 'Kitab Jurumiyah',
                'en' => 'Al-Jurumiyah Book'
            ],
            'slug' => 'kitab-jurumiyah',
            'type' => 'academy',
            'status' => true,
            'description' => [
                'ar' => 'كتاب الآجرومية هو أحد أشهر الكتب في النحو العربي للمبتدئين، ألفه ابن آجروم المغربي. يتناول هذا الكتاب أساسيات النحو العربي بطريقة مبسطة ومنظمة.',
                'id' => 'Kitab Jurumiyah adalah salah satu kitab nahwu paling terkenal untuk pemula, ditulis oleh Ibnu Ajurrum al-Maghribi. Kitab ini membahas dasar-dasar nahwu Arab dengan cara yang sederhana dan terstruktur.',
                'en' => 'Al-Jurumiyah is one of the most famous books in Arabic grammar for beginners, written by Ibn Ajurrum al-Maghribi. This book covers the basics of Arabic grammar in a simple and structured way.'
            ],
            'syllabus' => [
                'ar' => "المحتويات:\n1. الكلام وأنواعه\n2. الإعراب والبناء\n3. علامات الإعراب\n4. المعربات\n5. الأفعال الخمسة\n6. الأسماء الستة\n7. جمع التكسير والمؤنث السالم\n8. الممنوع من الصرف\n9. الفاعل والمفعول به\n10. المبتدأ والخبر",
                'id' => "Isi Pembelajaran:\n1. Kalam dan Jenisnya\n2. I'rab dan Bina'\n3. Tanda-tanda I'rab\n4. Kata-kata yang di-I'rab\n5. Af'al Khamsah (5 fi'il)\n6. Asma' Sittah (6 isim)\n7. Jamak Taksir dan Muannats Salim\n8. Isim yang Dilarang dari Tanwin\n9. Fa'il dan Maf'ul Bih\n10. Mubtada' dan Khabar",
                'en' => "Contents:\n1. Speech and Its Types\n2. Declension and Indeclinable\n3. Signs of Declension\n4. Declinable Words\n5. The Five Verbs\n6. The Six Nouns\n7. Broken Plural and Sound Feminine Plural\n8. Diptote\n9. Subject and Object\n10. Subject and Predicate"
            ],
            'fees' => 250000,
            'start_date' => now()->addDays(7),
            'delivery_type' => 'online_course',
            'meeting_link' => null,
        ]);

        // Course 1.1: Pengenalan Nahwu
        $course1 = Course::create([
            'program_id' => $jurumiyah->id,
            'title' => [
                'ar' => 'مقدمة في علم النحو',
                'id' => 'Pengenalan Ilmu Nahwu',
                'en' => 'Introduction to Arabic Grammar'
            ],
            'description' => [
                'ar' => 'تعريف علم النحو وأهميته وأقسام الكلام',
                'id' => 'Definisi ilmu nahwu, kepentingannya, dan pembagian kalam',
                'en' => 'Definition of grammar, its importance, and divisions of speech'
            ],
            'slug' => 'pengenalan-nahwu',
            'order' => 1,
            'is_published' => true,
        ]);

        // Modules for Course 1.1
        CourseModule::create([
            'course_id' => $course1->id,
            'title' => ['ar' => 'ما هو علم النحو؟', 'id' => 'Apa itu Ilmu Nahwu?', 'en' => 'What is Grammar?'],
            'description' => ['ar' => 'التعريف بعلم النحو وفوائده', 'id' => 'Pengenalan ilmu nahwu dan manfaatnya', 'en' => 'Introduction to grammar and its benefits'],
            'content' => ['ar' => '<p>علم النحو هو علم يبحث في أحوال أواخر الكلم إعرابا وبناء.</p>', 'id' => '<p>Ilmu nahwu adalah ilmu yang membahas tentang keadaan akhir kata dari segi i\'rab dan bina\'.</p>', 'en' => '<p>Grammar is the science that studies the states of word endings in terms of declension and indeclinability.</p>'],
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 15,
            'order' => 1,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => ['ar' => 'أقسام الكلام', 'id' => 'Pembagian Kalam', 'en' => 'Divisions of Speech'],
            'description' => ['ar' => 'الاسم والفعل والحرف', 'id' => 'Isim, Fi\'il, dan Huruf', 'en' => 'Noun, Verb, and Particle'],
            'content' => ['ar' => '<p>الكلام ثلاثة أقسام: اسم وفعل وحرف.</p><ul><li>الاسم: ما دل على معنى في نفسه غير مقترن بزمان</li><li>الفعل: ما دل على معنى في نفسه مقترن بزمان</li><li>الحرف: ما لا يدل على معنى في نفسه</li></ul>', 'id' => '<p>Kalam terbagi menjadi 3 bagian: Isim, Fi\'il, dan Huruf.</p><ul><li>Isim: kata yang menunjukkan makna pada dirinya sendiri tanpa dikaitkan dengan waktu</li><li>Fi\'il: kata yang menunjukkan makna pada dirinya sendiri yang dikaitkan dengan waktu</li><li>Huruf: kata yang tidak menunjukkan makna pada dirinya sendiri</li></ul>', 'en' => '<p>Speech is divided into 3 parts: Noun, Verb, and Particle.</p><ul><li>Noun: a word that indicates meaning in itself without being associated with time</li><li>Verb: a word that indicates meaning in itself associated with time</li><li>Particle: a word that does not indicate meaning in itself</li></ul>'],
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 20,
            'order' => 2,
            'is_published' => true,
        ]);

        // Course 1.2: I'rab dan Bina'
        $course2 = Course::create([
            'program_id' => $jurumiyah->id,
            'title' => [
                'ar' => 'الإعراب والبناء',
                'id' => 'I\'rab dan Bina\'',
                'en' => 'Declension and Indeclinability'
            ],
            'description' => [
                'ar' => 'فهم الفرق بين الإعراب والبناء وعلاماتهما',
                'id' => 'Memahami perbedaan antara i\'rab dan bina\' serta tanda-tandanya',
                'en' => 'Understanding the difference between declension and indeclinability and their signs'
            ],
            'slug' => 'irab-dan-bina',
            'order' => 2,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => ['ar' => 'تعريف الإعراب', 'id' => 'Definisi I\'rab', 'en' => 'Definition of Declension'],
            'description' => ['ar' => 'ما هو الإعراب وأنواعه', 'id' => 'Apa itu i\'rab dan jenisnya', 'en' => 'What is declension and its types'],
            'content' => ['ar' => '<p>الإعراب: تغيير أواخر الكلم لاختلاف العوامل الداخلة عليها لفظا أو تقديرا.</p><p>أنواع الإعراب أربعة: الرفع، النصب، الجر، الجزم.</p>', 'id' => '<p>I\'rab: perubahan akhir kata karena perbedaan \'amil (kata pengubah) yang masuk padanya baik secara lafal maupun takdir.</p><p>Jenis i\'rab ada 4: Rafa\', Nashab, Jar, Jazam.</p>', 'en' => '<p>Declension: the change of word endings due to different operators entering them, either explicitly or implicitly.</p><p>Types of declension are four: nominative, accusative, genitive, jussive.</p>'],
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 25,
            'order' => 1,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => ['ar' => 'علامات الإعراب الأصلية', 'id' => 'Tanda I\'rab Asli', 'en' => 'Original Signs of Declension'],
            'description' => ['ar' => 'الضمة والفتحة والكسرة والسكون', 'id' => 'Dhammah, Fathah, Kasrah, dan Sukun', 'en' => 'Dhamma, Fatha, Kasra, and Sukoon'],
            'content' => ['ar' => '<p>علامات الإعراب الأصلية:</p><ul><li>للرفع: الضمة</li><li>للنصب: الفتحة</li><li>للجر: الكسرة</li><li>للجزم: السكون</li></ul>', 'id' => '<p>Tanda-tanda i\'rab asli:</p><ul><li>Untuk rafa\': dhammah</li><li>Untuk nashab: fathah</li><li>Untuk jar: kasrah</li><li>Untuk jazam: sukun</li></ul>', 'en' => '<p>Original signs of declension:</p><ul><li>For nominative: dhamma</li><li>For accusative: fatha</li><li>For genitive: kasra</li><li>For jussive: sukoon</li></ul>'],
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 30,
            'order' => 2,
            'is_published' => true,
        ]);

        // Program 2: Kitab Amtsilah Tasrifiyyah (Online Zoom)
        $amtsilah = Program::create([
            'name' => [
                'ar' => 'الأمثلة التصريفية',
                'id' => 'Kitab Amtsilah Tasrifiyyah',
                'en' => 'Amtsilah Tasrifiyyah Book'
            ],
            'slug' => 'kitab-amtsilah-tasrifiyyah',
            'type' => 'academy',
            'status' => true,
            'description' => [
                'ar' => 'كتاب الأمثلة التصريفية هو كتاب مهم في علم الصرف، يتناول تصريف الأفعال والأسماء في اللغة العربية بطريقة منهجية.',
                'id' => 'Kitab Amtsilah Tasrifiyyah adalah kitab penting dalam ilmu sharaf yang membahas tentang tashrif (perubahan) kata kerja dan kata benda dalam bahasa Arab secara metodis.',
                'en' => 'Amtsilah Tasrifiyyah is an important book in morphology that discusses the conjugation of verbs and nouns in Arabic in a methodical way.'
            ],
            'syllabus' => [
                'ar' => "المحتويات:\n1. تصريف الفعل الثلاثي المجرد\n2. تصريف الفعل الثلاثي المزيد\n3. المشتقات: اسم الفاعل واسم المفعول\n4. الصفة المشبهة واسم التفضيل\n5. المصادر وأنواعها\n6. اسم الزمان واسم المكان\n7. اسم الآلة\n8. التصغير",
                'id' => "Isi Pembelajaran:\n1. Tashrif Fi'il Tsulasi Mujarrad\n2. Tashrif Fi'il Tsulasi Mazid\n3. Musytaqat: Isim Fa'il dan Isim Maf'ul\n4. Shifat Musyabbahah dan Isim Tafdhil\n5. Mashdar dan Jenisnya\n6. Isim Zaman dan Isim Makan\n7. Isim Alat\n8. Tashghir",
                'en' => "Contents:\n1. Conjugation of Tri-literal Root Verb\n2. Conjugation of Augmented Tri-literal Verb\n3. Derivatives: Active and Passive Participles\n4. Quasi-Adjective and Comparative\n5. Verbal Nouns and Their Types\n6. Noun of Time and Place\n7. Noun of Instrument\n8. Diminutive"
            ],
            'fees' => 300000,
            'start_date' => now()->addDays(14),
            'delivery_type' => 'online_zoom',
            'meeting_link' => 'https://zoom.us/j/123456789',
        ]);

        // Create schedules for Amtsilah program
        // Create schedules for Amtsilah program
        for ($i = 0; $i < 8; $i++) {
            // Set first session to today for testing attendance
            $scheduledAt = $i === 0 ? now()->setTime(19, 0) : now()->addDays(14 + ($i * 7))->setTime(19, 0);
            
            ProgramSchedule::create([
                'program_id' => $amtsilah->id,
                'title' => [
                    'ar' => 'الدرس ' . ($i + 1),
                    'id' => 'Pertemuan ' . ($i + 1),
                    'en' => 'Session ' . ($i + 1)
                ],
                'description' => [
                    'ar' => 'شرح وتطبيق الدرس ' . ($i + 1),
                    'id' => 'Pembelajaran dan aplikasi pertemuan ' . ($i + 1),
                    'en' => 'Explanation and application of session ' . ($i + 1)
                ],
                'meeting_link' => 'https://zoom.us/j/123456789',
                'scheduled_at' => $scheduledAt,
                'duration_minutes' => 90,
                'attendance_enabled' => $i === 0, // Enable for first session only
            ]);
        }

        // Program 3: Qawaid Fiqhiyyah (Online Course)
        $qawaid = Program::create([
            'name' => [
                'ar' => 'القواعد الفقهية',
                'id' => 'Qawaid Fiqhiyyah',
                'en' => 'Islamic Legal Maxims'
            ],
            'slug' => 'qawaid-fiqhiyyah',
            'type' => 'academy',
            'status' => true,
            'description' => [
                'ar' => 'دراسة القواعد الفقهية الكبرى والقواعد المتفرعة منها، وهي أصول جامعة في الفقه الإسلامي.',
                'id' => 'Mempelajari qawaid (kaidah-kaidah) fiqih yang besar dan kaidah-kaidah yang bercabang darinya, yang merupakan prinsip-prinsip umum dalam fiqih Islam.',
                'en' => 'Studying the major Islamic legal maxims and their derivative rules, which are comprehensive principles in Islamic jurisprudence.'
            ],
            'syllabus' => [
                'ar' => "المحتويات:\n1. الأمور بمقاصدها\n2. اليقين لا يزول بالشك\n3. المشقة تجلب التيسير\n4. الضرر يزال\n5. العادة محكمة",
                'id' => "Isi Pembelajaran:\n1. Al-Umuru bi Maqashidiha (Segala perkara tergantung niatnya)\n2. Al-Yaqinu la Yazulu bi asy-Syakk (Keyakinan tidak bisa dihilangkan dengan keraguan)\n3. Al-Masyaqqatu Tajlibu at-Taysir (Kesulitan mendatangkan kemudahan)\n4. Ad-Dhararu Yuzal (Bahaya harus dihilangkan)\n5. Al-'Adatu Muhakkamah (Adat/kebiasaan bisa menjadi hukum)",
                'en' => "Contents:\n1. Matters are Determined by Intentions\n2. Certainty is not Removed by Doubt\n3. Hardship Brings Ease\n4. Harm Must be Removed\n5. Custom is a Basis for Judgment"
            ],
            'fees' => 350000,
            'start_date' => now()->addDays(21),
            'delivery_type' => 'online_course',
            'meeting_link' => null,
        ]);

        $course3 = Course::create([
            'program_id' => $qawaid->id,
            'title' => [
                'ar' => 'القواعد الخمس الكبرى',
                'id' => 'Lima Kaidah Besar',
                'en' => 'The Five Major Maxims'
            ],
            'description' => [
                'ar' => 'دراسة القواعد الفقهية الخمس الكبرى',
                'id' => 'Mempelajari lima kaidah fiqih yang besar',
                'en' => 'Studying the five major Islamic legal maxims'
            ],
            'slug' => 'lima-kaidah-besar',
            'order' => 1,
            'is_published' => true,
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => ['ar' => 'الأمور بمقاصدها', 'id' => 'Segala Perkara Tergantung Niatnya', 'en' => 'Matters are Determined by Intentions'],
            'description' => ['ar' => 'شرح القاعدة الأولى وتطبيقاتها', 'id' => 'Penjelasan kaidah pertama dan aplikasinya', 'en' => 'Explanation of the first maxim and its applications'],
            'content' => ['ar' => '<p>إنما الأعمال بالنيات وإنما لكل امرئ ما نوى</p><p>من تطبيقات هذه القاعدة في الفقه:</p><ul><li>العبادات لا تصح بدون نية</li><li>التمييز بين العادة والعبادة</li><li>التفريق بين الطلاق الجاد والهازل</li></ul>', 'id' => '<p>Sesungguhnya amal perbuatan tergantung niatnya, dan setiap orang mendapatkan apa yang diniatkannya</p><p>Aplikasi kaidah ini dalam fiqih:</p><ul><li>Ibadah tidak sah tanpa niat</li><li>Membedakan antara kebiasaan dan ibadah</li><li>Membedakan antara talak sungguhan dan bercanda</li></ul>', 'en' => '<p>Verily, actions are by intentions, and every person will have what they intended</p><p>Applications of this maxim in jurisprudence:</p><ul><li>Worship is not valid without intention</li><li>Distinguishing between custom and worship</li><li>Differentiating between serious and joking divorce</li></ul>'],
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 45,
            'order' => 1,
            'is_published' => true,
        ]);

        echo "Arabic program seeded successfully!\n";
        echo "- Kitab Jurumiyah (Online Course): {$jurumiyah->courses->count()} courses with modules\n";
        echo "- Kitab Amtsilah Tasrifiyyah (Online Zoom): {$amtsilah->schedules->count()} scheduled sessions\n";
        echo "- Qawaid Fiqhiyyah (Online Course): {$qawaid->courses->count()} course with modules\n";
    }
}
