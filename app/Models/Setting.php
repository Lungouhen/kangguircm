<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting
{
    protected static $cacheKey = 'app_settings';
    protected static $filePath = 'settings.json';

    /**
     * Get a setting value by key (supports dot notation)
     */
    public static function get(string $key, $default = null)
    {
        $settings = self::all();
        return data_get($settings, $key, $default);
    }

    /**
     * Set a setting value by key (supports dot notation)
     */
    public static function set(string $key, $value): bool
    {
        $settings = self::all();
        data_set($settings, $key, $value);
        return self::save($settings);
    }

    /**
     * Get all settings
     */
    public static function all(): array
    {
        return Cache::rememberForever(self::$cacheKey, function () {
            if (!Storage::disk('public')->exists(self::$filePath)) {
                return self::defaults();
            }
            
            $content = Storage::disk('public')->get(self::$filePath);
            return json_decode($content, true) ?? self::defaults();
        });
    }

    /**
     * Save settings to file
     */
    protected static function save(array $settings): bool
    {
        Cache::forget(self::$cacheKey);
        
        $directory = dirname(self::$filePath);
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }
        
        return Storage::disk('public')->put(self::$filePath, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Get default settings structure
     */
    public static function defaults(): array
    {
        return [
            'website' => [
                'name' => 'Kanggui RCM',
                'tagline' => 'Recruitment & Consulting Excellence',
                'description' => 'Leading recruitment and consulting firm connecting talent with opportunity.',
                'logo' => null,
                'favicon' => null,
                'copyright_year' => date('Y'),
                'timezone' => 'UTC',
                'locale' => 'en',
            ],
            'contact' => [
                'email' => 'info@kanggui.com',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Business Street, City, Country',
                'latitude' => null,
                'longitude' => null,
                'social_media' => [
                    'linkedin' => null,
                    'twitter' => null,
                    'facebook' => null,
                    'instagram' => null,
                ],
            ],
            'business' => [
                'hours' => [
                    'monday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
                    'tuesday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
                    'wednesday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
                    'thursday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
                    'friday' => ['open' => '09:00', 'close' => '17:00', 'enabled' => true],
                    'saturday' => ['open' => null, 'close' => null, 'enabled' => false],
                    'sunday' => ['open' => null, 'close' => null, 'enabled' => false],
                ],
                'holiday_mode' => false,
                'holiday_message' => 'We are currently closed for holidays. We will respond when we return.',
            ],
            'seo' => [
                'meta_title' => 'Kanggui RCM - Recruitment & Consulting',
                'meta_description' => 'Professional recruitment and consulting services.',
                'meta_keywords' => 'recruitment, consulting, jobs, careers, HR',
                'og_image' => null,
                'google_analytics_id' => null,
                'google_tag_manager_id' => null,
            ],
            'features' => [
                'enable_blog' => true,
                'enable_careers' => true,
                'enable_contact_form' => true,
                'enable_newsletter' => false,
                'maintenance_mode' => false,
                'maintenance_message' => 'Site is under maintenance. Please check back soon.',
            ],
        ];
    }

    /**
     * Reset settings to defaults
     */
    public static function reset(): bool
    {
        return self::save(self::defaults());
    }

    /**
     * Clear cache
     */
    public static function clearCache(): void
    {
        Cache::forget(self::$cacheKey);
    }
}
