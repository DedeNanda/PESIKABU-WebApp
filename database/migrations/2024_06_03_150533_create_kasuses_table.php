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
        Schema::create('kasuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('nama_pelapor');
            $table->string('no_hp')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->string('tempat_kejadian');
            $table->text('deskripsi_kejadian');
            $table->text('bukti')->nullable();
            $table->string('nama_korban')->nullable();
            $table->string('nama_pelaku')->nullable();
            $table->string('nama_saksi')->nullable();
            $table->string('jenis_kasus')->nullable()->default(null);
            $table->text('tindak_lanjut')->nullable()->default(null);
            $table->enum('status_kasus', ['Terkirim', 'Dibaca', 'Diproses', 'Penyelesaian', 'Selesai'])->default('Terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasuses');
    }
};
