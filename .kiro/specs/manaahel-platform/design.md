# Design Document

## Overview

Manaahel Platform adalah aplikasi web full-stack yang dibangun menggunakan Laravel 12 sebagai backend framework dan FilamentPHP v4 sebagai admin panel. Sistem ini dirancang dengan arsitektur MVC (Model-View-Controller) yang memanfaatkan Eloquent ORM untuk data persistence, Blade templating engine untuk rendering views, dan Alpine.js/Livewire untuk interaktivitas frontend.

Platform ini mendukung multi-tenancy bahasa (Indonesian, English, Arabic) dengan kemampuan RTL layout switching, sistem autentikasi berbasis role (Admin, Member, User), dan berbagai modul fungsional termasuk content management, program registration, e-learning, dan community mapping.

## Architecture

### High-Level Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                        Presentation Layer                    │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ Public Views │  │ Member Portal│  │ Admin Panel  │      │
│  │ (Blade+TW)   │  │ (Blade+TW)   │  │ (Filament)   │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            │
┌─────────────────────────────────────────────────────────────┐
│                      Application Layer                       │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ Controllers  │  │ Middleware   │  │ Form Requests│      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
│  ┌──────────────┐  ┌──────────────┐                        │
│  │ Services     │  │ Policies     │                        │
│  └──────────────┘  └──────────────┘                        │
└─────────────────────────────────────────────────────────────┘
                            │
┌─────────────────────────────────────────────────────────────┐
│                        Domain Layer                          │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ Models       │  │ Repositories │  │ Events       │      │
│  │ (Eloquent)   │  │              │  │              │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            │
┌─────────────────────────────────────────────────────────────┐
│                     Infrastructure Layer                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ Database     │  │ File Storage │  │ Mail Service │      │
│  │ (MySQL)      │  │              │  │              │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
```

### Technology Stack Rationale

- **Laravel 12**: Provides robust routing, ORM, authentication, and middleware capabilities
- **FilamentPHP v4**: Accelerates admin panel development with pre-built CRUD interfaces
- **Blade + Tailwind CSS**: Enables rapid UI development with utility-first CSS and RTL support
- **Alpine.js/Livewire**: Adds reactivity without heavy JavaScript framework overhead
- **Leaflet.js**: Open-source mapping library for member distribution visualization
- **spatie/laravel-translatable**: Handles multi-language content storage in JSON format

## Components and Interfaces

### Core Components

#### 1. Authentication System
- **Purpose**: Manages user registration, login, email verification, and session management
- **Key Classes**:
  - `App\Http\Controllers\Auth\RegisterController`
  - `App\Http\Controllers\Auth\LoginController`
  - `App\Http\Middleware\EnsureEmailIsVerified`
- **Interfaces**: Laravel's built-in authentication contracts

#### 2. Localization Manager
- **Purpose**: Handles language switching and RTL/LTR layout toggling
- **Key Classes**:
  - `App\Http\Middleware\SetLocale`
  - `App\Services\LocalizationService`
- **Methods**:
  - `setLocale(string $locale): void`
  - `getAvailableLocales(): array`
  - `isRTL(string $locale): bool`

#### 3. Program Management Module
- **Purpose**: Manages program information and registration workflow
- **Key Classes**:
  - `App\Models\Program`
  - `App\Models\Registration`
  - `App\Http\Controllers\ProgramController`
  - `App\Http\Controllers\RegistrationController`
- **Methods**:
  - `Program::getActivePrograms(): Collection`
  - `Registration::create(array $data): Registration`
  - `Registration::updateStatus(string $status): bool`

#### 4. Content Management System
- **Purpose**: Handles articles, galleries, and courses
- **Key Classes**:
  - `App\Models\Article`
  - `App\Models\Gallery`
  - `App\Models\Course`
  - `App\Filament\Resources\ArticleResource`
- **Methods**:
  - `Article::getByCategory(int $categoryId): Collection`
  - `Gallery::getVisibleForUser(User $user): Collection`

#### 5. Member Distribution Map
- **Purpose**: Visualizes member locations on interactive map
- **Key Classes**:
  - `App\Http\Controllers\MapController`
  - `App\Services\MapService`
- **Methods**:
  - `MapService::getMemberLocations(): array`
  - `MapService::formatMarkerData(Collection $members): array`

#### 6. E-Learning System
- **Purpose**: Delivers course content to authenticated members
- **Key Classes**:
  - `App\Models\Course`
  - `App\Http\Controllers\CourseController`
  - `App\Policies\CoursePolicy`
- **Methods**:
  - `Course::getAvailableForMember(User $member): Collection`
  - `CoursePolicy::view(User $user, Course $course): bool`

### Interface Contracts

```php
interface TranslatableInterface
{
    public function getTranslation(string $key, string $locale): ?string;
    public function setTranslation(string $key, string $locale, string $value): void;
}

