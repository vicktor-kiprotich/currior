<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    const COMPLETED=1;
    const PENDING=0;

    const DELIVERED = 1;
    const NOTDELIVERED= 0;

  
    public function shipment()
    {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Client', 'seller_id');
    }

    protected $guarded=[];
}