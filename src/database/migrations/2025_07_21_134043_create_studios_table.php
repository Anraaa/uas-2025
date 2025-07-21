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
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('nama_studio');
            $table->text('deskripsi')->nullable();
            $table->integer('harga_per_jam');
            $table->string('foto')->nullable();
            $table->text('fasilitas')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('kapasitas')
                ->default(10)
                ->comment('Kapasitas maksimum orang dalam studio');
            $table->string('jam_operasional')
                ->default('09:00 - 21:00')
                ->comment('Jam operasional studio, contoh: 09:00-21:00');
            $table->string('hari_operasional')
                ->default('Senin-Minggu')
                ->comment('Hari operasional studio, contoh: Senin-Minggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};
