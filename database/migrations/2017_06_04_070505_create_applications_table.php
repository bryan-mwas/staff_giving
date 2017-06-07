<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('fund_type',['fees','stipend','accommodation']);
            $table->string('helb');
            $table->string('helb_status');
            $table->string('helb_upload')->nullable();
            $table->integer('crb');
            $table->integer('crb_status');
            $table->string('crb_upload')->nullable();
            $table->string('application_upload');
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
        Schema::dropIfExists('applications');
    }
}
