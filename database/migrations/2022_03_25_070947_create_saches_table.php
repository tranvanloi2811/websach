<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sach', function (Blueprint $table) {
            $table->id();
            $table->string('TenSach');
            $table->string('TacGia');
            $table->float('GiaBan');
            $table->string('Img_Sach');
            $table->bigInteger('id_NhaXB')->unsigned();
            $table->bigInteger('id_LoaiSach')->unsigned();
            $table->foreign('id_NhaXB')->references('id')->on('nhaxuatban')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_LoaiSach')->references('id')->on('loaisach')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sach');
    }
}
