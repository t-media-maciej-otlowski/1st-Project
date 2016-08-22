<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentsAttributes extends Eloquent {

    use SoftDeletingTrait;

    public function up() {
        Schema::create('documents_attributes', function($table) {
            $table->increments('id');
            $table->integer('documents__id');
            $table->string('name');
            $table->text('value');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('documents_attributes');
    }

}
