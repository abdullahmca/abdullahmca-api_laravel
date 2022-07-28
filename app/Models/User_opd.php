<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_opd extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_opd';

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
    protected $fillable = ['nik', 'nama_user', 'kode_opd', 'password', 'nip'];

    
}
