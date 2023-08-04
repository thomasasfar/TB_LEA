<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id'
    ];

    public function User(){
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function Barang(){
        return $this->belongsTo(Kamar::class, "id_barang", "id");
    }
}
