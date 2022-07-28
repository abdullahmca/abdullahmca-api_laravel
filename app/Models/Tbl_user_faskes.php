<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_user_faskes extends Model
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
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nomor_admisi', 'nomor_rm', 'tgl_admisi', 'kode_faskes', 'kode_penjamin'];

    
}
