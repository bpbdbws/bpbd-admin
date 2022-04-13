<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDesaKecamatanAlamatToBeritaBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita_bencana', function (Blueprint $table) {
            $table->bigInteger('desa_id')->nullable()->after('status');
            $table->bigInteger('kecamatan_id')->nullable()->after('desa_id');
            $table->text('alamat')->nullable()->after('kecamatan_id');
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
            $table->dropColumn(['desa_id','kecamatan_id','alamat']);
        });
    }
}
