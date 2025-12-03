# Implementation Plan

- [x] 1. Setup project foundation and core infrastructure

  - Install Laravel 12 and configure environment
  - Install FilamentPHP v4 and spatie/laravel-translatable packages
  - Install Eris for property-based testing
  - Configure database connection and create initial migrations
  - Setup Tailwind CSS with RTL support configuration
  - _Requirements: All requirements depend on this foundation_

- [x] 2. Implement database schema and models


  - [x] 2.1 Create users table migration with role, batch_year, and location fields


    - Add fields: name, email, password, role (enum), batch_year, latitude, longitude, avatar_url
    - Add email_verified_at timestamp
    - Add indexes on email and role
    - _Requirements: 10.1, 10.3, 11.1, 11.2_
  
  - [x] 2.2 Create programs table migration with translatable fields


    - Add fields: name (json), slug, type (enum), status (boolean), description (json), fees, start_date
    - Add indexes on slug and status
    - _Requirements: 2.1, 2.2, 2.3_
  
  - [x] 2.3 Create registrations table migration


    - Add fields: user_id (FK), program_id (FK), payment_proof, status (enum: pending/approved/rejected)
    - Add indexes on user_id, program_id, and status
    - _Requirements: 3.1, 3.2, 3.4, 4.2, 4.3_
  
  - [x] 2.4 Create articles table migration with translatable fields


    - Add fields: title (json), content (json), category_id (FK), is_featured (boolean), slug
    - Add indexes on category_id and is_featured
    - _Requirements: 5.1, 5.2, 5.3_
  
  - [x] 2.5 Create galleries table migration


    - Add fields: title, file_path, batch_filter (nullable), visibility (enum: public/member_only)
    - Add indexes on visibility and batch_filter
    - _Requirements: 7.1, 7.3, 7.4_
  
  - [x] 2.6 Create courses table migration with translatable fields


    - Add fields: title (json), program_id (FK nullable), video_url, content (json)
    - Add index on program_id
    - _Requirements: 8.1, 8.2, 8.3, 8.5_
  
  - [x] 2.7 Create categories table migration


    - Add fields: name (json), slug
    - Add index on slug
    - _Requirements: 5.2_

- [x] 3. Implement Eloquent models with relationships




  - [x] 3.1 Create User model with authentication and location features


    - Implement HasTranslations trait
    - Define fillable fields and casts (latitude/longitude as decimal)
    - Add relationships: registrations()
    - Add scopes: members(), withLocation()
    - Add methods: isAdmin(), isMember(), hasVerifiedEmail()
    - _Requirements: 10.1, 10.3, 11.1, 11.2, 11.4_
  
  - [x] 3.2 Create Program model with translatable support


    - Implement HasTranslations trait
    - Define translatable fields: name, description
    - Add relationships: registrations(), courses()
    - Add scopes: active(), byType()
    - _Requirements: 2.1, 2.2, 2.3, 2.4_
  
  - [x] 3.3 Create Registration model


    - Define fillable fields and casts
    - Add relationships: user(), program()
    - Add scopes: pending(), approved()
    - Add methods: approve(), reject()
    - _Requirements: 3.1, 3.4, 4.2, 4.3, 4.5_
  
  - [x] 3.4 Create Article model with translatable support


    - Implement HasTranslations trait
    - Define translatable fields: title, content
    - Add relationships: category()
    - Add scopes: featured(), byCategory()
    - _Requirements: 5.1, 5.2, 5.3, 5.4_
  
  - [x] 3.5 Create Gallery model with visibility logic


    - Define fillable fields
    - Add scopes: visibleForUser(), public(), memberOnly()
    - Add method: isVisibleTo()
    - _Requirements: 7.1, 7.2, 7.3, 7.4_
  
  - [x] 3.6 Create Course model with translatable support


    - Implement HasTranslations trait
    - Define translatable fields: title, content
    - Add relationships: program()
    - Add method: isAvailableForMember()
    - _Requirements: 8.1, 8.2, 8.3, 8.5_
  
  - [x] 3.7 Create Category model


    - Implement HasTranslations trait
    - Define translatable fields: name
    - Add relationships: articles()
    - _Requirements: 5.2, 5.4_

