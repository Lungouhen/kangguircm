<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\JobListing;
use App\Models\Setting;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Company News', 'slug' => 'company-news', 'description' => 'Latest updates and news from Kanggui RCM'],
            ['name' => 'Industry Insights', 'slug' => 'industry-insights', 'description' => 'Expert analysis and trends in mining and construction'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Innovations in heavy equipment and machinery'],
            ['name' => 'Safety', 'slug' => 'safety', 'description' => 'Best practices and safety guidelines'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Create Services
        $services = [
            [
                'name' => 'Equipment Rental',
                'slug' => 'equipment-rental',
                'description' => 'We provide comprehensive equipment rental services for mining and construction projects. Our fleet includes excavators, bulldozers, loaders, and specialized machinery.',
                'icon' => 'fa-truck',
                'meta' => json_encode([
                    'features' => [
                        'Flexible rental periods',
                        'Well-maintained equipment',
                        '24/7 technical support',
                        'Competitive pricing'
                    ]
                ])
            ],
            [
                'name' => 'Maintenance & Repair',
                'slug' => 'maintenance-repair',
                'description' => 'Our expert technicians provide comprehensive maintenance and repair services to keep your equipment running at peak performance.',
                'icon' => 'fa-tools',
                'meta' => json_encode([
                    'features' => [
                        'Preventive maintenance',
                        'Emergency repairs',
                        'Genuine parts',
                        'Certified technicians'
                    ]
                ])
            ],
            [
                'name' => 'Parts Supply',
                'slug' => 'parts-supply',
                'description' => 'We supply authentic spare parts for all major heavy equipment brands, ensuring reliability and longevity for your machinery.',
                'icon' => 'fa-cogs',
                'meta' => json_encode([
                    'features' => [
                        'OEM parts',
                        'Fast delivery',
                        'Wide inventory',
                        'Quality guarantee'
                    ]
                ])
            ],
            [
                'name' => 'Operator Training',
                'slug' => 'operator-training',
                'description' => 'Comprehensive training programs for equipment operators, focusing on safety, efficiency, and best practices.',
                'icon' => 'fa-chalkboard-teacher',
                'meta' => json_encode([
                    'features' => [
                        'Certified trainers',
                        'Hands-on practice',
                        'Safety certification',
                        'Customized programs'
                    ]
                ])
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }

        // Create Blog Posts
        $posts = [
            [
                'title' => 'Kanggui RCM Expands Fleet with Latest Excavator Models',
                'slug' => 'kanggui-rcm-expands-fleet',
                'excerpt' => 'We are excited to announce the addition of 10 new state-of-the-art excavators to our rental fleet.',
                'content' => 'Kanggui RCM continues to invest in modern equipment to serve our clients better. The new excavators feature advanced fuel efficiency, enhanced safety systems, and improved operational comfort. These machines are now available for rental across all our locations.',
                'author_id' => 1,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Safety First: New Guidelines for Heavy Equipment Operation',
                'slug' => 'safety-first-guidelines',
                'excerpt' => 'Learn about the latest safety protocols we have implemented for all equipment operations.',
                'content' => 'Safety remains our top priority. We have updated our operational guidelines to incorporate the latest industry best practices. All operators must complete the new safety certification program before operating any equipment.',
                'author_id' => 1,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Industry Trends: The Future of Mining Equipment',
                'slug' => 'future-mining-equipment',
                'excerpt' => 'Exploring emerging technologies that are reshaping the mining and construction industry.',
                'content' => 'The mining industry is undergoing a technological revolution. From autonomous vehicles to AI-powered predictive maintenance, discover how these innovations are improving efficiency and safety in operations worldwide.',
                'author_id' => 1,
                'published_at' => Carbon::now()->subDays(15),
            ],
        ];

        foreach ($posts as $post) {
            $category = Category::inRandomOrder()->first();
            $postData = array_merge($post, ['category_id' => $category->id]);
            Post::firstOrCreate(['slug' => $post['slug']], $postData);
        }

        // Create Job Listings
        $jobs = [
            [
                'title' => 'Heavy Equipment Mechanic',
                'slug' => 'heavy-equipment-mechanic',
                'department' => 'Maintenance',
                'location' => 'On-site',
                'type' => 'full-time',
                'salary_min' => 60000,
                'salary_max' => 80000,
                'description' => 'We are seeking an experienced mechanic to join our maintenance team. Requirements: 5+ years experience with heavy equipment, Valid certifications, Strong diagnostic skills, Ability to work in remote locations.',
                'requirements' => json_encode([
                    '5+ years experience with heavy equipment',
                    'Valid certifications',
                    'Strong diagnostic skills',
                    'Ability to work in remote locations'
                ]),
                'is_active' => true,
            ],
            [
                'title' => 'Equipment Operator',
                'slug' => 'equipment-operator',
                'department' => 'Operations',
                'location' => 'Multiple Locations',
                'type' => 'full-time',
                'salary_min' => 50000,
                'salary_max' => 70000,
                'description' => 'Looking for skilled operators for various heavy machinery. Requirements: Valid operator license, 3+ years operating experience, Safety certification, Physical fitness.',
                'requirements' => json_encode([
                    'Valid operator license',
                    '3+ years operating experience',
                    'Safety certification',
                    'Physical fitness'
                ]),
                'is_active' => true,
            ],
            [
                'title' => 'Site Supervisor',
                'slug' => 'site-supervisor',
                'department' => 'Management',
                'location' => 'Project Sites',
                'type' => 'full-time',
                'salary_min' => 70000,
                'salary_max' => 90000,
                'description' => 'Experienced supervisor needed to manage field operations. Requirements: 7+ years in mining/construction, Leadership experience, Strong communication skills, Problem-solving abilities.',
                'requirements' => json_encode([
                    '7+ years in mining/construction',
                    'Leadership experience',
                    'Strong communication skills',
                    'Problem-solving abilities'
                ]),
                'is_active' => true,
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::firstOrCreate(['slug' => $job['slug']], $job);
        }

        // Create Company Settings
        $settings = [
            ['key' => 'company_email', 'value' => 'info@kangguircm.com'],
            ['key' => 'company_phone', 'value' => '+1 (555) 123-4567'],
            ['key' => 'company_address', 'value' => '123 Industrial Park, Mining City, MC 12345'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/kangguircm'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/kangguircm'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/kangguircm'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        $this->command->info('Content seeded successfully!');
    }
}
