<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments_grouping extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_name', 'client_id',
    ];
    protected $primaryKey = 'group_id';

}
