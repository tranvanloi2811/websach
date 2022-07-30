<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiethoadon', function (Blueprint $table) {
            $table->id();
            $table->float('GiaBan');
            $table->integer('SoLuong');
            $table->bigInteger('id_HoaDon')->unsigned();
            $table->foreign('id_HoaDon')->references('id')->on('hoadon')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('id_Sach')->unsigned();
            $table->foreign('id_Sach')->references('id')->on('sach')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('chitiethoadon');
    }
}
