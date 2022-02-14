<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client_category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
    ];
    protected $primaryKey = 'category_id';

}
