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
        Schema::create("sales_quotes_item_info_more_flds", function(Blueprint $table){
            $table->id();
            $table->string("itemid");
            $table->string("product_services_id");
            $table->string("shippingfee")->nullable();
            $table->date("endoflife")->nullable();
            $table->enum("markupstatus",['approved','for approval','declined']);
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
