<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IPs extends Model
{
    protected $table = 'allowed_ip';
    protected $fillable = array('messageid', 'ip');
}
