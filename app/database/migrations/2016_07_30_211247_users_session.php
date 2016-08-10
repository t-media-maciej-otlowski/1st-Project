<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersSession extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_session', function($table) {
            $table->increments('userSessionId');
            $table->Integer('userId');
            $table->String('hash', 255);
            $table->timestamps();
            $table->timestamp('start_at');
            $table->timestamp('finish_at');
           
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users_session');
    }

}
