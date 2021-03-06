<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//class CreatePatientProfileTable extends Migration

class CreateParticipantProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('PATIENT_PROFILE', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('password');
            $table->string('FirstName');
            $table->string('LastName');
            $table->date('DOB');      //dd-mm-yyyy
            $table->string('Gender');
            $table->integer('Weight');
            $table->integer('Height');            
            $table->string('Condition');
            $table->json('Medications');
            $table->boolean('PREMFlag')->default(true);
            $table->boolean('PROMFlag')->default(true);
            $table->boolean('NewAccount')->default(true);
            $table->string('PasswordReset')->default("false");                 
        });**/

        Schema::create('PARTICIPANT_PROFILE', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->string('FirstName');
            $table->string('LastName');
            $table->date('DOB');      //dd-mm-yyyy
            $table->string('Gender');
            $table->boolean('NewAccount')->default(true);
            $table->string('PasswordReset')->default("false"); 
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
        Schema::dropIfExists('PARTICIPANT_PROFILE');
    }
}