- [x] 4. Implement localization system




  - [x] 4.1 Create SetLocale middleware
    - Check for locale parameter in request
    - Validate locale against whitelist (id, en, ar)
    - Set application locale
    - Store locale in session
    - _Requirements: 1.1, 1.4_
  
  - [x] 4.2 Create LocalizationService

    - Implement setLocale() method
    - Implement getAvailableLocales() method returning ['id', 'en', 'ar']
    - Implement isRTL() method (returns true for 'ar', false otherwise)
    - _Requirements: 1.1, 1.2, 1.3_
  

  - [x] 4.3 Write property test for language persistence

    - **Property 3: Language persistence across navigation**
    - **Validates: Requirements 1.4**
  
  - [x] 4.4 Write property test for RTL/LTR layout switching


    - **Property 2: Non-Arabic languages use LTR layout**
    - **Validates: Requirements 1.3**
  
  - [x] 4.5 Create language switcher component


    - Build Blade component with language options
    - Add RTL/LTR class toggling based on selected language
    - Include in main layout
    - _Requirements: 1.1, 1.2, 1.3_

- [x] 5. Implement authentication system




  - [x] 5.1 Setup Laravel Breeze or Fortify for authentication scaffolding


    - Configure email verification
    - Setup password reset functionality
    - _Requirements: 10.1, 10.2, 10.3, 10.4, 10.5_
  
  - [x] 5.2 Create custom registration controller


    - Validate registration input
    - Create user with role 'user'
    - Send email verification
    - _Requirements: 10.1, 10.2_
  
  - [x] 5.3 Create custom login controller


    - Validate credentials
    - Check email verification status
    - Create session on successful login
    - Return error on invalid credentials
    - _Requirements: 10.3, 10.4, 10.5_
  
  - [x] 5.4 Write property test for user registration


    - **Property 35: User registration creates account with default role**
    - **Validates: Requirements 10.1**
  
  - [x] 5.5 Write property test for email verification

    - **Property 37: Email verification marks account**
    - **Validates: Requirements 10.3**
  
  - [x] 5.6 Write property test for valid login

    - **Property 38: Valid login creates session**
    - **Validates: Requirements 10.4**
  
  - [x] 5.7 Write property test for invalid login rejection

    - **Property 39: Invalid login rejection**
    - **Validates: Requirements 10.5**

- [x] 6. Implement authorization with policies





  - [x] 6.1 Create RegistrationPolicy


    - Implement viewAny() - only admins can view all
    - Implement update() - only admins can approve/reject
    - Implement create() - only authenticated users
    - _Requirements: 3.5, 4.4_
  
  - [x] 6.2 Create CoursePolicy


    - Implement view() - check member enrollment and program association
    - _Requirements: 8.4, 8.5_
  
  - [x] 6.3 Create GalleryPolicy


    - Implement view() - check visibility and batch filter
    - _Requirements: 7.2, 7.4_
  
  - [x] 6.4 Create AdminPanelPolicy


    - Implement viewAny() - only users with admin role
    - _Requirements: 9.5, 12.5_
  
  - [x] 6.5 Write property test for admin-only registration status changes


    - **Property 14: Only admins can change registration status**
    - **Validates: Requirements 4.4**
  
  - [x] 6.6 Write property test for admin panel access restriction


    - **Property 34: Admin panel access restriction**
    - **Validates: Requirements 9.5**

- [x] 7. Checkpoint - Ensure all tests pass





  - Ensure all tests pass, ask the user if questions arise.

- [x] 8. Implement program management module




  - [x] 8.1 Create ProgramController for public views


    - Implement index() - display active programs
    - Implement show() - display program details in selected language
    - Apply active() scope to queries
    - _Requirements: 2.1, 2.2, 2.4_
  
  - [x] 8.2 Create program index view


    - Display program list with name, type, status
    - Show "Registration Closed" indicator for closed programs
    - Support multi-language display
    - _Requirements: 2.1, 2.3_
  
  - [x] 8.3 Create program detail view


    - Display full program information (description, fees, dates)
    - Show registration form if program is active
    - Render content in selected language
    - _Requirements: 2.2, 2.4_
  
  - [x] 8.4 Write property test for active programs visibility


    - **Property 4: Active programs visibility**
    - **Validates: Requirements 2.1**
  
  - [x] 8.5 Write property test for program details in selected language

    - **Property 5: Program details in selected language**
    - **Validates: Requirements 2.2**
  
  - [x] 8.6 Write property test for closed program indication

    - **Property 6: Closed program indication**
    - **Validates: Requirements 2.3**

