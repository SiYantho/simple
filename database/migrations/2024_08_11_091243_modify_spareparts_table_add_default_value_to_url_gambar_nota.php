<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->string('url_gambar_nota')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->string('url_gambar_nota')->change();
        });
    }
};
