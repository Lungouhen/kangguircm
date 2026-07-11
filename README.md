# Kanggui RCM Website

A modern, full-featured corporate website built with **Laravel 12**, **Tailwind CSS 4**, and **Filament 3** for Kanggui RCM. This platform provides a professional online presence with service showcases, blog management, career opportunities, and a robust admin panel.

## 🚀 Features

### Frontend
- **Responsive Design**: Mobile-first UI built with Tailwind CSS 4.
- **Home Page**: Hero section, service highlights, company stats, and latest news.
- **About Us**: Company story, mission, vision, and core values.
- **Services**: Dynamic listing and detailed view for each service offering.
- **Blog**: News index and single post views with related articles.
- **Careers**: Job listings with detailed descriptions and application forms.
- **Contact**: Interactive contact form with email notifications and business info.

### Backend (Admin Panel)
- **Filament 3 Admin**: Secure, modern dashboard for content management.
- **Resource Management**: CRUD operations for Services, Blog Posts, Jobs, Team Members, Testimonials, and Contact Messages.
- **Media Library**: Integrated Spatie Media Library for image handling.
- **Activity Logging**: Full audit trail of admin actions via Spatie Activity Log.
- **User Management**: Role-based access control for administrators.

### Technical Highlights
- **Laravel 12**: Latest framework features and security.
- **Database**: MySQL/PostgreSQL ready with SQLite support for testing.
- **Email System**: Automated notifications for contact forms and job applications.
- **SEO Ready**: Meta tags, structured data, and clean URLs.
- **Performance**: Vite bundling, optimized assets, and caching strategies.

## 🛠️ Tech Stack

- **Backend**: PHP 8.2+, Laravel 12.x
- **Frontend**: Blade Templates, Tailwind CSS 4.x, Alpine.js
- **Admin Panel**: Filament 3.x
- **Database**: MySQL / PostgreSQL / SQLite
- **Tools**: Composer, NPM, Vite, Git
- **Packages**:
  - `spatie/laravel-activitylog`
  - `spatie/laravel-medialibrary`
  - `filament/filament`
  - `laravel/pail` (for local development)

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL, PostgreSQL, or SQLite
- Git

## ⚙️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Lungouhen/kangguircm.git
cd kangguircm
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy the example environment file and configure your database:
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kanggui_rcm
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Database Setup
Run migrations and seed the database with sample data:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Build Assets
Compile frontend assets using Vite:
```bash
npm run build
```

### 6. Create Admin User
Create your first admin user to access the dashboard:
```bash
php artisan make:filament-user
```

### 7. Start Development Server
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000` in your browser.

## 📂 Project Structure

```
kangguircm/
├── app/
│   ├── Http/Controllers/      # Frontend controllers (Home, About, Services, etc.)
│   ├── Models/                # Eloquent models (Service, Post, Job, etc.)
│   ├── Filament/              # Admin panel resources and widgets
│   ├── Mail/                  # Email notification classes
│   └── Providers/             # Service providers
├── database/
│   ├── migrations/            # Database schema definitions
│   └── seeders/               # Sample data seeders
├── resources/
│   ├── views/                 # Blade templates (layouts, pages, components)
│   └── css/                   # Tailwind CSS entry point
├── routes/
│   └── web.php                # Web route definitions
├── public/                    # Compiled assets and entry point
└── config/                    # Configuration files
```

## 🎨 Customization

### Changing Branding
- Update logo and favicon in `resources/views/layouts/app.blade.php`.
- Modify colors in `resources/css/app.css` using Tailwind configuration.

### Adding Content
- Log in to `/admin` to manage services, blog posts, jobs, and team members via the Filament dashboard.
- Alternatively, update seeders in `database/seeders/` and re-run `php artisan db:seed`.

### Email Configuration
Configure SMTP settings in `.env` to enable contact form and job application emails:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@kangguircm.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🧪 Testing

Run the test suite to ensure everything is working correctly:
```bash
php artisan test
```

## 🚀 Deployment

### Production Checklist
1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`.
2. Run `composer install --optimize-autoloader --no-dev`.
3. Run `npm run build` for production assets.
4. Ensure directory permissions:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
5. Set up a process manager (e.g., Supervisor) for queue workers if using emails/jobs.

### Recommended Platforms
- **VPS**: Ubuntu/Debian with Nginx/Apache + PHP-FPM.
- **PaaS**: Render, Railway, Forge, or Vapor.
- **Shared Hosting**: Ensure PHP 8.2+ support and SSH access.

## 🤝 Support

For issues, questions, or contributions, please open an issue on the [GitHub Repository](https://github.com/Lungouhen/kangguircm).

## 📄 License

This project is proprietary software created for Kanggui RCM. All rights reserved.

---
*Generated for Kanggui RCM - Excellence in Resource & Contract Management*