- [x] 9. Implement registration workflow





  - [x] 9.1 Create RegistrationController


    - Implement create() - show registration form
    - Implement store() - validate and create registration with payment proof
    - Check authentication before allowing registration
    - Set initial status to 'pending'
    - _Requirements: 3.1, 3.2, 3.4, 3.5_
  
  - [x] 9.2 Create registration form with file upload


    - Add form fields for program selection
    - Add file upload field for payment proof
    - Validate required fields
    - Display validation errors
    - _Requirements: 3.2, 3.3_
  
  - [x] 9.3 Implement file upload handling for payment proofs


    - Validate file type and size
    - Store file securely outside public directory
    - Save file path to registration record
    - _Requirements: 3.2_
  
  - [x] 9.4 Write property test for valid registration creation


    - **Property 7: Valid registration creates pending record**
    - **Validates: Requirements 3.1**
  
  - [x] 9.5 Write property test for payment proof storage

    - **Property 8: Payment proof storage and association**
    - **Validates: Requirements 3.2**
  
  - [x] 9.6 Write property test for invalid registration rejection

    - **Property 9: Invalid registration rejection**
    - **Validates: Requirements 3.3**
  
  - [x] 9.7 Write property test for authentication requirement

    - **Property 10: Authentication required for registration**
    - **Validates: Requirements 3.5**

- [ ] 10. Implement admin registration management




  - [x] 10.1 Create Filament RegistrationResource


    - Display registration list with filters (status, program)
    - Show registration details including payment proof image
    - Add approve/reject actions
    - Restrict access to admin role only
    - _Requirements: 4.1, 4.2, 4.3, 4.4_
  

  - [x] 10.2 Implement registration approval logic

    - Create approve() method that updates status to 'approved'
    - Persist status change immediately
    - _Requirements: 4.2, 4.5_
  
  - [x] 10.3 Implement registration rejection logic


    - Create reject() method that updates status to 'rejected'
    - Persist status change immediately
    - _Requirements: 4.3, 4.5_
  
  - [x] 10.4 Write property test for admin approval


    - **Property 12: Admin approval updates status**
    - **Validates: Requirements 4.2**
  
  - [x] 10.5 Write property test for admin rejection

    - **Property 13: Admin rejection updates status**
    - **Validates: Requirements 4.3**
  
  - [x] 10.6 Write property test for status change persistence

    - **Property 15: Status change persistence**
    - **Validates: Requirements 4.5**

- [x] 11. Implement blog and article system





  - [x] 11.1 Create ArticleController


    - Implement index() - display article list with category filter
    - Implement show() - display full article in selected language
    - _Requirements: 5.1, 5.2, 5.3_
  
  - [x] 11.2 Create article index view


    - Display articles with title, excerpt, category
    - Add category filter dropdown
    - Support pagination
    - _Requirements: 5.1, 5.2_
  
  - [x] 11.3 Create article detail view


    - Display full article content in selected language
    - Show category and metadata
    - _Requirements: 5.3, 5.5_
  
  - [x] 11.4 Implement category filtering


    - Add route parameter for category filter
    - Apply byCategory() scope when filter is present
    - _Requirements: 5.2_
  
  - [x] 11.5 Write property test for category filtering accuracy


    - **Property 17: Category filtering accuracy**
    - **Validates: Requirements 5.2**
  
  - [x] 11.6 Write property test for article content in selected language

    - **Property 18: Article content in selected language**
    - **Validates: Requirements 5.3**