interface RegistrationServiceInterface
{
    public function createRegistration(array $data, UploadedFile $paymentProof): Registration;
    public function approveRegistration(int $registrationId): bool;
    public function rejectRegistration(int $registrationId): bool;
}

interface MapServiceInterface
{
    public function getMemberLocations(): array;
    public function updateMemberLocation(int $userId, float $latitude, float $longitude): bool;
}
```

## Data Models

### Entity Relationship Diagram

```
┌─────────────┐         ┌──────────────┐         ┌─────────────┐
│   Users     │         │ Registrations│         │  Programs   │
├─────────────┤         ├──────────────┤         ├─────────────┤
│ id          │────┐    │ id           │    ┌────│ id          │
│ name        │    │    │ user_id      │────┘    │ name (json) │
│ email       │    │    │ program_id   │────┐    │ slug        │
│ password    │    │    │ payment_proof│    │    │ type        │
│ role        │    │    │ status       │    │    │ status      │
│ batch_year  │    │    │ created_at   │    │    │ created_at  │
│ latitude    │    │    └──────────────┘    │    └─────────────┘
│ longitude   │    │                        │
│ avatar_url  │    │    ┌──────────────┐    │
└─────────────┘    │    │  Articles    │    │
                   │    ├──────────────┤    │
                   │    │ id           │    │
                   │    │ title (json) │    │
                   │    │ content(json)│    │
                   │    │ category_id  │    │
                   │    │ is_featured  │    │
                   │    │ created_at   │    │
                   │    └──────────────┘    │
                   │                        │
                   │    ┌──────────────┐    │
                   │    │  Galleries   │    │
                   │    ├──────────────┤    │
                   │    │ id           │    │
                   │    │ title        │    │
                   │    │ file_path    │    │
                   │    │ batch_filter │    │
                   │    │ visibility   │    │
                   │    │ created_at   │    │
                   │    └──────────────┘    │
                   │                        │
                   │    ┌──────────────┐    │
                   └────│  Courses     │    │
                        ├──────────────┤    │
                        │ id           │    │
                        │ title (json) │    │
                        │ program_id   │────┘
                        │ video_url    │
                        │ content(json)│
                        │ created_at   │
                        └──────────────┘
```

### Model Specifications

#### User Model
```php
class User extends Authenticatable implements TranslatableInterface
{
    protected $fillable = [
        'name', 'email', 'password', 'role', 
        'batch_year', 'latitude', 'longitude', 'avatar_url'
    ];
    
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'email_verified_at' => 'datetime',
    ];
    
    // Relationships
    public function registrations(): HasMany;
    
    // Scopes
    public function scopeMembers($query);
    public function scopeWithLocation($query);
    
    // Methods
    public function isAdmin(): bool;
    public function isMember(): bool;
    public function hasVerifiedEmail(): bool;
}
```

#### Program Model
```php
class Program extends Model
{
    use HasTranslations;
    
    protected $fillable = ['name', 'slug', 'type', 'status', 'description', 'fees', 'start_date'];
    
    public $translatable = ['name', 'description'];
    
