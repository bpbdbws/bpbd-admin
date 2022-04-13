<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotosAndLinkEmbedToKategoriBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategori_bencana', function (Blueprint $table) {
            $table->string('photos')->nullable()->after('mitigasi');
            $table->binary('link_embed')->nullable()->after('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategori_bencana', function (Blueprint $table) {
            //
        });
    }
}
