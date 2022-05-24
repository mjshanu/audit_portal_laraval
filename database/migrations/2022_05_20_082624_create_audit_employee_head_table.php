<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_employee_head', function (Blueprint $table) {
            $table->id();
             $table->foreignId('fk_emp_reporting')->references('id')->on('audit_employee_basics');
               $table->foreignId('fk_emp_functional_manager')->references('id')->on('audit_employee_basics');
                 $table->foreignId('fk_created_id')->references('id')->on('audit_holidays_calendar');
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
        Schema::dropIfExists('audit_employee_head');
    }
}
