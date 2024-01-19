<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameAndNicknameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add unique 'user_name' field
            $table->string('user_name')->unique();

            // Add nullable 'nick_name' field
            $table->string('nick_name')->nullable();
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
            // Reverse the changes (remove 'user_name' and 'nick_name' fields)
            $table->dropColumn('user_name');
            $table->dropColumn('nick_name');
        });
    }
}
