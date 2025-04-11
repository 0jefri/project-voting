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
        Schema::table('votings', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['ketua_id']);
            $table->dropForeign(['wakil_ketua_id']);
        });
    }

    public function down()
    {
        Schema::table('votings', function (Blueprint $table) {
            // Untuk rollback, tambahkan kembali foreign key
            $table->foreign('ketua_id')->references('id')->on('users');
            $table->foreign('wakil_ketua_id')->references('id')->on('users');
        });
    }
};
