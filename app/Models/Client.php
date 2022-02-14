<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'phone', 'org_email', 'organization', 'category_id', 'logo', 'client_status', 'sub_dept_exist', 'demo_acc', 'has_sister',
    ];
    
    protected $primaryKey = 'client_id';
}
