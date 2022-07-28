<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_user_faske extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_user_faskes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id_user';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['menu', 'link', 'icon', 'parent', 'created_at', 'updated_at', 'id_master'];

    
}
