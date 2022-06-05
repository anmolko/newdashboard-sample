<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('professionals')->nullable()->after('privacy_policy');
            $table->string('projects')->nullable()->after('privacy_policy');
            $table->string('clients')->nullable()->after('privacy_policy');
            $table->string('online')->nullable()->after('privacy_policy');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('professionals');
            $table->dropColumn('projects');
            $table->dropColumn('clients');
            $table->dropColumn('online');
        });
    }
}
