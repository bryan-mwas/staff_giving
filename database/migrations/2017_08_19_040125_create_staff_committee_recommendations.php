<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffCommitteeRecommendations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_committee_recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->enum('recommendation',['accepted', 'rejected']);
            $table->text('comments');
            $table->timestamps();
            $table->foreign('application_id')
                  ->references('id')
                  ->on('applications');
        });

        // Trigger to update application stage to "review".
        DB::unprepared('
        CREATE TRIGGER tr_COMMITTEE_UPDATE_APPLICATION_STAGE AFTER INSERT ON `financial_aid_recommendations` FOR EACH ROW
            BEGIN
             UPDATE applications 
             SET stage = "complete"
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
        Schema::dropIfExists('staff_committee_recommendations');
    }
}
