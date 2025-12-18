<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GalleryFolder;
use App\Models\User;

class GalleryFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $this->command->warn('No admin user found. Creating default admin...');
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@manaahel.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        $folders = [
            [
                'folder' => 'Kegiatan Rutin',
                'description' => 'Dokumentasi kegiatan rutin Manaahel',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Pembelajaran',
                'description' => 'Foto dan video pembelajaran',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Acara Khusus',
                'description' => 'Dokumentasi acara-acara khusus',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Batch 2024',
                'description' => 'Dokumentasi angkatan 2024',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Batch 2025',
                'description' => 'Dokumentasi angkatan 2025',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Profil Ustadz',
                'description' => 'Foto profil para ustadz',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Wisuda',
                'description' => 'Dokumentasi wisuda',
                'created_by' => $admin->id,
            ],
            [
                'folder' => 'Ramadan',
                'description' => 'Kegiatan bulan Ramadan',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($folders as $folder) {
            GalleryFolder::create($folder);
        }

        $this->command->info('Gallery folders seeded successfully!');
    }
}