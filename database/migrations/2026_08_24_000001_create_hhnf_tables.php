<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('visitor')->index();
            $table->string('phone')->nullable();
        });

        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->string('photo_path')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('mobile', 20);
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 12)->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('blood_group', 8)->nullable();
            $table->json('areas_of_interest')->nullable();
            $table->string('availability', 40)->nullable();
            $table->text('experience')->nullable();
            $table->string('id_proof_path')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->boolean('consent')->default(false);
            $table->string('status', 20)->default('pending')->index();
            $table->string('volunteer_id')->nullable()->unique();
            $table->integer('hours_logged')->default(0);
            $table->date('valid_from')->nullable();
            $table->date('valid_till')->nullable();
            $table->text('rejection_note')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('banner_path')->nullable();
            $table->string('category', 40)->nullable();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->string('location')->nullable();
            $table->string('map_link')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('volunteers_required')->nullable();
            $table->string('volunteer_roles')->nullable();
            $table->boolean('registration_open')->default(true);
            $table->string('status', 20)->default('upcoming')->index();
            $table->timestamps();
        });

        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('volunteer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->unsignedInteger('people_count')->default(1);
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->string('priority', 10)->default('medium');
            $table->unsignedInteger('hours')->default(0);
            $table->timestamps();
        });

        Schema::create('task_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('pending')->index();
            $table->string('proof_path')->nullable();
            $table->text('proof_note')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category', 40)->nullable();
            $table->date('date')->nullable();
            $table->string('cover_path')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number')->unique();
            $table->string('type', 40);
            $table->foreignId('volunteer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('recipient_name');
            $table->string('recipient_email')->nullable();
            $table->string('reason')->nullable();
            $table->string('duration')->nullable();
            $table->date('issued_on');
            $table->string('signatory_name')->nullable();
            $table->string('signatory_designation')->nullable();
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique()->nullable();
            $table->string('donor_name');
            $table->string('email')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('pan', 20)->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('frequency', 20)->default('one_time');
            $table->string('cause', 60)->nullable();
            $table->string('method', 30)->default('upi');
            $table->string('status', 20)->default('pending')->index();
            $table->string('gateway_ref')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('person_type', 30);
            $table->string('related_to', 30);
            $table->unsignedTinyInteger('rating');
            $table->text('comments');
            $table->boolean('testimonial_consent')->default(false);
            $table->boolean('show_as_testimonial')->default(false);
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('cover_path')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->default('counter');
            $table->string('title');
            $table->string('value')->nullable();
            $table->string('icon', 60)->nullable();
            $table->string('image_path')->nullable();
            $table->string('link')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('task_volunteer');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
        Schema::dropIfExists('volunteers');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone']);
        });
    }
};
