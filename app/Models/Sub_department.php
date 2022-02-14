<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_department extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_dept_name', 'dept_id',
    ];
    protected $primaryKey = 'sub_dept_id';

}
