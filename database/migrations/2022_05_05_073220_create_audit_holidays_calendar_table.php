<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditHolidaysCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_holidays_calendar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_hol_id')->references('id')->on('audit_holidays');
            $table->string('hol_calendar_name');
             $table->integer('hol_type');
              $table->string('hol_location_project_name');
               $table->string('created_by');
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
        Schema::dropIfExists('audit_holidays_calendar');
    }
}
