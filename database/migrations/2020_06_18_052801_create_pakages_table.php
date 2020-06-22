<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePakagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('PakageName');
            $table->unsignedInteger('TemplateID');
            $table->string('PakageInfo');
            $table->float('PakagePrice');
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
        Schema::dropIfExists('pakages');
    }
}
