<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_educations', function (Blueprint $table) {
            //
            $table->increments('candidate_educations_id');
            $table->integer('candidate_id');
            $table->enum('education_level', ['bachelor', 'master', 'doctorate']); 
            $table->string('start_period', 4);
            $table->string('end_period', 4);
            $table->string('institution_name', 100);
            $table->string('faculty', 100);
            $table->string('major', 100);
            $table->double('gpa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_educations');
    }
}
