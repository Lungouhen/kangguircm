<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('meta')->nullable(); // SEO meta, custom fields
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->text('description')->nullable();
            $table->string('type')->default('post'); // post, service, product
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('featured_image')->nullable();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->json('meta')->nullable(); // SEO meta
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('new'); // new, read, replied, archived
            $table->ipAddress('ip_address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('source')->default('website'); // website, referral, social
            $table->string('status')->default('new'); // new, contacted, qualified, converted, lost
            $table->text('notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('follow_up_at')->nullable();
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->default('full-time'); // full-time, part-time, contract, remote
            $table->string('department')->nullable();
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_listings')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('resume_path');
            $table->string('cover_letter_path')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, reviewed, interviewed, offered, rejected
            $table->text('notes')->nullable();
            $table->json('parsed_skills')->nullable();
            $table->text('parsed_experience')->nullable();
            $table->decimal('match_score', 5, 2)->nullable();
            $table->boolean('is_auto_rejected')->default(false);
            $table->timestamps();
        });

        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('subscribed_at')->useCurrent();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, boolean, json, file
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Add permissions to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('newsletters');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('services');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'avatar', 'is_active']);
        });
    }
};
