<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('TemplateID');
            $table->longbolb('TheImg');
            $table->float('dst_x')->default('28');//x-coordinate of destination point.
            $table->float('dst_y')->default('90');//y-coordinate of destination point.
            $table->float('dst_w')->default('500');//Destination width.
            $table->float('dst_h')->default('350');//Destination height.
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
        Schema::dropIfExists('template_imgs');
    }
}
