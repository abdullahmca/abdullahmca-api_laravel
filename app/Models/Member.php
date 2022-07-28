<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'memberid';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['hp', 'alamat', 'nama', 'groupid', 'email', 'profil_pic'];

    
}
