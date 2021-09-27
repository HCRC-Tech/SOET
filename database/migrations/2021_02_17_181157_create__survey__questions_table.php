<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SURVEY_QUESTIONS', function (Blueprint $table) {
            $table->string('SurveyName')->primary();
            $table->string('ConditionServed')->nullable()->change();;
            $table->string('SurveyType')->nullable()->change();;            
            $table->json('SurveyQuestions');
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
        Schema::dropIfExists('SURVEY_QUESTIONS');
        
    }
}