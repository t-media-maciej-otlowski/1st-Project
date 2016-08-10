<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Eloquent {

    public function up() {

        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname'); // ->after('id')
            $table->string('username');
            $table->string('password');  // ->nullable()   , default('')
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        
        Schema::drop('users');
     
    }

}
