<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dept_address', 'dept_phone', 'dept_email', 'dept_name', 'category_id', 'logo', 'dept_status', 'client_id', 'group_id',
    ];
    protected $primaryKey = 'dept_id';

}