    protected $casts = [
        'status' => 'boolean',
        'fees' => 'decimal:2',
        'start_date' => 'date',
    ];
    
    // Relationships
    public function registrations(): HasMany;
    public function courses(): HasMany;
    
    // Scopes
    public function scopeActive($query);
    public function scopeByType($query, string $type);
}
```

#### Registration Model
```php
class Registration extends Model
{
    protected $fillable = ['user_id', 'program_id', 'payment_proof', 'status'];
    
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    // Relationships
    public function user(): BelongsTo;
    public function program(): BelongsTo;
    
    // Scopes
    public function scopePending($query);
    public function scopeApproved($query);
    
    // Methods
    public function approve(): bool;
    public function reject(): bool;
}
```

#### Article Model
```php
class Article extends Model
{
    use HasTranslations;
    
    protected $fillable = ['title', 'content', 'category_id', 'is_featured', 'slug'];
    
    public $translatable = ['title', 'content'];
    
    protected $casts = [
        'is_featured' => 'boolean',
    ];
    
    // Relationships
    public function category(): BelongsTo;
    
    // Scopes
    public function scopeFeatured($query);
    public function scopeByCategory($query, int $categoryId);
}
```

#### Gallery Model
```php
class Gallery extends Model
{
    protected $fillable = ['title', 'file_path', 'batch_filter', 'visibility'];
    
    // Scopes
    public function scopeVisibleForUser($query, ?User $user);
    public function scopePublic($query);
    public function scopeMemberOnly($query);
    
    // Methods
    public function isVisibleTo(?User $user): bool;
}
```

#### Course Model
```php
class Course extends Model
{
    use HasTranslations;
    
    protected $fillable = ['title', 'program_id', 'video_url', 'content'];
    
    public $translatable = ['title', 'content'];
    
    // Relationships
    public function program(): BelongsTo;
    
