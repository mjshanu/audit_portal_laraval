<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeDesignationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_employee_designation_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_employye_id')->references('id')->on('audit_holidays_calendar');
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
        Schema::dropIfExists('audit_employee_designation_log');
    }
}
