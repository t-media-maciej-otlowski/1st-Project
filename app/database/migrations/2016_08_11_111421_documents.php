<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Documents extends Eloquent {

    use SoftDeletingTrait;

    public function up() {
        Schema::create('documents', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('documents_groups__id');
            $table->string('description');
            $table->string('type');
            $table->integer('order_number');
            $table->integer('user__id');
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    public function down() {
        Schema::drop('documents');
    }

}
