<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'title', 'user_id', 'client_id', 'modules', 'can_update', 'default_user', 'department_id', 'sub_dept_id', 'group_id', 
    ];
    protected $primaryKey = 'contact_id';
}
