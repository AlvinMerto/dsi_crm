<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('assets'))
        {
            Schema::create('assets', function (Blueprint $table) {

                $table->bigIncrements('id');
                $table->integer('user_id')->nullable();
                $table->string('name');
                $table->date('purchase_date');
                $table->date('supported_date');
                $table->float('amount')->default(0.00);
                $table->text('description')->nullable();
                $table->integer('created_by')->default(0);
                $table->integer('workspace_id')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
