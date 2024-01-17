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
        Schema::create('sales_quotes_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id')->default(0);
            $table->string('type')->nullable();
            $table->integer('profit')->default(0);
            $table->integer('totalmaincost')->default(0);
            $table->integer('markup')->default(0);
            $table->integer('purchase_price')->default(0);
            $table->string('item')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
            $table->integer('extended')->default(0);
            $table->string('tax')->nullable();
            $table->integer('itemtaxprice')->default(0);
            $table->integer('itemtaxrate')->default(0);
            $table->integer('amount')->default(0);
            $table->string('subtotal_description')->nullable();
            $table->string('subtotal_quantity')->nullable();
            $table->string('sample_comment')->nullable();
            $table->string('supplier_name',255)->nullable();
            $table->string('supplier_part_number',255)->nullable();
            $table->string('manufacturer_name',255)->nullable();
            $table->string('manufacturer_part_number',255)->nullable();
            $table->integer('created_by')->default('0');
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
        Schema::dropIfExists('sales_quotes_items');
    }
};
