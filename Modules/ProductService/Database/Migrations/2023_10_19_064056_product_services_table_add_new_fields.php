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
        Schema::table('product_services', function (Blueprint $table) {
            $table->string('markup')->after('description');
            $table->string('manufacturer_part_number')->after('markup');
            $table->string('manufacturer_name')->after('manufacturer_part_number');
            $table->string('supplier_part_number')->after('manufacturer_name');
            $table->string('supplier_name')->after('supplier_part_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_services', function (Blueprint $table) {
            $table->dropColumn('markup');
            $table->dropColumn('manufacturer_part_number');
            $table->dropColumn('manufacturer_name');
            $table->dropColumn('supplier_part_number');
            $table->dropColumn('supplier_name');
        });
    }
};
