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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_name')->default('MONO ARCHIVE');
            $table->string('store_tagline')->default('Katalog Produk Esensial Monokrom');
            $table->string('welcome_title')->default('Selamat Datang di Mono Archive');
            $table->text('welcome_subtitle')->nullable();
            $table->string('whatsapp_number')->default('6281234567890');
            $table->text('whatsapp_message_template');
            $table->string('store_address')->nullable();
            $table->string('store_email')->nullable();
            $table->string('instagram_handle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
