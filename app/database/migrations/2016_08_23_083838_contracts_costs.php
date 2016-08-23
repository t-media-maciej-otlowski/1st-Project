<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContractsCosts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contracts_costs', function($table) {
            $table->increments('id');
            $table->string('contracts__object_id');
            $table->string('type', 255);
            $table->double('value', 15, 2);
            $table->string('value_currency', 4);
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
        Schema::drop('contracts_costs');
    }

}
