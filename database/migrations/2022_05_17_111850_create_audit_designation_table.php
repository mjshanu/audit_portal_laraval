<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditDesignationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_designation', function (Blueprint $table) {
            $table->id();
            $table->string('designation_name');
            $table->string('designation_code');
            $table->string('level_type');
            $table->foreignId('fk_department_id')->references('id')->on('audit_department');
            $table->enum('designation_status', [0, 1])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_designation');
    }

}
