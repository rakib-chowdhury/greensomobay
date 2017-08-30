<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    protected $id = 'id';

    protected $table = 'designation';

    protected $fillable = ['name', 'priority','status'];
}
