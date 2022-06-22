<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditPersonalinformationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_personalinformation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_fk_emp_id')->references('id')->on('audit_employee_basics');
            $table->bigInteger('aadhar_number');
            $table->longText('permenent_adress');
            $table->string('f_m_s_name');
            $table->longText('temp_adress');
            $table->string('emergency_contact_number');
            $table->date('of_dob');
            $table->string('p_email_adress');
            $table->integer('tot_exp');
           
             $table->enum('m_status',['single','married','widowed','divorced'])->default('single');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_personalinformation');
    }

}
