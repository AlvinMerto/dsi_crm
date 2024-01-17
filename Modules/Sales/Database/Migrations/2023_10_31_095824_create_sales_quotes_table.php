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
        Schema::create('sales_quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id')->nullable();
            $table->integer('customer_id')->default(0);
            $table->integer('contact_person')->default(0);
            $table->date('issue_date');
            $table->date('quote_validity');
            $table->integer('quote_status')->default(0);
            $table->integer('converted_salesorder_id')->default(0);
            $table->integer('workspace')->nullable();
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
        Schema::dropIfExists('sales_quotes');
    }
};
