<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama_barang', 'status', 'harga', 'image'];

    public function Transaction(){
        return $this->hasMany(Transaction::class, "id_barang", "id");
    }
}
