<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('notes')) {
            Schema::create('notes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->longText('text');
                $table->string('color');
                $table->string('type')->default('personal');
                $table->string('assign_to')->nullable();
                $table->string('module');
                $table->integer('workspace_id');
                $table->integer('account_id')->default(0);
                $table->integer('contact_id')->default(0);
                $table->integer('opportunity_id')->default(0);
                $table->integer('created_by')->default(0);
                $table->integer('updated_by')->default(0);
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
        //
    }
}
