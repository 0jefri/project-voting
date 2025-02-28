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
        Schema::table('kandidat_bem', function (Blueprint $table) {
            $table->string('foto')->after('wakil_ketua_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kandidat_bem', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