- [x] 12. Implement member distribution map





  - [x] 12.1 Create MapController


    - Implement index() - display map page
    - Implement getMemberLocations() API endpoint - return JSON of member coordinates
    - _Requirements: 6.1, 6.3_
  
  - [x] 12.2 Create MapService


    - Implement getMemberLocations() - query users with coordinates
    - Implement formatMarkerData() - format data for Leaflet.js
    - _Requirements: 6.1, 6.3_
  


  - [x] 12.3 Create map view with Leaflet.js integration

    - Include Leaflet.js library
    - Initialize map with default center and zoom
    - Fetch member locations via AJAX
    - Render markers on map
    - Add popup with member info on marker click
    - _Requirements: 6.1, 6.4, 6.5_
  
  - [x] 12.4 Write property test for members with coordinates appearing on map


    - **Property 19: Members with coordinates appear on map**
    - **Validates: Requirements 6.1**
  
  - [x] 12.5 Write property test for coordinate updates reflecting on map


    - **Property 20: Coordinate updates reflect on map**
    - **Validates: Requirements 6.2**

- [x] 13. Checkpoint - Ensure all tests pass





  - Ensure all tests pass, ask the user if questions arise.

- [x] 14. Implement gallery system





  - [x] 14.1 Create GalleryController


    - Implement index() - display galleries visible to current user
    - Apply visibleForUser() scope with current user
    - Redirect unauthenticated users trying to access member-only content
    - _Requirements: 7.1, 7.2, 7.3, 7.4_
  
  - [x] 14.2 Create gallery index view


    - Display gallery items (images/videos)
    - Show only items matching user's batch or no batch filter
    - Add authentication check for member-only items
    - _Requirements: 7.1, 7.3, 7.4_
  
  - [x] 14.3 Implement gallery visibility logic in model


    - Create isVisibleTo() method checking visibility and batch
    - Create visibleForUser() scope
    - _Requirements: 7.1, 7.3, 7.4_
  
  - [x] 14.4 Add robots meta tag to prevent search engine indexing


    - Add noindex meta tag to member-only gallery pages
    - _Requirements: 7.5_
  
  - [x] 14.5 Write property test for batch-filtered gallery visibility


    - **Property 22: Batch-filtered gallery visibility**
    - **Validates: Requirements 7.1**
  
  - [x] 14.6 Write property test for unauthenticated access redirect


    - **Property 23: Unauthenticated access to member-only gallery redirects**
    - **Validates: Requirements 7.2**
  
  - [x] 14.7 Write property test for public gallery visibility


    - **Property 24: Public gallery visibility**
    - **Validates: Requirements 7.3**
  
  - [x] 14.8 Write property test for member-only gallery authentication


    - **Property 25: Member-only gallery requires authentication**
    - **Validates: Requirements 7.4**

- [x] 15. Implement e-learning system





  - [x] 15.1 Create CourseController


    - Implement index() - display courses available to member
    - Implement show() - display course content with video and text
    - Check authentication and authorization before access
    - _Requirements: 8.1, 8.2, 8.4_
  
  - [x] 15.2 Create course index view


    - Display list of available courses
    - Show course titles in selected language
    - Require authentication
    - _Requirements: 8.1, 8.4_
  
  - [x] 15.3 Create course detail view


    - Display course content (video and text) in selected language
    - Embed video player if video_url exists
    - _Requirements: 8.2, 8.3_
  
  - [x] 15.4 Implement video embedding logic


    - Support YouTube embed format
    - Support self-hosted video
    - _Requirements: 8.3_
  
  - [x] 15.5 Implement program-based course access control

    - Check if course is associated with program
    - Verify member enrollment in that program
    - _Requirements: 8.5_
  
  - [x] 15.6 Write property test for member course visibility


    - **Property 26: Member sees available courses**
    - **Validates: Requirements 8.1**
  
  - [x] 15.7 Write property test for video embedding

    - **Property 28: Video embedding**
    - **Validates: Requirements 8.3**
  
  - [x] 15.8 Write property test for e-learning authentication requirement

    - **Property 29: E-learning authentication requirement**
    - **Validates: Requirements 8.4**
  
  - [x] 15.9 Write property test for program-based course access

    - **Property 30: Program-based course access**
    - **Validates: Requirements 8.5**

