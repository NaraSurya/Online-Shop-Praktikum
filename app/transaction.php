<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'timeout' , 'address','regency','province', 'total' , 'shipping_cost' , 'sub_total' , 'user_id', 'courier_id' , 'proof_of_payment','status'
    ];

    public function product()
    {
        return $this->belongsToMany('App\product', 'transaction_details')->withPivot('qty','selling_price','discount');
    }
}
