<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_menu';

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
    protected $fillable = ['menu', 'link', 'icon', 'parent'];

    
}
