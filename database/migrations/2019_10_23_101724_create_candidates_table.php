<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification_number', 17);
            $table->string('email', 50);
            $table->string('password', 80);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone_number', 15);
            $table->date('date_of_birth'); 
            $table->enum('gender', ['M', 'F'])->default("M");
            $table->string('nationality', 20)->nullable($value = true)->default(null);
            $table->string('race', 20)->nullable($value = true)->default(null);
            $table->enum('military_status', ['exempt', 'military_studied', 'discharge'])->default("exempt");
            $table->text('address')->nullable($value = true);
            $table->enum('status', ['active', 'pending', 'deleted', 'hired'])->default("pending");  
            $table->string('verify_key', 80)->nullable($value = true);
            $table->timestamps();
            $table->unique('email');
            $table->unique('identification_number');
            $table->unique('verify_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
