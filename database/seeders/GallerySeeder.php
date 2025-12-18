<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\User;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for gallery items
        $users = User::where('role', 'member_angkatan')->take(3)->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No member_angkatan users found. Creating sample gallery without user assignment.');
        }

        // Sample gallery items dengan bahasa Indonesia saja
        $galleryItems = [
            [
                'title' => 'Kegiatan Kajian Rutin',
                'description' => 'Dokumentasi kegiatan kajian rutin mingguan Manaahel',
                'file_type' => 'image',
                'visibility' => 'public',
            ],
            [
                'title' => 'Pelatihan Bahasa Arab',
                'description' => 'Sesi pelatihan bahasa Arab untuk anggota baru',
                'file_type' => 'image',
                'visibility' => 'member_only',
            ],
            [
                'title' => 'Video Presentasi Materi',
                'description' => 'Video presentasi materi kajian terbaru',
                'file_type' => 'video',
                'visibility' => 'public',
            ],
            [
                'title' => 'Diskusi Kelompok',
                'description' => 'Dokumentasi diskusi kelompok antar angkatan',
                'file_type' => 'image',
                'visibility' => 'member_only',
            ],
        ];

        foreach ($galleryItems as $index => $item) {
            $user = $users->count() > 0 ? $users->get($index % $users->count()) : null;
            
            Gallery::create([
                'user_id' => $user ? $user->id : null,
                'title' => $item['title'],
                'description' => $item['description'],
                'file_path' => 'https://via.placeholder.com/800x600/4F46E5/FFFFFF?text=' . urlencode($item['title']),
                'cloudinary_public_id' => null, // Will be set when actual files are uploaded
                'file_type' => $item['file_type'],
                'batch_filter' => $user ? $user->batch_year : null,
                'visibility' => $item['visibility'],
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Gallery seeder completed! Created ' . count($galleryItems) . ' sample gallery items.');
    }
}
