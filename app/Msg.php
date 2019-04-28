<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $table = 'messages';
    protected $fillable = array('secret', 'by', 'message', 'use_password', 'password', 'viewcount', 'maxview', 'ip_restriction', 'destroy_in','attachment');
}
