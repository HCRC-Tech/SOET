<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SURVEY_RESPONSES', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->date('DateCompleted');            
            $table->string('SurveyName');
            $table->unique(['username', 'DateCompleted', 'SurveyName']);
            $table->string('FirstName');
            $table->string('LastName');            
            $table->json('Responses');
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
        Schema::dropIfExists('SURVEY_RESPONSES');
    }
}