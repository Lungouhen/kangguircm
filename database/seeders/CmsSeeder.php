<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Block;
use App\Models\PageBlock;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // Create default theme
        $theme = Theme::create([
            'name' => 'Default Theme',
            'slug' => 'default',
            'description' => 'Default Bixoo-inspired theme',
            'is_active' => true,
            'is_default' => true,
            'colors' => [
                'primary' => '#2563EB',
                'secondary' => '#1E40AF',
                'accent' => '#F59E0B',
            ],
            'typography' => [
                'heading' => 'Instrument Serif',
                'body' => 'Instrument Sans',
            ],
            'layout' => [
                'container' => 'max-w-7xl',
                'spacing' => 'py-16',
            ],
        ]);

        // Create main navigation menu with mega-menu support
        $mainMenu = Menu::create([
            'name' => 'Main Navigation',
            'location' => 'header',
            'menu_type' => 'mega-menu',
            'is_active' => true,
        ]);

        $menuItems = [
            ['title' => 'Home', 'url' => '/', 'order' => 1],
            ['title' => 'About', 'url' => '/about', 'order' => 2],
            [
                'title' => 'Services',
                'url' => '/services',
                'order' => 3,
                'is_mega_menu' => true,
                'mega_menu_content' => '<div class="grid grid-cols-3 gap-6 p-6"><div><h4 class="font-bold mb-2">Our Services</h4><p class="text-sm text-gray-600">Comprehensive RCM solutions</p></div><div><ul class="space-y-2"><li><a href="/services#claims" class="hover:text-primary">Claim Processing</a></li><li><a href="/services#denials" class="hover:text-primary">Denial Management</a></li><li><a href="/services#billing" class="hover:text-primary">Medical Billing</a></li></ul></div><div><ul class="space-y-2"><li><a href="/services#coding" class="hover:text-primary">Medical Coding</a></li><li><a href="/services#compliance" class="hover:text-primary">Compliance</a></li><li><a href="/services#analytics" class="hover:text-primary">Analytics</a></li></ul></div></div>',
                'children' => [
                    ['title' => 'All Services', 'url' => '/services', 'order' => 1],
                    ['title' => 'Claim Processing', 'url' => '/services#claims', 'order' => 2],
                    ['title' => 'Denial Management', 'url' => '/services#denials', 'order' => 3],
                    ['title' => 'Medical Billing', 'url' => '/services#billing', 'order' => 4],
                    ['title' => 'Medical Coding', 'url' => '/services#coding', 'order' => 5],
                ]
            ],
            ['title' => 'Blog', 'url' => '/blog', 'order' => 4],
            ['title' => 'Careers', 'url' => '/careers', 'order' => 5],
            ['title' => 'Contact', 'url' => '/contact', 'order' => 6],
        ];

        foreach ($menuItems as $itemData) {
            $children = $itemData['children'] ?? [];
            $isMegaMenu = $itemData['is_mega_menu'] ?? false;
            $megaMenuContent = $itemData['mega_menu_content'] ?? null;
            unset($itemData['children'], $itemData['is_mega_menu'], $itemData['mega_menu_content']);
            
            $parent = MenuItem::create($itemData + [
                'menu_id' => $mainMenu->id,
                'is_mega_menu' => $isMegaMenu,
                'mega_menu_content' => $megaMenuContent,
            ]);
            
            foreach ($children as $childData) {
                MenuItem::create($childData + ['menu_id' => $mainMenu->id, 'parent_id' => $parent->id]);
            }
        }

        // Create sample blocks for home page
        $heroBlock = Block::create([
            'name' => 'Home Hero Section',
            'type' => 'hero',
            'layout_variant' => 'standard',
            'slug' => 'home-hero',
            'description' => 'Main hero section for homepage',
            'is_active' => true,
            'content' => json_encode([
                'title' => 'Optimize Your Revenue Cycle with Confidence',
                'subtitle' => 'Professional RCM Solutions',
                'description' => 'Professional RCM solutions that help healthcare providers maximize revenue, reduce denials, and focus on what matters most—patient care.',
                'cta_text' => 'Get Started Free',
                'cta_link' => '/contact',
                'centered' => true,
            ]),
            'background_type' => 'gradient',
            'background_value' => 'from-blue-600 to-blue-800',
            'padding' => 'py-24 md:py-32',
        ]);

        $statsBlock = Block::create([
            'name' => 'Key Statistics',
            'type' => 'stats',
            'layout_variant' => 'grid-4',
            'slug' => 'home-stats',
            'description' => 'Statistics counter section',
            'is_active' => true,
            'json_data' => json_encode([
                'stats' => [
                    ['value' => '98%', 'label' => 'Claim Acceptance Rate'],
                    ['value' => '30%', 'label' => 'Revenue Increase'],
                    ['value' => '24/7', 'label' => 'Support Available'],
                    ['value' => '500+', 'label' => 'Happy Clients'],
                ]
            ]),
            'padding' => 'py-16',
        ]);

        $featuresBlock = Block::create([
            'name' => 'Why Choose Us',
            'type' => 'features',
            'layout_variant' => 'alternating',
            'slug' => 'home-features',
            'description' => 'Features grid with alternating layout',
            'is_active' => true,
            'json_data' => json_encode([
                'items' => [
                    [
                        'icon' => '⚡',
                        'title' => 'Fast Implementation',
                        'description' => 'Get up and running quickly with our streamlined onboarding process.'
                    ],
                    [
                        'icon' => '✓',
                        'title' => '99% Accuracy',
                        'description' => 'Minimize errors and denials with our precision-focused approach.'
                    ],
                    [
                        'icon' => '$',
                        'title' => 'Increased Revenue',
                        'description' => 'Maximize your collections with our proven optimization strategies.'
                    ],
                    [
                        'icon' => '❤',
                        'title' => '24/7 Support',
                        'description' => 'Round-the-clock assistance whenever you need it.'
                    ],
                ]
            ]),
            'padding' => 'py-20',
        ]);

        $ctaBlock = Block::create([
            'name' => 'Final CTA',
            'type' => 'cta',
            'layout_variant' => 'full-width',
            'slug' => 'home-cta',
            'description' => 'Call-to-action section',
            'is_active' => true,
            'content' => json_encode([
                'title' => 'Ready to Transform Your Revenue Cycle?',
                'description' => 'Contact us today for a free consultation and discover how we can help your practice thrive.',
                'button_text' => 'Schedule Your Free Consultation',
                'button_link' => '/contact',
            ]),
            'background_type' => 'gradient',
            'background_value' => 'from-blue-600 to-blue-800',
            'padding' => 'py-20',
        ]);

        // Assign blocks to home page
        PageBlock::create(['page_type' => 'home', 'block_id' => $heroBlock->id, 'order' => 1]);
        PageBlock::create(['page_type' => 'home', 'block_id' => $statsBlock->id, 'order' => 2]);
        PageBlock::create(['page_type' => 'home', 'block_id' => $featuresBlock->id, 'order' => 3]);
        PageBlock::create(['page_type' => 'home', 'block_id' => $ctaBlock->id, 'order' => 4]);
    }
}
