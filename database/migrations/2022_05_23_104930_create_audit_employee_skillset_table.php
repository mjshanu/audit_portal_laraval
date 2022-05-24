<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeSkillsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_employee_skillset', function (Blueprint $table) {
            $table->id();
             $table->foreignId('fk_emp_id')->references('id')->on('audit_employee_basics');
               $table->string('primary_skill');
                $table->string('secondary_skill');
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
        Schema::dropIfExists('audit_employee_skillset');
    }
}
