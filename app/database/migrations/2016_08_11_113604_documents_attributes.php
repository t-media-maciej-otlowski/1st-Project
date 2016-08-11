<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentsAttributes extends Eloquent {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('documents_attributes', function($table) {
            $table->increments('documentAtributesId');
            $table->string('name');
            $table->string('description');
            $table->boolean('confirmed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('documents_attributtes');
    }

}
