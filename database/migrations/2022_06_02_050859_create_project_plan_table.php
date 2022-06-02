<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('price');
            $table->enum('type',['monthly','yearly','personal','commercial'])->nullable();
            $table->longText('description');
            $table->string('link')->nullable();
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
        Schema::dropIfExists('project_plan');
    }
}