    // Methods
    public function isAvailableForMember(User $member): bool;
}
```

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system—essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property Reflection

After analyzing all acceptance criteria, I identified several redundant properties that can be consolidated:
- Properties 2.2 and 2.4 both test program information display in selected language (keep 2.2)
- Properties 3.1 and 3.4 both test new registrations have pending status (keep 3.1)
- Properties 5.3 and 5.5 both test article content in selected language (keep 5.3)
- Properties 6.1 and 6.3 both test members with coordinates appear on map (keep 6.1)
- Properties 6.2 and 11.3 both test coordinate updates reflect on map (keep 6.2)

### Localization Properties

**Property 1: Language selection updates all content**
*For any* translatable content in the system, when a user selects a language, all displayed interface elements and content should be rendered in that selected language.
**Validates: Requirements 1.1**

**Property 2: Non-Arabic languages use LTR layout**
*For any* language selection that is Indonesian or English, the layout direction should be set to LTR (Left-to-Right).
**Validates: Requirements 1.3**

**Property 3: Language persistence across navigation**
*For any* language selection within a session, navigating to different pages should maintain the same language preference throughout the session.
**Validates: Requirements 1.4**

### Program Management Properties

**Property 4: Active programs visibility**
*For any* program with active status, it should appear in the programs list displayed to users.
**Validates: Requirements 2.1**

**Property 5: Program details in selected language**
*For any* program and selected language, the program detail page should display all fields (description, fees, dates) in that language.
**Validates: Requirements 2.2**

**Property 6: Closed program indication**
*For any* program with closed status, the system should display an indication that registration is not available.
**Validates: Requirements 2.3**

### Registration Properties

**Property 7: Valid registration creates pending record**
*For any* valid registration data submitted by an authenticated user, the system should create a registration record with status set to pending.
**Validates: Requirements 3.1**

**Property 8: Payment proof storage and association**
*For any* registration with uploaded payment proof file, the file should be stored and the file path should be associated with the registration record.
**Validates: Requirements 3.2**

**Property 9: Invalid registration rejection**
*For any* registration submission missing required fields, the system should prevent creation and return validation errors.
**Validates: Requirements 3.3**

**Property 10: Authentication required for registration**
*For any* registration submission attempt by an unauthenticated user, the system should reject the submission.
**Validates: Requirements 3.5**

### Admin Registration Management Properties

**Property 11: Admin views registration details**
*For any* pending registration, when viewed by an admin, all registration details including payment proof should be displayed.
**Validates: Requirements 4.1**

**Property 12: Admin approval updates status**
*For any* pending registration, when an admin approves it, the registration status should be updated to approved.
**Validates: Requirements 4.2**

**Property 13: Admin rejection updates status**
*For any* pending registration, when an admin rejects it, the registration status should be updated to rejected.
**Validates: Requirements 4.3**

**Property 14: Only admins can change registration status**
*For any* user without admin role, attempts to change registration status should be rejected.
**Validates: Requirements 4.4**

**Property 15: Status change persistence**
*For any* registration status change, immediately querying the database should return the new status.
**Validates: Requirements 4.5**

### Content Management Properties

**Property 16: Published articles display with required fields**
*For any* published article, it should appear in the blog list with title, excerpt, and category visible.
**Validates: Requirements 5.1**

**Property 17: Category filtering accuracy**
*For any* category filter selection, only articles belonging to that category should be displayed in the results.
**Validates: Requirements 5.2**

**Property 18: Article content in selected language**
*For any* article and selected language, the full article content should be displayed in that language.
**Validates: Requirements 5.3**

### Map Properties

**Property 19: Members with coordinates appear on map**
*For any* member who has provided latitude and longitude coordinates, a marker should appear on the distribution map at that location.
**Validates: Requirements 6.1**

**Property 20: Coordinate updates reflect on map**
*For any* member who updates their location coordinates, the distribution map should include a marker at the new location.
**Validates: Requirements 6.2**

**Property 21: Marker displays member information**
*For any* map marker, clicking it should display the basic member information associated with that location.
**Validates: Requirements 6.4**

### Gallery Properties

**Property 22: Batch-filtered gallery visibility**
*For any* member with a specific batch year, the gallery page should display only items matching their batch year or items with no batch filter.
**Validates: Requirements 7.1**

**Property 23: Unauthenticated access to member-only gallery redirects**
*For any* unauthenticated user attempting to access member-only gallery content, the system should redirect to the login page.
**Validates: Requirements 7.2**

**Property 24: Public gallery visibility**
*For any* gallery item with public visibility, it should be displayed to all users regardless of authentication status.
**Validates: Requirements 7.3**

**Property 25: Member-only gallery requires authentication**
*For any* gallery item with member-only visibility, it should only be displayed to authenticated members.
**Validates: Requirements 7.4**

### E-Learning Properties

**Property 26: Member sees available courses**
*For any* member, the e-learning section should display only courses that are available to them based on their enrollments.
**Validates: Requirements 8.1**

**Property 27: Course content display completeness**
*For any* course, the detail page should display all course content including video and textual materials.
**Validates: Requirements 8.2**

**Property 28: Video embedding**
*For any* course containing a video URL, the course page should render an embedded video player.
**Validates: Requirements 8.3**

**Property 29: E-learning authentication requirement**
*For any* unauthenticated user attempting to access e-learning content, the system should reject the access.
**Validates: Requirements 8.4**

**Property 30: Program-based course access**
*For any* course associated with a specific program, only members enrolled in that program should be able to access the course.
**Validates: Requirements 8.5**

### Admin Content Management Properties

**Property 31: Article multi-language save**
*For any* article created or updated by an admin, all three language versions (Indonesian, English, Arabic) should be saved to the database.
**Validates: Requirements 9.1**

**Property 32: Program multi-language save**
*For any* program created or updated by an admin, all translatable fields should be saved in all three supported languages.
**Validates: Requirements 9.2**

**Property 33: Gallery creation with options**
*For any* gallery item created by an admin, the visibility and batch filter options should be saved with the gallery record.
**Validates: Requirements 9.3**

**Property 34: Admin panel access restriction**
*For any* user without admin role, attempts to access the admin panel should be rejected.
**Validates: Requirements 9.5**

### Authentication Properties

**Property 35: User registration creates account with default role**
*For any* valid registration with email and password, a new user account should be created with role set to 'user'.
**Validates: Requirements 10.1**

**Property 36: Email verification link sent**
*For any* user registration, an email containing a verification link should be sent to the provided email address.
**Validates: Requirements 10.2**

**Property 37: Email verification marks account**
*For any* verification link clicked, the user's email_verified_at field should be set and login should be allowed.
**Validates: Requirements 10.3**

**Property 38: Valid login creates session**
*For any* valid login credentials submitted, the system should authenticate the user and create an active session.
**Validates: Requirements 10.4**

**Property 39: Invalid login rejection**
*For any* invalid login credentials submitted, the system should reject the attempt and display an error message.
**Validates: Requirements 10.5**

### Profile Management Properties

**Property 40: Profile update persistence**
*For any* profile update by a member, immediately querying the database should return the updated values.
**Validates: Requirements 11.1**

**Property 41: Coordinate validation**
*For any* latitude or longitude value that is not a valid decimal number, the system should reject the profile update with validation error.
**Validates: Requirements 11.2**

**Property 42: Profile field editability**
*For any* member, updating name, batch year, avatar, or location coordinates should result in those fields being saved.
**Validates: Requirements 11.4**

**Property 43: Profile update authorization**
*For any* member, attempts to update another user's profile should be rejected.
**Validates: Requirements 11.5**

### Dashboard Properties

**Property 44: Pending registrations count accuracy**
*For any* admin viewing the dashboard, the displayed count of pending registrations should equal the actual number of registrations with pending status.
**Validates: Requirements 12.1**

**Property 45: Published articles count accuracy**
*For any* admin viewing the dashboard, the displayed count of published articles should equal the actual number of published articles.
**Validates: Requirements 12.2**

**Property 46: Members count accuracy**
*For any* admin viewing the dashboard, the displayed count of registered members should equal the actual number of users with member or user role.
**Validates: Requirements 12.3**

**Property 47: Dashboard access restriction**
*For any* user without admin role, attempts to access the dashboard should be rejected.
**Validates: Requirements 12.5**



## Error Handling

### Error Handling Strategy

The application will implement a layered error handling approach:

1. **Validation Layer**: Form Request classes validate input before reaching controllers
2. **Business Logic Layer**: Service classes throw domain-specific exceptions
3. **Presentation Layer**: Exception handlers format errors appropriately for API/web responses

### Error Categories

#### 1. Validation Errors
- **Trigger**: Invalid user input (missing fields, wrong format, etc.)
- **Handling**: Laravel Form Request validation with localized error messages
- **Response**: 422 Unprocessable Entity with field-specific errors
- **Example**: Missing required field in registration form

#### 2. Authentication Errors
- **Trigger**: Unauthenticated access, invalid credentials, unverified email
- **Handling**: Laravel authentication middleware and guards
- **Response**: 401 Unauthorized or redirect to login page
- **Example**: Accessing member area without login

#### 3. Authorization Errors
- **Trigger**: Insufficient permissions for requested action
- **Handling**: Laravel Policy classes
- **Response**: 403 Forbidden or redirect with error message
- **Example**: Non-admin trying to access admin panel

#### 4. Resource Not Found Errors
- **Trigger**: Requested resource doesn't exist
- **Handling**: Model::findOrFail() throws ModelNotFoundException
- **Response**: 404 Not Found with user-friendly message
- **Example**: Accessing non-existent article

#### 5. File Upload Errors
- **Trigger**: File too large, invalid format, storage failure
- **Handling**: Validation rules and try-catch blocks
- **Response**: 422 with specific error message
- **Example**: Payment proof exceeds size limit

#### 6. Database Errors
- **Trigger**: Connection failure, constraint violation, query errors
- **Handling**: Try-catch blocks with transaction rollback
- **Response**: 500 Internal Server Error with logged details
- **Example**: Duplicate email registration

#### 7. Localization Errors
- **Trigger**: Missing translation, invalid locale
- **Handling**: Fallback to default language (Indonesian)
- **Response**: Display content in fallback language
- **Example**: Missing Arabic translation for new content

### Error Response Format

```php
// Web Response (Blade views)
[
    'message' => 'User-friendly error message',
    'errors' => [
        'field_name' => ['Specific validation error']
    ]
]

