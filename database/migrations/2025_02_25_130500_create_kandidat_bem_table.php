<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kandidat_bem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ketua_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wakil_ketua_id')->constrained('users')->onDelete('cascade');
            $table->string('transkrip_nilai');
            $table->string('visi_misi');
            $table->string('prestasi_akademik');
            $table->string('surat_rekomendasi');
            $table->string('keikutsertaan_organisasi');
            $table->string('prestasi_non_akademik');
            $table->enum('usia', ['1', '2', '3']); // 1: 19-24, 2: >24, 3: <19
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kandidat_bem');
    }
};

