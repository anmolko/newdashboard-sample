<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->string('welcome_heading')->nullable();
            $table->string('welcome_subheading')->nullable();
            $table->text('welcome_description')->nullable();
            $table->string('welcome_image')->nullable();
            $table->string('welcome_side_image')->nullable();
            $table->string('direction_heading')->nullable();
            $table->text('direction_description')->nullable();
            $table->string('direction_list_heading')->nullable();
            $table->text('direction_list_description')->nullable();
            $table->string('direction_list_image')->nullable();
            $table->string('direction_displaying_side_image')->nullable();
            $table->string('direction_container_color')->nullable();
            
            $table->string('background_heading')->nullable();
            $table->string('background_subheading')->nullable();
            $table->text('background_description')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_side_image')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('homepages');
    }
}
