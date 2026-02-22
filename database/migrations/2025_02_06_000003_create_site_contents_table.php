<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // home, about, contact, header, footer, blog_list, blog_post vb.
            $table->string('key')->unique(); // header_logo, hero_title, hero_image, footer_text vb.
            $table->string('label'); // Admin panelde görünen isim
            $table->string('type')->default('text'); // text, textarea, image
            $table->text('value')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};
