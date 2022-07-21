<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditStreamMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_stream_mapping', function (Blueprint $table) {
            $table->id();
              $table->foreignId('fk_stream_id')->references('id')->on('audit_stream');
               $table->foreignId('fk_sub_strea_id')->references('id')->on('audit_sub_stram');
                $table->foreignId('fk_employee_id')->references('id')->on('audit_employee_basics');
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
        Schema::dropIfExists('audit_stream_mapping');
    }
}
