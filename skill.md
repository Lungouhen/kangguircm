# Laravel Expert Skill

You are an expert in Laravel and PHP development with deep knowledge of modern web application patterns.

## Core Principles
- Write concise, technical responses with accurate PHP examples
- Follow Laravel best practices and conventions
- Emphasize SOLID principles and object-oriented programming
- Prefer modular design over code duplication
- Use descriptive naming conventions throughout

## PHP/Laravel Standards
- Utilize PHP 8.1+ capabilities (typed properties, match expressions)
- Follow PSR-12 coding standards
- Use strict typing: `declare(strict_types=1);`
- Leverage Laravel's built-in features and helpers
- Adhere to Laravel's directory structure conventions

## Architecture
- Follow Laravel's MVC architecture
- Use routing system effectively
- Implement Repository pattern for data access
- Use Form Requests for validation
- Apply Blade templating best practices
- Leverage Eloquent relationships properly

## Core Practices
- Implement robust error handling via Laravel's exception system
- Use Laravel's validation features for form/request validation
- Apply middleware for request filtering
- Utilize Eloquent ORM over raw SQL
- Use built-in authentication and authorization
- Implement caching mechanisms for performance
- Use job queues for long-running tasks

## API Development
- Use API resource transformations
- Implement proper versioning
- Follow RESTful conventions
- Use proper HTTP status codes

## Testing
- Comprehensive testing with PHPUnit
- Use Laravel Dusk for browser testing
- Write feature and unit tests
- Mock external services appropriately

## Performance
- Use eager loading to prevent N+1 queries
- Implement caching strategies
- Optimize database queries
- Use queues for heavy operations

---

## Project-Specific Enhancements for Kanggui RCM

### Tech Stack
- **Laravel 11** with PHP 8.2+
- **Tailwind CSS** + **Alpine.js** for frontend
- **Filament PHP v3** for admin panel
- **MySQL 8.0** database

### Required Third-Party Packages

#### Security & Authentication
- `laravel/sanctum` - API token authentication
- `spatie/laravel-permission` - Role-based access control
- `spatie/laravel-backup` - Automated database backups
- `laravel/helmet` - Security headers

#### Communication & Forms
- `laravel/mailgun` - Email delivery
- `twilio/sdk` - SMS notifications
- `maatwebsite/excel` - Import/export functionality
- `spatie/laravel-query-builder` - Advanced filtering

#### UI/UX & Content
- `filament/filament` - Admin panel framework
- `intervention/image-laravel` - Image manipulation
- `spatie/laravel-medialibrary` - Media management
- `tijsverkoyen/css-to-inline-styles` - Email styling
- `blade-ui-kit/blade-heroicons` - Icon set
- `blade-ui-kit/blade-icons` - Icon components

#### SEO & Analytics
- `spatie/laravel-sitemap` - Sitemap generation
- `spatie/laravel-robots-middleware` - Robot.txt management
- `spatie/laravel-analytics` - Google Analytics integration

#### Developer Tools
- `barryvdh/laravel-debugbar` - Debugging toolbar
- `spatie/laravel-ignition` - Error page
- `laravel/pint` - Code formatter
- `phpstan/phpstan` - Static analysis

### Database Schema
1. **users** - Authentication & roles
2. **services** - Service offerings
3. **service_categories** - Service categorization
4. **posts** - Blog/news content
5. **categories** - Post categories
6. **contacts** - Contact form submissions
7. **leads** - Lead management tracking
8. **jobs** - Career postings
9. **newsletter_subscribers** - Email subscriptions
10. **settings** - Site configuration
11. **media** - File attachments (Spatie MediaLibrary)
12. **redirects** - URL redirects

### MVP Features

#### Frontend
- **Homepage**: Hero section, services overview, about preview, testimonials, CTA
- **About Page**: Company story, team members, values, certifications
- **Services Pages**: Detailed service descriptions, case studies, pricing
- **Blog/News**: Articles, categories, search, related posts
- **Contact Page**: Multi-step form, map integration, contact info
- **Career Page**: Job listings, application form
- **Newsletter Signup**: Email subscription

#### Backend (Filament Admin)
- **Dashboard**: Analytics, recent leads, quick stats
- **Service Management**: CRUD for services & categories
- **Content Management**: Blog posts, pages, media library
- **Lead Management**: View, filter, export leads
- **Contact Submissions**: Manage inquiries
- **Job Postings**: Create/manage career opportunities
- **Newsletter**: Subscriber management, campaigns
- **Settings**: Site configuration, SEO settings
- **User Management**: Roles, permissions, staff accounts

### Implementation Phases

#### Phase 1: Foundation (Week 1)
- Initialize Laravel 11 project
- Configure database & environment
- Install all third-party packages
- Set up Filament admin panel
- Configure authentication & authorization
- Create base migrations & models

#### Phase 2: Core Features (Week 2)
- Build service management (admin + frontend)
- Implement blog system with categories
- Create contact form with validation & notifications
- Set up media library integration
- Build homepage with dynamic sections

#### Phase 3: Advanced Features (Week 3)
- Implement lead management system
- Add newsletter subscription & campaigns
- Create career page with job applications
- Integrate analytics & SEO tools
- Build search functionality

#### Phase 4: Polish & Launch (Week 4)
- Responsive design optimization
- Performance tuning (caching, query optimization)
- Security hardening
- Testing (unit, feature, browser)
- Deployment configuration
- Documentation & training

### Key Implementation Notes

1. **Use Form Requests** for all form validation
2. **Implement Repository Pattern** for complex data access
3. **Use Jobs & Queues** for email sending, imports, exports
4. **Apply Caching** to frequently accessed data (services, settings)
5. **Use Events & Listeners** for decoupled logic (e.g., send email when lead created)
6. **Implement API Resources** for any future API needs
7. **Write Tests** for critical business logic
8. **Use Filament Resources** for rapid admin CRUD development
9. **Apply Spatie Packages** for common functionality (backup, sitemap, permissions)
10. **Optimize Images** using Intervention Image on upload

### Success Metrics
- Page load time < 2 seconds
- Mobile responsiveness score > 90
- SEO score > 85
- Zero critical security vulnerabilities
- 95%+ test coverage for core features
- Admin panel usable by non-technical staff
