<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puskesmas_transaksi_keu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'puskesmas_transaksi_keu';

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
    protected $fillable = ['id_pos_keu', 'tanggal', 'nik_user', 'nominal'];

    
}
