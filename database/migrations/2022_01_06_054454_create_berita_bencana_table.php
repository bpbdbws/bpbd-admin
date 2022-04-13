<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_bencana', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->bigInteger('id_kategori_bencana', false, true);
            $table->binary('deskripsi')->nullable();
            $table->string('longitude', 15)->nullable();
            $table->string('latitude', 15)->nullable();
            $table->string('gambar')->nullable();
            $table->bigInteger('id_admin', false, true)->nullable();
            $table->bigInteger('id_user', false, true)->nullable();
            $table->enum('status', ['accept', 'pending', 'declined'])->nullable();
            $table->timestamps();

            $table->foreign('id_kategori_bencana')->references('id')->on('kategori_bencana')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_admin')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita_bencana');
    }
}
