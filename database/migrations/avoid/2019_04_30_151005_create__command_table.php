<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('entre')->unsigned();
            $table->bigInteger('plat')->unsigned();
            $table->bigInteger('dessert')->unsigned();


            $table->enum('status', ['Pending','Canceled', 'Submitted','Finished']);
            $table->enum('type_command', ['Indoors','Outdoors']);
            $table->timestamps();
            $table->double('price', 15, 8)->nullable()->default(00.00);

            /*$table->foreign('entre')->references('id_command')->on('commandplat')->onDelete('cascade');
            $table->foreign('plat')->references('id_command')->on('commandplat')->onDelete('cascade');
            $table->foreign('dessert')->references('id_command')->on('commandplat')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command');
    }
}
