<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditSubStramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_sub_stram', function (Blueprint $table) {
            $table->id();
             $table->string('sub_stream_name');
             $table->enum('sub_stream_status',[0,1])->default(1);
              $table->foreignId('fk_stream_id')->references('id')->on('audit_stream');
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
        Schema::dropIfExists('audit_sub_stram');
    }
}
