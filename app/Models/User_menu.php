<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_menu';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_menu', 'id_user'];

    
}
