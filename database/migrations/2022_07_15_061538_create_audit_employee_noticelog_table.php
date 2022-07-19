<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployeeNoticelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_employee_noticelog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_n_employee_id')->references('id')->on('audit_employee_basics');
            $table->string('activity_name');
             $table->string('byname');
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
        Schema::dropIfExists('audit_employee_noticelog');
    }
}
