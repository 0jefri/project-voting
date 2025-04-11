<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('votings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ketua_id');  // Relasi ke ketua
            $table->unsignedBigInteger('wakil_ketua_id');  // Relasi ke wakil ketua
            $table->string('kandidat');
            $table->integer('nilai');
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('ketua_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('wakil_ketua_id')->references('id')->on('users')->onDelete('cascade');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votings');
    }
};
