# CMS Theming & Block System Guide

## Overview

This Laravel CMS now includes a comprehensive theming and block system that allows:
- **Multi-theme support** with customizable colors, typography, and layouts
- **Dynamic navigation menus** with sub-items and active state detection
- **Reusable content blocks** for building pages without code
- **Admin panel integration** via Filament for managing all CMS features

## Database Schema

### Tables Created

1. **themes** - Store theme configurations
   - `name`, `slug`, `description`
   - `is_active`, `is_default`
   - `colors` (JSON) - Primary, secondary, accent colors
   - `typography` (JSON) - Font families and sizes
   - `layout` (JSON) - Container width, spacing, border radius
   - `custom_css`, `custom_js`
   - `logo_light`, `logo_dark`, `favicon`

2. **menus** - Navigation menu definitions
   - `name`, `location` (header, footer, sidebar)
   - `is_active`, `order`

3. **menu_items** - Individual menu entries
   - `menu_id`, `parent_id` (for nested menus)
   - `title`, `url`, `route`, `route_parameters`
   - `target`, `icon`, `order`, `is_active`

4. **blocks** - Reusable content blocks
   - `name`, `type` (hero, features, cta, testimonials, faq, stats, team, services)
   - `slug`, `description`, `is_active`
   - `content` (JSON) - Block-specific content
   - `styles` (JSON) - Custom styling
   - `background_type`, `background_value`, `padding`

5. **page_blocks** - Page-to-block assignments
   - `page_type`, `page_identifier`
   - `block_id`, `order`, `is_active`

## Models

### Theme Model
```php
// Get active theme
$theme = Theme::active();

// Get default theme
$theme = Theme::defaultTheme();
```

### Menu Model
```php
// Get menu by location
$menu = Menu::getByLocation('header');

// Get items with children
$items = $menu->activeItems()->with('children')->get();
```

### Block Model
```php
// Get blocks by type
$heroes = Block::getByType('hero');

// Get blocks for a page
$homeBlocks = Block::forPage('home');
$serviceBlocks = Block::forPage('services', 'service-slug');
```

## Blade Components

### Dynamic Navigation
```blade
<x-dynamic-navigation location="header" :showDropdowns="true" />
```

**Features:**
- Automatic fallback to static navigation if no dynamic menu exists
- Dropdown support for nested menu items
- Active route highlighting
- Mobile-friendly with collapsible submenus
- Alpine.js powered interactions

### Dynamic Block
```blade
@foreach($blocks as $block)
    <x-dynamic-block :block="$block" />
@endforeach
```

**Supported Block Types:**
- `hero` - Hero sections with title, subtitle, CTA
- `features` - Feature grids
- `services` - Service cards
- `testimonials` - Testimonial cards
- `team` - Team member profiles
- `cta` - Call-to-action sections
- `stats` - Statistics displays
- `faq` - FAQ accordions

## Theme Integration in Layout

The main layout (`resources/views/layouts/app.blade.php`) now includes:

1. **Theme-aware favicon** - Uses theme's favicon if set
2. **Custom CSS injection** - Renders theme's custom CSS
3. **Custom JS injection** - Renders theme's custom JavaScript
4. **CSS variables** - Sets primary color from theme config

## Usage Examples

### Creating a Theme
```php
Theme::create([
    'name' => 'Dark Mode',
    'slug' => 'dark-mode',
    'is_active' => true,
    'colors' => [
        'primary' => '#6366F1',
        'secondary' => '#8B5CF6',
        'background' => '#1F2937',
        'text' => '#F9FAFB',
    ],
    'typography' => [
        'font_family' => 'Inter',
    ],
    'custom_css' => '.bg-gray-50 { background-color: #1F2937 !important; }',
]);
```

### Creating a Menu with Items
```php
$menu = Menu::create([
    'name' => 'Main Navigation',
    'location' => 'header',
    'is_active' => true,
]);

// Parent item
$servicesItem = MenuItem::create([
    'menu_id' => $menu->id,
    'title' => 'Services',
    'route' => 'services.index',
    'order' => 1,
]);

// Child item
MenuItem::create([
    'menu_id' => $menu->id,
    'parent_id' => $servicesItem->id,
    'title' => 'Revenue Cycle',
    'route' => 'services.show',
    'route_parameters' => ['slug' => 'revenue-cycle'],
    'order' => 1,
]);
```

### Creating a Block
```php
Block::create([
    'name' => 'Home Hero',
    'type' => 'hero',
    'slug' => 'home-hero',
    'is_active' => true,
    'content' => [
        'title' => 'Optimize Your Revenue Cycle',
        'subtitle' => 'Professional RCM Solutions',
        'description' => 'We help healthcare providers maximize revenue.',
        'cta_text' => 'Get Started',
        'cta_link' => route('contact'),
    ],
    'background_type' => 'gradient',
    'background_value' => 'from-blue-600 to-blue-800',
    'padding' => 'py-20',
]);
```

### Assigning Blocks to Pages
```php
PageBlock::create([
    'page_type' => 'home',
    'block_id' => $block->id,
    'order' => 1,
]);
```

## Admin Panel (Filament)

To manage these features in the admin panel, create Filament resources:

```bash
php artisan make:filament-resource Theme
php artisan make:filament-resource Menu
php artisan make:filament-resource Block
```

## File Structure

```
app/
├── Models/
│   ├── Theme.php
│   ├── Menu.php
│   ├── MenuItem.php
│   ├── Block.php
│   └── PageBlock.php
├── View/
│   └── Components/
│       └── DynamicNavigation.php
resources/
├── views/
│   ├── components/
│   │   ├── dynamic-navigation.blade.php
│   │   └── dynamic-block.blade.php
│   └── layouts/
│       └── app.blade.php (updated with theme support)
database/
└── migrations/
    └── 2026_07_11_000001_create_themes_table.php
```

## Next Steps

1. Run migrations: `php artisan migrate`
2. Create Filament resources for admin management
3. Update existing views to use dynamic blocks
4. Seed initial menu data
5. Create theme presets

## Notes

- All JSON fields are automatically cast to arrays in models
- Menu items support both URL and named routes
- Blocks support any background type: none, color, gradient, image
- Theme CSS/JS is injected inline for immediate effect
- Active state detection uses Laravel's `routeIs()` helper
