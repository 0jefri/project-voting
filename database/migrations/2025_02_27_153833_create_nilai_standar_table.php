<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('nilai_standar', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria'); // Nama kriteria
            $table->integer('nilai_ideal'); // Nilai ideal (standar)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_standar');
    }
};

