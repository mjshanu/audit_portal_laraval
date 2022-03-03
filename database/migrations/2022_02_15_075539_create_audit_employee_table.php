<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_employee', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->integer('fk_c_id');
            $table->integer('e_desination');
            $table->bigInteger('e_code');
            $table->date('e_joining_date');
            $table->string('e_company_email_id');
            $table->string('e_contact_number');
            $table->integer('e_reporting_head');
            $table->string('e_gender');
            $table->string('e_location');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_employee');
    }

}
