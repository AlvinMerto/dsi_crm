<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::create("sales_quotes_item_add_info", function(Blueprint $table) {
        Schema::create("salessubs", function(Blueprint $table) {
            $table->id();
            $table->string("quoteid");
            $table->string("grpid");
            $table->string("description")->nullable();
            $table->string("quantity")->nullable();
            $table->string("price")->nullable();
            $table->string("extended")->nullable();
            $table->string("shippingfee")->nullable();
            $table->string("tax")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
