<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentsGroups extends Eloquent {

    /**
     * Run the migrations.
     *
     * @return void

     */
    use SoftDeletingTrait;

    public function up() {
        Schema::create('documents_groups', function($table) {
            $table->increments('id');
            $table->integer('id_parent')->nullable();
            $table->string('name');
            $table->string('description');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('documents_groups');
    }

}
