<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contracts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (Schema::hasTable('contracts')) {
            // remove all elements from contracts
            DB::table('contracts')->trancate();
            //delete
            Schema::dropIfExists('contracts');

            Schema::create('contracts', function($table) {
                $table->increments('id');
                $table->string('object_id');
                $table->integer('contractors__id');
                $table->string('contract_number');
                $table->string('enquiry_number');
                $table->timestamp('enquiry_received_at');
                $table->string('offer_number');
                $table->timestamp('offer_send_at');
                $table->timestamp('offer_valid_to');
                $table->timestamp('offer_approved_at');
                $table->double('offer_value', 15, 2);
                $table->string('offer_value_currency', 3);

                $table->string('protocol_number');
                $table->datetime('protocol_created_at');

                $table->string('invoice_number');
                $table->datetime('invoice_created_at');
                $table->datetime('invoice_payment_to');

                $table->text('description');

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('contracts');
    }

}
