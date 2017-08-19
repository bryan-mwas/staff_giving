<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialAidRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_aid_recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->text('comments')->nullable();
            $table->enum('recommendation', ['accepted', 'rejected']);
            $table->boolean('is_accommodation');
            $table->integer('amount')->default(0);
            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
            $table->foreign('application_id')->references('id')->on('applications');
        });

        // Trigger to update application stage to "review".
        DB::unprepared('
        CREATE TRIGGER tr_UPDATE_APPLICATION_STAGE AFTER INSERT ON `financial_aid_recommendations` FOR EACH ROW
            BEGIN
             UPDATE applications 
             SET stage = "review"
             WHERE id = NEW.application_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_aid_recommendations');
    }
}
