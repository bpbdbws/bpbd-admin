<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdKategoriBencanaToBeritaBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita_bencana', function (Blueprint $table) {
            $table->bigInteger('id_kategori_bencana', false, true)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita_bencana', function (Blueprint $table) {
            $table->bigInteger('id_kategori_bencana', false, true)->nullable(false)->change();
        });
    }
}
