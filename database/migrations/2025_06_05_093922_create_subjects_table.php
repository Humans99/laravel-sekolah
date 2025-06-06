<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['Matematika', 'IPA', "IPS", "Bahasa Indonesia", 'Bahasa Inggris', 'Seni Budaya', 'PJOK', 'PKN', 'Pendidikan Agama']);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