- [ ] 16. Implement profile management




  - [x] 16.1 Create ProfileController


    - Implement edit() - show profile edit form
    - Implement update() - validate and save profile changes
    - Authorize that user can only update own profile
    - _Requirements: 11.1, 11.4, 11.5_
  
  - [x] 16.2 Create profile edit form







    - Add fields: name, batch_year, avatar upload, latitude, longitude
    - Validate latitude/longitude as decimal numbers
    - Display validation errors
    - _Requirements: 11.1, 11.2, 11.4_
  

  - [x] 16.3 Implement coordinate validation




    - Validate latitude range (-90 to 90)
    - Validate longitude range (-180 to 180)
    - Ensure values are valid decimal numbers
    - _Requirements: 11.2_
  
  - [x] 16.4 Write property test for profile update persistence





    - **Property 40: Profile update persistence**
    - **Validates: Requirements 11.1**
  
  - [x] 16.5 Write property test for coordinate validation





    - **Property 41: Coordinate validation**
    - **Validates: Requirements 11.2**
  
  - [x] 16.6 Write property test for profile update authorization





    - **Property 43: Profile update authorization**
    - **Validates: Requirements 11.5**

- [-] 17. Implement Filament admin panel




  - [x] 17.1 Create ArticleResource in Filament

    - Add CRUD operations for articles
    - Support translatable fields (title, content) for all 3 languages
    - Add category selection
    - Add is_featured toggle
    - _Requirements: 9.1, 9.4_
  
  - [x] 17.2 Create ProgramResource in Filament


    - Add CRUD operations for programs
    - Support translatable fields (name, description) for all 3 languages
    - Add type selection (academy/competition)
    - Add status toggle
    - _Requirements: 9.2, 9.4_
  
  - [x] 17.3 Create GalleryResource in Filament


    - Add CRUD operations for galleries
    - Add file upload for images/videos
    - Add visibility selection (public/member_only)
    - Add batch_filter field
    - _Requirements: 9.3, 9.4_
  
  - [x] 17.4 Create CourseResource in Filament


    - Add CRUD operations for courses
    - Support translatable fields (title, content) for all 3 languages
    - Add program association (optional)
    - Add video_url field
    - _Requirements: 9.4_
  
  - [x] 17.5 Create CategoryResource in Filament






    - Add CRUD operations for categories
    - Support translatable name field for all 3 languages
    - _Requirements: 9.4_
  
  - [x] 17.6 Write property test for article multi-language save

    - **Property 31: Article multi-language save**
    - **Validates: Requirements 9.1**
  
  - [x] 17.7 Write property test for program multi-language save

    - **Property 32: Program multi-language save**
    - **Validates: Requirements 9.2**
  
  - [x] 17.8 Write property test for gallery creation with options




    - **Property 33: Gallery creation with options**
    - **Validates: Requirements 9.3**

- [x] 18. Implement admin dashboard



  - [x] 18.1 Create dashboard widgets in Filament


    - Create PendingRegistrationsWidget - count registrations with pending status
    - Create PublishedArticlesWidget - count published articles
    - Create MembersCountWidget - count users with member/user role
    - _Requirements: 12.1, 12.2, 12.3_
  
  - [x] 18.2 Configure dashboard to display widgets


    - Add widgets to Filament dashboard
    - Ensure real-time updates when data changes
    - _Requirements: 12.1, 12.2, 12.3, 12.4_
  
  - [x] 18.3 Write property test for pending registrations count


    - **Property 44: Pending registrations count accuracy**
    - **Validates: Requirements 12.1**
  

  - [x] 18.4 Write property test for published articles count

    - **Property 45: Published articles count accuracy**
    - **Validates: Requirements 12.2**
  
  - [x] 18.5 Write property test for members count
    - **Property 46: Members count accuracy**
    - **Validates: Requirements 12.3**

- [x] 19. Checkpoint - Ensure all tests pass

  - Ensure all tests pass, ask the user if questions arise.

- [x] 20. Implement public pages and navigation




  - [x] 20.1 Create landing page (home)


    - Display vision and mission
    - Show featured programs
    - Display recent achievements (featured articles)
    - Support multi-language content
    - _Requirements: 1.1_
  
  - [x] 20.2 Create about page
    - Display organization information
    - Support multi-language content


    - _Requirements: 1.1_
  
  - [x] 20.3 Create main navigation layout
    - Add language switcher component


    - Add navigation links (Home, About, Programs, Blog, Map, Login)
    - Support RTL/LTR layout switching
    - _Requirements: 1.1, 1.2, 1.3_
  
  - [x] 20.4 Create footer with social media links
    - Add links to Instagram, WhatsApp, TikTok, YouTube, X (Twitter)
    - Support multi-language labels
    - _Requirements: 1.1_

