<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->text('comments')->nullable();
            $table->enum('status',['accepted','rejected','pending']);
            $table->integer('amount')->default(0);
            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('stage',['submitted','review','completion']);
            $table->timestamps();
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_details');
    }
}
