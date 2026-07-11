# Kanggui RCM - Full Stack Laravel Website Plan

## Project Overview
**Business:** Revenue Cycle Management (RCM) Services  
**Goal:** Build a professional, modern website to showcase revenue optimization services

---

## MVP Feature Set

### Phase 1: Core Features (MVP)

#### Frontend (Public-Facing)
1. **Homepage**
   - Hero section with value proposition
   - Services overview
   - Why Choose Us
   - Call-to-Action (CTA)

2. **About Page**
   - Company story
   - Mission & Vision
   - Team members (optional)

3. **Services Page**
   - Revenue Cycle Management
   - Medical Billing (if applicable)
   - Accounts Receivable Management
   - Denial Management
   - Payment Posting
   - Reporting & Analytics

4. **Contact Page**
   - Contact form
   - Business information
   - Map integration (optional)

5. **Blog/News Section**
   - Article listings
   - Individual article pages
   - Categories & tags

#### Backend (Admin Panel)
1. **Authentication**
   - Admin login/logout
   - Password reset

2. **Content Management**
   - Page editor (homepage sections)
   - Service management (CRUD)
   - Blog post management (CRUD)
   - Media library

3. **Lead Management**
   - Contact form submissions
   - Lead tracking
   - Email notifications

4. **Settings**
   - Site configuration
   - SEO settings
   - Contact information

---

## Technical Architecture

### Tech Stack

#### Backend
- **Framework:** Laravel 11.x
- **PHP Version:** 8.2+
- **Database:** MySQL 8.0 / PostgreSQL 15
- **Cache:** Redis
- **Queue:** Laravel Queue (database/redis driver)
- **Mail:** SMTP / Mailgun / SendGrid

#### Frontend
- **Template Engine:** Blade Templates
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Alpine.js (lightweight interactivity)
- **Icons:** Heroicons / FontAwesome
- **Build Tool:** Vite

#### Admin Panel
- **Option A:** Laravel Breeze + Custom Admin
- **Option B:** Filament PHP (Recommended for rapid admin development)
- **Option C:** Laravel Nova (Commercial)

#### Additional Tools
- **SEO:** spatie/laravel-sitemap, spatie/laravel-seo
- **Forms:** spatie/laravel-backup
- **Security:** spatie/laravel-permission (role-based access)
- **Analytics:** Google Analytics 4 integration

---

## Database Schema (MVP)

```sql
-- Users (admin)
users
- id
- name
- email
- password
- role (super_admin, content_manager)
- created_at, updated_at

-- Services
services
- id
- title
- slug
- description
- icon/image
- order
- is_active
- created_at, updated_at

-- Blog Posts
posts
- id
- title
- slug
- content
- excerpt
- featured_image
- author_id (FK -> users)
- category_id (FK -> categories)
- published_at
- is_published
- meta_title
- meta_description
- created_at, updated_at

-- Categories
categories
- id
- name
- slug
- parent_id (nullable)
- created_at, updated_at

-- Contact Submissions
contact_submissions
- id
- name
- email
- phone
- subject
- message
- is_read
- created_at

-- Site Settings
settings
- id
- key (unique)
- value (text/JSON)
- type
- created_at, updated_at

-- Media/Media Library (optional)
media
- id
- filename
- original_filename
- mime_type
- size
- disk
- created_at
```

---

## Project Structure

