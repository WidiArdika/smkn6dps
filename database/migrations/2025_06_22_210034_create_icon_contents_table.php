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
        Schema::create('icon_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // "Jumlah Jurusan"
            $table->text('description');    // "Memiliki 6 Jumlah Jurusan"
            $table->string('icon');         // "book-open"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icon_contents');
    }
};
