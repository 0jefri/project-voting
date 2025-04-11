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
            $table->boolean('is_acc')->default(false);
        });
    }

    public function down()
    {
        Schema::table('kandidat_bem', function (Blueprint $table) {
            $table->dropColumn('is_acc');
        });
    }

};
