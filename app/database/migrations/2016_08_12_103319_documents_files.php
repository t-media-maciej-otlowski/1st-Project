<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentsFiles extends Migration {

    use SoftDeletingTrait;

    public function up() {
        Schema::create('documents_files', function($table) {
            $table->increments('id');
            $table->integer('documents__id');
            $table->string('name');
            $table->string('fullname');
            $table->string('extension');
            $table->string('hash');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('documents_files');
    }

}
