<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditAssetTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_asset', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->string('asset_category');
            $table->string('brand');
            $table->string('asset_id');
            $table->string('asset_model');
            $table->date('branch_date');
            $table->integer('branch_landline');
            $table->string('asset_location');
            $table->string('asset_p_order_number');
              $table->enum('asset_status',[ 'active', 'disabled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_asset');
    }

}
