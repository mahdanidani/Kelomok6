<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_mhs extends Model
{
   
    protected $table = "tabel_mhs";
    protected $primaryKey = 'id';
    protected $fillable = ['nim','nama','alamat','angkatan'];
       
}