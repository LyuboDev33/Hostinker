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
        Schema::create('user_hosting', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('hosting_plan_id')
                ->constrained('hosting_plans')
                ->restrictOnDelete();

            $table->foreignId('vps_id')
                ->constrained('vps')
                ->restrictOnDelete();

            $table->unsignedInteger('storage_gb');

            // Stripe subscription
            $table->string('stripe_subscription_id')->nullable()->unique();

            // Hosting lifecycle
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('last_paid_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('deletion_due_at')->nullable();
            $table->timestamp('resources_deleted_at')->nullable();

            // pending, active, suspended, deleting, deleted, failed
            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(['status', 'expires_at']);
            $table->index(['status', 'deletion_due_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_hostings');
    }
};
