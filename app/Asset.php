<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
      protected $table='audit_asset';
     protected $fillable=[
         'asset_name',
         'asset_category',
         'brand',
         'asset_id',
         'asset_model',
         'branch_date',
         'branch_landline',
         'asset_location',
         'asset_p_order_number',
         'asset_status'
         ]; 
}
