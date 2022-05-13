<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditCalendarMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_calendar_map', function (Blueprint $table) {
            $table->id();
             $table->foreignId('fk_hol_map_id')->references('id')->on('audit_holidays_calendar');
              $table->foreignId('fk_hol_id')->references('id')->on('audit_holidays');
              $table->enum('optional',[0,1])->default(0);
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
        Schema::dropIfExists('audit_calendar_map');
    }
}
