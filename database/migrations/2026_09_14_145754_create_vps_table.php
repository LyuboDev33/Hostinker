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
        Schema::create('vps', function (Blueprint $table) {
            $table->id();

            $table->string('host')->unique();
            $table->unsignedSmallInteger('port')->default(22);
            $table->string('username');
            $table->text('password');

            $table->unsignedInteger('capacity_gb');
            $table->boolean('is_vps_full')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_p_s');
    }
};
