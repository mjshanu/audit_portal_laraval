<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeNoticeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_employee_notice', function (Blueprint $table) {
            $table->id();
            
            $table->date('date_of_resign');
            $table->date('date_of_releave');
            $table->string('frequency');
            $table->foreignId('fk_employee_id')->references('id')->on('audit_employee_basics');
            $table->enum('nstatus', [0, 1])->default(1);
            $table->integer('fk_map_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_employee_notice');
    }

}
