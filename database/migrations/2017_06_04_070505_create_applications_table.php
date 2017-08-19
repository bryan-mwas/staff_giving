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
            $table->integer('user_id')->unsigned();
            $table->integer('request_type')->unsigned();
            $table->boolean('is_helb');
            $table->boolean('is_helb_granted');
            $table->string('helb_letter_upload')->nullable();
            $table->boolean('is_crb');
            $table->boolean('is_crb_granted');
            $table->string('crb_letter_upload')->nullable();
            $table->string('application_letter_upload');
            $table->enum('stage',['submitted','review','complete']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('request_type')->references('id')->on('financial_aid_types');
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