// JSON Response (for AJAX/API)
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field": ["Validation message"]
    },
    "code": "ERROR_CODE"
}
```

### Logging Strategy

- **Error Level**: Database errors, file system errors, external service failures
- **Warning Level**: Missing translations, deprecated feature usage
- **Info Level**: User registration, login attempts, status changes
- **Debug Level**: Query logs, cache operations (development only)

## Testing Strategy

### Overview

The testing strategy employs a dual approach combining unit tests for specific scenarios and property-based tests for universal correctness properties. This ensures both concrete bug detection and general correctness verification.

### Testing Framework

- **Unit Testing**: PHPUnit (Laravel's default testing framework)
- **Property-Based Testing**: We will use **Eris** (https://github.com/giorgiosironi/eris), a property-based testing library for PHP
- **Browser Testing**: Laravel Dusk for end-to-end testing (optional)
- **Minimum Iterations**: Each property-based test will run a minimum of 100 iterations

### Unit Testing Approach

Unit tests will cover:

1. **Specific Examples**: Concrete test cases that demonstrate correct behavior
2. **Edge Cases**: Boundary conditions, empty inputs, null values
3. **Integration Points**: Component interactions, database queries
4. **Error Conditions**: Exception handling, validation failures

**Example Unit Tests**:
- Test user registration with valid data creates account
- Test login with invalid password returns error
- Test article creation saves all language versions
- Test gallery visibility for different user roles

### Property-Based Testing Approach

Property-based tests will verify universal properties across randomly generated inputs. Each property test must:

1. Be tagged with a comment referencing the design document property
2. Use the format: `**Feature: manaahel-platform, Property {number}: {property_text}**`
3. Run minimum 100 iterations with varied inputs
4. Generate realistic test data using Eris generators

**Property Test Structure**:
```php
/**
 * **Feature: manaahel-platform, Property 7: Valid registration creates pending record**
 * 
 * @test
 */
