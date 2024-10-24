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
        Schema::create('site_carrousel', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('description', 150)->nullable();
            $table->string('image', 255);
            $table->string('name_link', 100)->nullable();
            $table->string('url_link', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_carrousel');
    }
};
