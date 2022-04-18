<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('slug')->after('name');
            $table->text('fb')->nullable()->after('gender');
            $table->text('insta')->nullable()->after('gender');
            $table->text('twitter')->nullable()->after('gender');
            $table->text('linkedin')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('fb');
            $table->dropColumn('insta');
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
        });
    }
}
