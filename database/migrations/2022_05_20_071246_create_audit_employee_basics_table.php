<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeBasicsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_employee_basics', function (Blueprint $table) {
            $table->id();
            $table->string('emp_name');
            $table->string('emp_code');
            $table->foreignId('emp_fk_des_id')->references('id')->on('audit_designation');
            $table->date('emp_joining_date');
            $table->string('emp_company_email_id');
            $table->bigInteger('emp_contact_number');
            $table->enum('emp_gender', ['male', 'female']);
            $table->string('emp_location');
            $table->foreignId('emp_holiday_calander')->references('id')->on('audit_holidays_calendar');
            $table->string('emp_region');
             $table->enum('status',[ 'active', 'disabled'])->default('active');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_employee_basics');
    }

}
