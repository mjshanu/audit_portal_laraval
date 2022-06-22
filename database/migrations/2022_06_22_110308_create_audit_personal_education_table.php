<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditPersonalEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_personal_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ed_fk_emp_id')->references('id')->on('audit_employee_basics');
            $table->string('education_name');
            $table->string('institution');
              $table->integer('year_of_pass');
               $table->string('specialization');
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
        Schema::dropIfExists('audit_personal_education');
    }
}
