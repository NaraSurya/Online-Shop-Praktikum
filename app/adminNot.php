<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminNot extends Model
{
    protected $table= 'admin_notifications';
    protected $fillable=['read_at'];

}
