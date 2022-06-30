<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillboardToHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->string('billboard_image')->nullable()->before('welcome_heading');
            $table->string('billboard_title')->nullable()->before('welcome_heading');
            $table->text('billboard_description')->nullable()->before('welcome_heading');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn('billboard_image');
            $table->dropColumn('billboard_title');
            $table->dropColumn('billboard_description');

        });
    }
}
