<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prokolpos extends Model
{
    protected $id = 'id';

    protected $table = 'prokolpo';

    protected $fillable = ['name', 'type','status'];
}
