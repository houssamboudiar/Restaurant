<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandPlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandplat', function (Blueprint $table) {
            $table->bigIncrements('id_command');
            $table->bigInteger('id_plat')->default(20);
            $table->integer('quantity')->unsigned()->nullable()->default(12);
            $table->double('price', 15, 8)->nullable()->default(00.00);
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
        Schema::dropIfExists('commandplat');
    }
}
