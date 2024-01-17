<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tickets'))
        {
            Schema::create('tickets', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('ticket_id',100)->unique();
                $table->string('name');
                $table->string('email');
                $table->string('user_id');
                $table->integer('category')->nullable();
                $table->string('subject');
                $table->string('status');
                $table->longText('description')->nullable();
                $table->longText('attachments');
                $table->integer('workspace_id');
                $table->integer('account_id')->default(0);
                $table->integer('contact_id')->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