public function valid_registration_creates_pending_record()
{
    $this->forAll(
        Generator\associative([
            'email' => Generator\email(),
            'password' => Generator\string()->withMinSize(8),
            'program_id' => Generator\choose(1, 10)
        ])
    )->then(function ($data) {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $registration = Registration::create($data);
        
        $this->assertEquals('pending', $registration->status);
    });
}
```

### Test Coverage Goals

- **Unit Test Coverage**: Minimum 70% code coverage
- **Property Test Coverage**: All 47 correctness properties must have corresponding property tests
- **Critical Paths**: 100% coverage for authentication, authorization, and payment flows

### Testing Priorities

**High Priority** (Must test):
1. Authentication and authorization (Properties 35-39, 43, 47)
2. Registration workflow (Properties 7-15)
3. Multi-language content (Properties 1-3, 31-32)
4. Payment proof handling (Property 8)

**Medium Priority** (Should test):
5. Content management (Properties 16-18, 31-33)
6. Gallery visibility (Properties 22-25)
7. E-learning access (Properties 26-30)
8. Profile management (Properties 40-43)

**Lower Priority** (Nice to test):
9. Map functionality (Properties 19-21)
10. Dashboard statistics (Properties 44-47)

### Test Data Management

- **Factories**: Laravel factories for generating model instances
- **Seeders**: Database seeders for consistent test data
- **Generators**: Eris generators for property-based test inputs
- **Cleanup**: Database transactions to rollback after each test

### Continuous Integration

- Run all tests on every commit
- Fail build if any test fails
- Generate coverage reports
- Run property tests with increased iterations (500+) on main branch

### Test Organization

```
tests/
├── Unit/
│   ├── Models/
│   │   ├── UserTest.php
│   │   ├── ProgramTest.php
│   │   └── RegistrationTest.php
│   ├── Services/
│   │   ├── LocalizationServiceTest.php
│   │   └── MapServiceTest.php
│   └── Policies/
│       └── RegistrationPolicyTest.php
├── Feature/
│   ├── Auth/
│   │   ├── RegistrationTest.php
│   │   └── LoginTest.php
│   ├── Programs/
│   │   └── ProgramRegistrationTest.php
│   └── Admin/
│       └── ContentManagementTest.php
└── Property/
    ├── LocalizationPropertiesTest.php
    ├── RegistrationPropertiesTest.php
    ├── ContentPropertiesTest.php
    └── AuthorizationPropertiesTest.php
