<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->foreign('kandidat_id')->references('id')->on('kandidat_bem')->onDelete('cascade');

            // Akademik
            $table->integer('ipk');
            $table->integer('visi_misi');
            $table->integer('prestasi_akademik');

            // Non Akademik
            $table->integer('surat_rekomendasi');
            $table->integer('usia');
            $table->integer('keikutsertaan_organisasi');
            $table->integer('prestasi_non_akademik');

            // Sikap & Perilaku
            $table->integer('kepemimpinan');
            $table->integer('integritas');
            $table->integer('loyalitas');
            $table->integer('kerjasama');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
};

