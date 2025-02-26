<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kandidat_bem', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('usia');
        });
    }

    public function down()
    {
        Schema::table('kandidat_bem', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

