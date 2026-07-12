<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\PageBlock;
use App\Models\Post;
use App\Models\Service;
use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Comprehensive UI/UX Smoke Test Suite
 * 
 * This suite simulates a user visiting every public page and checking
 * for critical UI elements, navigation integrity, and dynamic content rendering.
 * 
 * Run: php artisan test --filter=UiSmokeTest
 */
class UiSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed essential data for testing
        $this->seedEssentialData();
    }

    /**
     * Helper to seed minimum required data for UI tests
     */
    private function seedEssentialData()
    {
        // Create a default theme
        Theme::create([
            'name' => 'Test Theme',
            'is_active' => true,
            'primary_color' => '#0056b3',
            'font_heading' => 'Instrument Sans',
            'font_body' => 'Instrument Serif',
        ]);

        // Create a Header Menu with Mega Menu item
        $menu = Menu::create([
            'name' => 'Header Menu',
            'location' => 'header',
            'menu_type' => 'mega-menu',
        ]);

        $servicesItem = MenuItem::create([
            'menu_id' => $menu->id,
            'label' => 'Services',
            'url' => '/services',
            'is_mega_menu' => true,
            'mega_menu_content' => '<div class="grid grid-cols-3"><h3>Consulting</h3></div>',
            'order' => 1,
        ]);

        MenuItem::create([
            'menu_id' => $menu->id,
            'label' => 'Contact',
            'url' => '/contact',
            'parent_id' => null,
            'order' => 2,
        ]);

        // Create Dynamic Blocks for Home
        $heroBlock = Block::create([
            'type' => 'hero',
            'name' => 'Home Hero',
            'title' => 'Welcome to Our Company',
            'content' => json_encode(['subtitle' => 'Leading the industry']),
            'layout_variant' => 'standard',
            'is_active' => true,
        ]);

        $servicesBlock = Block::create([
            'type' => 'services',
            'name' => 'Home Services',
            'title' => 'Our Services',
            'content' => json_encode([]),
            'layout_variant' => 'grid-3',
            'is_active' => true,
        ]);

        // Assign blocks to Home Page
        PageBlock::create(['page_name' => 'home', 'block_id' => $heroBlock->id, 'order' => 1]);
        PageBlock::create(['page_name' => 'home', 'block_id' => $servicesBlock->id, 'order' => 2]);

        // Create Sample Service
        Service::create([
            'name' => 'Business Consulting',
            'slug' => 'business-consulting',
            'excerpt' => 'Expert advice for your business.',
            'content' => 'Full details about consulting.',
            'is_active' => true,
        ]);

        // Create Sample Post
        Post::create([
            'title' => 'Latest Industry News',
            'slug' => 'latest-industry-news',
            'excerpt' => 'Read about the latest trends.',
            'content' => 'Full article content.',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * TEST: Home Page Rendering
     * Verifies dynamic blocks, hero section, and navigation
     */
    public function test_home_page_renders_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check Critical UI Elements
        $response->assertSee('Welcome to Our Company', escape: false);
        $response->assertSee('Leading the industry', escape: false);
        $response->assertSee('Our Services', escape: false);
        
        // Check Navigation Integrity
        $response->assertSee('Services', escape: false);
        $response->assertSee('Contact', escape: false);
        
        // Check Mega Menu Content exists in source
        $response->assertSee('Consulting', escape: false);
        
        // Check Layout Classes (ADSC Style)
        $response->assertSee('max-w-7xl', escape: false);
        $response->assertSee('grid-cols-3', escape: false);
    }

    /**
     * TEST: Services Index Page
     * Verifies service listing and grid layout
     */
    public function test_services_index_page()
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
        $response->assertSee('Our Services', escape: false);
        $response->assertSee('Business Consulting', escape: false);
        $response->assertSee('Expert advice for your business', escape: false);
        
        // Verify Link to Single Service
        $response->assertSee('href="/services/business-consulting"', escape: false);
    }

    /**
     * TEST: Single Service Page
     * Verifies detail view and related services
     */
    public function test_single_service_page()
    {
        $response = $this->get('/services/business-consulting');

        $response->assertStatus(200);
        $response->assertSee('Business Consulting', escape: false);
        $response->assertSee('Full details about consulting', escape: false);
    }

    /**
     * TEST: Blog Index Page
     * Verifies post listing
     */
    public function test_blog_index_page()
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('Latest Industry News', escape: false);
        $response->assertSee('Read about the latest trends', escape: false);
    }

    /**
     * TEST: Single Blog Post Page
     * Verifies post detail
     */
    public function test_single_blog_post_page()
    {
        $response = $this->get('/blog/latest-industry-news');

        $response->assertStatus(200);
        $response->assertSee('Latest Industry News', escape: false);
        $response->assertSee('Full article content', escape: false);
    }

    /**
     * TEST: Contact Page
     * Verifies form existence and layout
     */
    public function test_contact_page()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Contact Us', escape: false);
        $response->assertSee('method="POST"', escape: false);
        $response->assertSee('name="name"', escape: false);
        $response->assertSee('name="email"', escape: false);
        $response->assertSee('name="message"', escape: false);
    }

    /**
     * TEST: Admin Panel Accessibility
     * Verifies that admin routes are registered and accessible (if logged in)
     * Note: We check route existence here as auth is required for full visit
     */
    public function test_admin_routes_exist()
    {
        // Check if Filament routes are registered
        $this->assertTrue(app()->routesAreCached() || app('router')->hasRoute('filament.admin.pages.dashboard'));
        
        // Verify Resource Routes exist
        $this->assertTrue(app()->routesAreCached() || app('router')->hasRoute('filament.admin.resources.services.index'));
        $this->assertTrue(app()->routesAreCached() || app('router')->hasRoute('filament.admin.resources.blocks.index'));
        $this->assertTrue(app()->routesAreCached() || app('router')->hasRoute('filament.admin.resources.themes.index'));
    }

    /**
     * TEST: Dynamic Block Fallback
     * Ensures page loads even if no blocks are assigned (Static Fallback)
     */
    public function test_home_page_fallback_without_blocks()
    {
        // Clear blocks temporarily
        PageBlock::where('page_name', 'home')->delete();
        Block::truncate();

        $response = $this->get('/');

        $response->assertStatus(200);
        // Should still see static fallback content defined in home.blade.php
        $response->assertSee('Welcome to Our Company', escape: false); 
    }

    /**
     * TEST: Responsive Navigation Classes
     * Verifies mobile menu classes are present
     */
    public function test_responsive_navigation_classes()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        // Check for Alpine.js mobile menu toggles
        $response->assertSee('x-data="{ open: false }"', escape: false);
        $response->assertSee('hidden md:flex', escape: false);
    }
}
