<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_forms', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('candidate_id');
            $table->integer('job_id');
            $table->datetime('submitted_datetime');
            $table->datetime('interview_datetime')->nullable($value = true);;
            $table->enum('status', ['pending', 'appointed_for_interview', 'in_review', 'hired', 'rejected'])->default("pending"); 
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
        Schema::dropIfExists('application_forms');
    }
}
