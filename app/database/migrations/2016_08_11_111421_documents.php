<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Documents extends Eloquent {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('documents', function($table) {
            $table->increments('documentId');
            $table->string('type');
            $table->string('documentAtributesId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('documents');
    }

}