```

### Example Test Cases

#### Unit Test Example
```php
/** @test */
public function admin_can_approve_pending_registration()
{
    $admin = User::factory()->admin()->create();
    $registration = Registration::factory()->pending()->create();
    
    $this->actingAs($admin);
    
    $response = $this->post(route('admin.registrations.approve', $registration));
    
    $this->assertEquals('approved', $registration->fresh()->status);
    $response->assertRedirect();
}
```

#### Property Test Example
```php
/**
 * **Feature: manaahel-platform, Property 17: Category filtering accuracy**
 * 
 * @test
 */
public function category_filtering_returns_only_matching_articles()
{
    $this->forAll(
        Generator\choose(1, 4), // category_id
        Generator\seq(Generator\associative([
            'title' => Generator\string(),
            'category_id' => Generator\choose(1, 4)
        ]))->withMaxSize(20)
    )->then(function ($filterCategoryId, $articlesData) {
        foreach ($articlesData as $data) {
            Article::factory()->create($data);
        }
        
        $filtered = Article::byCategory($filterCategoryId)->get();
        
        foreach ($filtered as $article) {
            $this->assertEquals($filterCategoryId, $article->category_id);
        }
    });
}
```

## Security Considerations

### Authentication & Authorization
- Password hashing using bcrypt (Laravel default)
- Email verification required before full access
- Role-based access control (Admin, Member, User)
- CSRF protection on all forms
- Session timeout after inactivity

### Data Protection
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade escaping
- File upload validation (type, size, extension)
- Secure file storage outside public directory
- Database encryption for sensitive fields

### API Security
- Rate limiting on authentication endpoints
- Input validation on all requests
- Sanitization of user-generated content
- Secure headers (X-Frame-Options, CSP)

### Multi-Language Security
- Prevent locale injection attacks
- Validate locale parameter against whitelist
- Sanitize translated content before display

## Performance Considerations

### Database Optimization
- Indexes on frequently queried columns (email, slug, status)
- Eager loading to prevent N+1 queries
- Database query caching for static content
- Pagination for large result sets

### Caching Strategy
- Cache translated content (1 hour TTL)
- Cache active programs list (30 minutes TTL)
- Cache dashboard statistics (5 minutes TTL)
- Cache member locations for map (15 minutes TTL)

### Asset Optimization
- Minify CSS and JavaScript
- Image optimization and lazy loading
- CDN for static assets
- Browser caching headers

### Scalability
- Queue email sending for async processing
- File storage on cloud service (S3, etc.)
- Database read replicas for heavy queries
- Horizontal scaling capability

## Deployment Considerations

### Environment Requirements
- PHP 8.2+
- MySQL 8.0+ or MariaDB 10.3+
- Composer 2.x
- Node.js 18+ (for asset compilation)

### Configuration
- Environment-specific .env files
- Separate database for testing
- Mail configuration (SMTP/API)
- File storage configuration

### Migration Strategy
- Run migrations in production
- Seed initial data (categories, roles)
- Generate application key
- Link storage directory

### Monitoring
- Application error logging
- Performance monitoring
- Database query monitoring
- User activity tracking

