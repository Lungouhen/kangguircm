# CMS Theming & Block System Setup Guide

## Overview
This CMS system provides a Bixoo-inspired design with dynamic theming, menu management, and block-based page building.

## Installation Steps

### 1. Run Migrations
```bash
php artisan migrate
```

This creates the following tables:
- `themes` - Theme configurations (colors, typography, layout, custom CSS/JS)
- `menus` - Navigation menus by location
- `menu_items` - Menu items with parent-child relationships
- `blocks` - Reusable content blocks
- `page_blocks` - Block assignments to pages

### 2. Seed Sample Data
```bash
php artisan db:seed --class=CmsSeeder
```

This creates:
- Default theme with blue color scheme
- Main navigation menu with dropdown structure
- 4 sample blocks for the home page (Hero, Stats, Features, CTA)

### 3. Access Admin Panel
Navigate to `/admin` and login to manage:

**Design Section:**
- **Themes** - Customize colors, fonts, logos, custom CSS/JS
- **Menus** - Create navigation menus for different locations
- **Menu Items** - Add/edit menu items with parent-child relationships

**Content Section:**
- **Blocks** - Create reusable content blocks (8 types)
- **Page Blocks** - Assign blocks to specific pages

## Features

### Multi-Theme Support
- Multiple color schemes (primary, secondary, accent)
- Custom typography (heading and body fonts)
- Logo and favicon uploads
- Custom CSS and JavaScript injection
- Layout configuration

### Dynamic Navigation
- Multiple menu locations (header, footer, mobile, sidebar)
- Parent-child menu relationships for dropdowns
- Active state detection based on current route
- Icons and target attributes (_self, _blank)
- Mobile-friendly responsive menu

### Block System (8 Types)
1. **Hero** - Full-width hero sections with CTAs
2. **Features** - Grid of feature items with icons
3. **Services** - Service cards with descriptions
4. **CTA** - Call-to-action sections
5. **Testimonials** - Customer testimonial grid
6. **FAQ** - Accordion-style FAQ section
7. **Stats** - Statistics counter display
8. **Team** - Team member profiles

### Page Building
- Assign blocks to any page (home, about, services, etc.)
- Control block order per page
- Enable/disable blocks per page
- Support for dynamic page identifiers

## Usage in Views

### Dynamic Navigation
The navigation is automatically loaded in `layouts/app.blade.php`:
```blade
@include('partials.navigation')
```

It fetches menus from the database and falls back to static links if no menu exists.

### Dynamic Blocks
In your page views (e.g., `home/index.blade.php`):
```php
@php
    $blocks = \App\Models\Block::forPage('home');
@endphp

@foreach($blocks as $block)
    <x-dynamic-block :block="$block" />
@endforeach
```

### Theme Variables
CSS custom properties are automatically set in the layout:
```css
--color-primary: #2563EB;
--color-secondary: #1E40AF;
--color-accent: #F59E0B;
--font-heading: 'Instrument Serif', serif;
--font-body: 'Instrument Sans', sans-serif;
```

Use them in your views:
```blade
<div style="color: var(--color-primary); font-family: var(--font-heading);">
    Your content here
</div>
```

## Admin Panel Navigation

After logging into `/admin`:

1. **Design → Themes**: Manage site appearance
2. **Design → Menus**: Create navigation structures
3. **Design → Menu Items**: Add/edit menu links
4. **Content → Blocks**: Create content blocks
5. **Content → Page Blocks**: Assign blocks to pages

## Customization Tips

### Adding New Block Types
1. Add the type to `BlockResource.php` select options
2. Create the rendering logic in `dynamic-block.blade.php`
3. Optionally create dedicated Blade components

### Custom Styling
Add custom CSS in the Theme model via admin panel or extend the layout:
```blade
@section('custom_styles')
    <style>
        /* Your custom styles */
    </style>
@endsection
```

### Menu Locations
Available locations:
- `main` - Header navigation
- `footer` - Footer links
- `mobile` - Mobile-specific menu
- `sidebar` - Sidebar navigation

## Troubleshooting

### Blocks Not Showing
1. Ensure blocks are marked as active
2. Check page_block assignments exist
3. Verify page_type matches your view

### Menu Not Updating
1. Clear view cache: `php artisan view:clear`
2. Check menu is_active status
3. Verify menu location matches

### Theme Changes Not Applied
1. Clear cache: `php artisan cache:clear`
2. Ensure theme is marked as active/default
3. Hard refresh browser (Ctrl+F5)

## Next Steps

- [ ] Create more block templates (gallery, video, contact form)
- [ ] Add block preview functionality
- [ ] Implement drag-and-drop block ordering
- [ ] Add multi-language support for menus/blocks
- [ ] Create additional themes
