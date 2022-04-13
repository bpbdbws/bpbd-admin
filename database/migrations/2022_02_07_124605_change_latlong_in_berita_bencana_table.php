<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLatlongInBeritaBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita_bencana', function (Blueprint $table) {
            $table->text('longitude')->change();
            $table->text('latitude')->change();
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
            $table->bigInteger('longitude')->change();
            $table->bigInteger('latitude')->change();
        });
    }
}
