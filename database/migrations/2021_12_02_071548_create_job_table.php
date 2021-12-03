<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->integer('job_branch_id');
            $table->integer('job_id');
            $table->integer('job_post');
            $table->integer('job_openings');
            $table->string('job_experience');
            $table->integer('job_status');
            $table->longText('job_skillset');
             $table->date('job_date_open');
               $table->date('job_date_close');
                $table->string('job_location');
                 $table->longText('job_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('job');
    }

}
