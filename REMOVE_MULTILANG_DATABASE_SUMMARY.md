# Remove Multi-Language from Database & Filament

## ✅ Yang Sudah Dilakukan:

### 1. Database Migration
**File:** `database/migrations/2025_12_07_084617_convert_translatable_columns_to_text.php`

**Perubahan:**
- Convert kolom JSON → TEXT/STRING untuk semua tabel:
  - `programs`: name, description, syllabus
  - `courses`: title, description
  - `course_modules`: title, content, description
  - `program_schedules`: title, description
  - `articles`: title, content
  - `categories`: name
  - `achievements`: title, description
  - `academy_programs`: name, description, details

### 2. Models Updated
**Hapus `HasTranslations` trait dan `$translatable` property:**

✅ `app/Models/Program.php`
✅ `app/Models/Course.php`
✅ `app/Models/CourseModule.php`
✅ `app/Models/ProgramSchedule.php`
✅ `app/Models/Article.php`
✅ `app/Models/Category.php`
✅ `app/Models/Achievement.php`
✅ `app/Models/AcademyProgram.php`

### 3. Filament Resources Updated

✅ **ProgramResource** (`app/Filament/Resources/ProgramResource.php`)
- `name.id/en/ar` → `name`
- `description.id/en/ar` → `description`
- `syllabus.id/en/ar` → `syllabus`

## 🔄 Yang Perlu Diupdate Manual:

### Filament Resources yang Perlu Diupdate:

1. **CourseResource** - Update form fields:
   - `title.id/en/ar` → `title`
   - `description.id/en/ar` → `description`

2. **CourseModuleResource** - Update form fields:
   - `title.id/en/ar` → `title`
   - `content.id/en/ar` → `content`
   - `description.id/en/ar` → `description`

3. **ProgramScheduleResource** (jika ada) - Update form fields:
   - `title.id/en/ar` → `title`
   - `description.id/en/ar` → `description`

4. **ArticleResource** - Update form fields:
   - `title.id/en/ar` → `title`
   - `content.id/en/ar` → `content`

5. **CategoryResource** (jika ada) - Update form fields:
   - `name.id/en/ar` → `name`

6. **AchievementResource** (jika ada) - Update form fields:
   - `title.id/en/ar` → `title`
   - `description.id/en/ar` → `description`

7. **AcademyProgramResource** - Update form fields:
   - `name.id/en/ar` → `name`
   - `description.id/en/ar` → `description`
   - `details.id/en/ar` → `details`

### Pattern untuk Update Filament Forms:

**Sebelum:**
```php
Forms\Components\TextInput::make('name.id')
    ->label('Name (Indonesian)')
    ->required(),

Forms\Components\TextInput::make('name.en')
    ->label('Name (English)'),

Forms\Components\TextInput::make('name.ar')
    ->label('Name (Arabic)'),
```

**Sesudah:**
```php
Forms\Components\TextInput::make('name')
    ->label('Nama')
    ->required(),
```

### Seeders yang Perlu Diupdate:

Jika ada seeder yang menggunakan format JSON untuk translatable fields, update menjadi string biasa:

**Sebelum:**
```php
'name' => [
    'id' => 'Program Test',
    'en' => 'Test Program',
    'ar' => 'برنامج اختبار',
],
```

**Sesudah:**
```php
'name' => 'Program Test',
```

## Testing Checklist:

- [x] Migration berhasil dijalankan
- [x] Models tidak lagi menggunakan HasTranslations
- [x] ProgramResource form updated
- [ ] CourseResource form updated
- [ ] CourseModuleResource form updated
- [ ] ArticleResource form updated
- [ ] AcademyProgramResource form updated
- [ ] Semua Filament forms bisa create/edit tanpa error
- [ ] Data ditampilkan dengan benar di frontend
- [ ] Seeders updated (jika ada)

## Benefits:

1. **Database:**
   - Kolom lebih sederhana (TEXT/STRING vs JSON)
   - Query lebih cepat (tidak perlu JSON_EXTRACT)
   - Index bisa diterapkan langsung

2. **Code:**
   - Tidak perlu trait HasTranslations
   - Akses data lebih sederhana: `$model->name` vs `$model->getTranslation('name', 'id')`
   - Filament forms lebih sederhana

3. **Maintenance:**
   - Lebih mudah maintain
   - Tidak perlu handle multi-language logic
   - Lebih sedikit code

## Notes:

- Data yang sudah ada di database tetap aman
- Migration hanya mengubah tipe kolom, tidak mengubah data
- Jika ada data dalam format JSON, akan tetap bisa dibaca sebagai string
- Rollback tersedia jika diperlukan (`php artisan migrate:rollback`)
