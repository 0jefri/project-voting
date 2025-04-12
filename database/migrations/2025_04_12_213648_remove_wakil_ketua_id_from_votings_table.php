<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveWakilKetuaIdFromVotingsTable extends Migration
{
    public function up()
    {
        Schema::table('votings', function (Blueprint $table) {
            $table->dropColumn('wakil_ketua_id');
        });
    }

    public function down()
    {
        Schema::table('votings', function (Blueprint $table) {
            $table->unsignedBigInteger('wakil_ketua_id')->nullable();
            // Jika sebelumnya ada foreign key, tambahkan kembali:
            // $table->foreign('wakil_ketua_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

