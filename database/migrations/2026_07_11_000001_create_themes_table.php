<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
            
            // Color configuration (JSON)
            $table->json('colors')->nullable()->comment('Primary, secondary, accent colors');
            
            // Typography configuration (JSON)
            $table->json('typography')->nullable()->comment('Font families, sizes');
            
            // Layout configuration (JSON)
            $table->json('layout')->nullable()->comment('Container width, spacing, border radius');
            
            // Custom CSS/JS
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            
            // Logo overrides
            $table->string('logo_light')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            
            $table->timestamps();
        });
        
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->index(); // header, footer, sidebar
            $table->string('menu_type')->default('standard'); // standard, mega-menu
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->nullOnDelete();
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->json('route_parameters')->nullable();
            $table->string('target')->default('_self'); // _self, _blank
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_mega_menu')->default(false);
            $table->text('mega_menu_content')->nullable(); // HTML/Rich text for mega menu content
            $table->timestamps();
        });
        
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->index(); // hero, features, cta, testimonials, faq, gallery, stats
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('content')->nullable(); // Block-specific content
            $table->json('styles')->nullable(); // Block-specific styles
            $table->string('background_type')->default('none'); // none, color, gradient, image
            $table->string('background_value')->nullable();
            $table->string('padding')->default('py-16'); // Tailwind padding class
            $table->string('layout_variant')->default('standard'); // standard, alternating, grid-3, grid-4, full-width
            $table->timestamps();
        });
        
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('page_type')->index(); // home, about, services, custom
            $table->string('page_identifier')->nullable(); // For dynamic pages like service slug
            $table->foreignId('block_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['page_type', 'page_identifier', 'block_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_blocks');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('themes');
    }
};
