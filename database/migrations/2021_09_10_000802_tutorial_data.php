<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TutorialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_data', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedInteger('event_number')->nullable();
            $table->string('username',255)->nullable();
            $table->unsignedBigInteger('tutorial_id')->nullable();
            $table->unsignedBigInteger('step_id')->nullable();
            $table->string('event_type',1000)->nullable();
            $table->string('video_path',1000)->nullable();
            $table->timestamp('user_time')->nullable();
            $table->unsignedBigInteger('time_spent')->nullable();
            $table->unsignedInteger ('session_count')->nullable();
            $table->text('meta_data')->nullable();
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
        Schema::dropIfExists('tutorial_data');
    }
}