- [-] 21. Implement member portal dashboard



  - [x] 21.1 Create member dashboard view


    - Display welcome message with member name
    - Show quick links to profile, courses, gallery
    - Display enrolled programs
    - _Requirements: 8.1, 11.4_
  

  - [x] 21.2 Add member navigation menu

    - Add links to Dashboard, Profile, Courses, Gallery
    - Require authentication
    - _Requirements: 8.4_

- [x] 22. Setup email notifications





  - [x] 22.1 Configure mail service (SMTP/API)

    - Setup mail driver in .env
    - Configure mail templates
    - _Requirements: 10.2_
  
  - [x] 22.2 Create email verification notification
    - Send verification link on registration
    - Support multi-language email content
    - _Requirements: 10.2_
  
  - [x] 22.3 Write property test for email verification link sent


    - **Property 36: Email verification link sent**
    - **Validates: Requirements 10.2**

- [x] 23. Implement security measures

  - [x] 23.1 Add CSRF protection to all forms


    - Ensure @csrf directive in all forms
    - _Requirements: All form submissions_
  
  - [x] 23.2 Add rate limiting to authentication routes


    - Limit login attempts
    - Limit registration attempts
    - _Requirements: 10.4, 10.5_
  
  - [x] 23.3 Implement file upload validation
    - Validate file types (images only for payment proofs)
    - Validate file sizes (max 2MB)
    - Sanitize file names
    - _Requirements: 3.2_
  
  - [x] 23.4 Add secure headers middleware
    - Add X-Frame-Options header
    - Add Content-Security-Policy header
    - _Requirements: Security best practices_

- [x] 24. Optimize performance





  - [x] 24.1 Add database indexes

    - Verify indexes on frequently queried columns
    - Add composite indexes where needed
    - _Requirements: Performance optimization_
  

  - [x] 24.2 Implement caching strategy

    - Cache translated content (1 hour TTL)
    - Cache active programs list (30 minutes TTL)
    - Cache dashboard statistics (5 minutes TTL)
    - Cache member locations for map (15 minutes TTL)
    - _Requirements: Performance optimization_
  
  - [x] 24.3 Optimize queries with eager loading


    - Add eager loading to prevent N+1 queries
    - Use with() for relationships
    - _Requirements: Performance optimization_
  
  - [x] 24.4 Add pagination to list views


    - Paginate articles list
    - Paginate programs list
    - Paginate gallery items
    - _Requirements: 5.1, 2.1_

- [x] 25. Final testing and polish




  - [x] 25.1 Test all three languages (Indonesian, English, Arabic)


    - Verify all content displays correctly in each language
    - Test RTL layout for Arabic
    - Test LTR layout for Indonesian and English
    - _Requirements: 1.1, 1.2, 1.3_
  
  - [x] 25.2 Test all user roles (Guest, User, Member, Admin)


    - Verify access controls work correctly
    - Test authorization policies
    - _Requirements: All authorization requirements_
  

  - [x] 25.3 Test registration workflow end-to-end

    - Register new user
    - Verify email
    - Login
    - Submit program registration
    - Admin approve registration
    - _Requirements: 3.1, 3.2, 4.2, 10.1, 10.2, 10.3_
  

  - [x] 25.4 Run all property-based tests with 100+ iterations

    - Verify all 47 properties pass
    - Check for edge cases discovered by property tests
    - _Requirements: All requirements_

- [ ] 26. Checkpoint - Final verification
  - Ensure all tests pass, ask the user if questions arise.

- [ ] 27. Prepare for deployment
  - [ ] 27.1 Create production environment configuration
    - Setup production .env file
    - Configure database credentials
    - Configure mail service
    - Configure file storage (S3 or local)
    - _Requirements: Deployment_
  
  - [ ] 27.2 Run database migrations in production
    - Execute php artisan migrate
    - Seed initial data (categories, admin user)
    - _Requirements: Deployment_
  
  - [ ] 27.3 Compile and optimize assets
    - Run npm run build
    - Optimize images
    - _Requirements: Deployment_
  
  - [ ] 27.4 Setup application monitoring
    - Configure error logging
    - Setup performance monitoring
    - _Requirements: Deployment_
