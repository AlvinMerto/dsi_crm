<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('all_activity_logs')) {
            Schema::create('all_activity_logs', function (Blueprint $table) {
                $table->id();
                $table->string('module');
                $table->string('sub_module')->nullable();
                $table->string('description');
                $table->string('url')->nullable();
                $table->integer('workspace')->nullable();
                $table->integer('account_id')->default(0);
                $table->integer('contact_id')->default(0);
                $table->integer('opportunity_id')->default(0);
                $table->integer('created_by');
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
        Schema::dropIfExists('all_activity_logs');
    }
};