```
kanggui-rcm/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Frontend/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── AboutController.php
│   │   │   │   ├── ServicesController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   └── ContactController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ServiceController.php
│   │   │       ├── PostController.php
│   │   │       ├── CategoryController.php
│   │   │       ├── ContactSubmissionController.php
│   │   │       └── SettingController.php
│   │   ├── Middleware/
│   │   │   └── CheckAdminRole.php
│   │   ├── Requests/
│   │   │   ├── Frontend/
│   │   │   │   └── ContactFormRequest.php
│   │   │   └── Admin/
│   │   │       ├── StoreServiceRequest.php
│   │   │       ├── UpdateServiceRequest.php
│   │   │       ├── StorePostRequest.php
│   │   │       └── UpdatePostRequest.php
│   │   └── Resources/
│   │       └── Api/ (if API needed later)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Service.php
│   │   ├── Post.php
│   │   ├── Category.php
│   │   ├── ContactSubmission.php
│   │   └── Setting.php
│   ├── Policies/
│   │   ├── PostPolicy.php
│   │   └── ServicePolicy.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   ├── Mail/
│   │   └── NewContactSubmission.php
│   └── View/
│       └── Components/
│           ├── Layouts/
│           │   ├── AppLayout.php
│           │   └── AdminLayout.php
│           └── Frontend/
│               ├── HeroSection.php
│               └── ServiceCard.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_create_users_table.php
│   │   ├── 2024_01_01_create_services_table.php
│   │   ├── 2024_01_01_create_posts_table.php
│   │   ├── 2024_01_01_create_categories_table.php
│   │   ├── 2024_01_01_create_contact_submissions_table.php
│   │   └── 2024_01_01_create_settings_table.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── ServiceSeeder.php
│   │   └── SettingSeeder.php
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── admin.blade.php
│   │   ├── frontend/
│   │   │   ├── home.blade.php
│   │   │   ├── about.blade.php
│   │   │   ├── services/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   ├── blog/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   └── contact.blade.php
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── services/
│   │   │   ├── posts/
│   │   │   └── settings.blade.php
│   │   └── components/
│   │       ├── nav.blade.php
│   │       ├── footer.blade.php
│   │       └── ...
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php (frontend routes)
│   └── admin.php (admin routes)
├── public/
│   ├── index.php
│   └── assets/ (compiled assets)
├── config/
│   └── kanggui.php (custom config)
└── tests/
    ├── Feature/
    └── Unit/
```

---

## Routes Structure

### Frontend Routes (routes/web.php)
```php
// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
```

### Admin Routes (routes/admin.php)
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Services
        Route::resource('services', ServiceController::class);
        
        // Blog Posts
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class);
        
        // Contacts
        Route::get('contacts', [ContactSubmissionController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{id}', [ContactSubmissionController::class, 'show'])->name('contacts.show');
        
        // Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
```

---

## Development Timeline

### Week 1: Setup & Foundation
- [ ] Laravel installation & configuration
- [ ] Database setup & migrations
- [ ] Authentication system (admin)
- [ ] Base layout templates
- [ ] Tailwind CSS configuration

### Week 2: Frontend Development
- [ ] Homepage design & implementation
- [ ] About page
- [ ] Services listing & detail pages
- [ ] Contact page with form
- [ ] Responsive design

### Week 3: Backend/Admin Panel
- [ ] Admin dashboard
- [ ] Service CRUD
- [ ] Blog post CRUD
- [ ] Contact submission management
- [ ] Settings management

### Week 4: Polish & Launch
- [ ] SEO optimization
- [ ] Performance optimization
- [ ] Testing (feature & unit tests)
- [ ] Security audit
- [ ] Deployment preparation
- [ ] Documentation

---

## Key Considerations

### SEO Requirements
- Meta titles & descriptions for all pages
- Open Graph tags for social sharing
- XML sitemap generation
- robots.txt configuration
- Schema.org structured data
- Clean URLs (slugs)

### Performance
- Image optimization (WebP format)
- Lazy loading images
- Browser caching
- CDN integration (Cloudflare)
- Database query optimization

### Security
- HTTPS enforcement
- CSRF protection
- XSS prevention
- SQL injection prevention
- Rate limiting on forms
- Admin role-based access

### Accessibility
- WCAG 2.1 AA compliance
- Semantic HTML
- ARIA labels
- Keyboard navigation
- Color contrast ratios

---

## Future Enhancements (Post-MVP)

1. **Client Portal**
   - Secure login for clients
   - Dashboard with reports
   - Document sharing

2. **API Development**
   - RESTful API for third-party integrations
   - Webhooks for notifications

3. **Advanced Features**
   - Live chat integration
   - Appointment scheduling
   - Newsletter subscription
   - Multi-language support
   - Testimonials/Reviews section

4. **Analytics**
   - Custom reporting dashboard
   - Conversion tracking
   - A/B testing capabilities

---

## Budget Estimate (Development Time)

| Phase | Hours | Description |
|-------|-------|-------------|
| Setup & Config | 8-12 hrs | Laravel setup, DB, auth |
| Frontend | 40-60 hrs | All public pages, responsive |
| Backend/Admin | 40-50 hrs | CRUD operations, dashboard |
| Testing & QA | 16-24 hrs | Feature tests, bug fixes |
| Deployment | 8-12 hrs | Server setup, CI/CD |
| **Total** | **112-158 hrs** | ~3-4 weeks full-time |

---

## Next Steps

1. **Confirm requirements** - Review MVP feature list
2. **Choose admin panel** - Filament vs custom build
3. **Design mockups** - Create wireframes for key pages
4. **Setup development environment** - Local/dev/staging
5. **Begin development** - Start with Week 1 tasks
