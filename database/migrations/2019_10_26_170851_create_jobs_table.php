<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('job_name', 50);
            $table->text('job_description');
            $table->text('job_qualification');
            $table->integer('department_id');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->enum('status', ['active', 'expired', 'deleted'])->default("active"); 
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
        Schema::dropIfExists('jobs');
    }
}
