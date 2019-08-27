<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plat', function (Blueprint $table) {
            $table->bigIncrements('id_plat')->unsigned();
            $table->string('name', 100)->default('Default');
            $table->string('description', 191)->nullable()->default('Default description');
            $table->double('price', 15, 8)->default(00.00);
            $table->timestamps();

            /*$table->foreign('id_plat')->references('id_plat')->on('commandplat')->onDelete('cascade');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plat');
    }
}
