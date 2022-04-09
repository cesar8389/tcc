<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensagemOld extends Model
{
    protected $table = 'mensagens';

    protected $fillable = ['user_id_de','user_id_para','mensagem'];


    public function user_de(){
        return $this->hasOne(User::class, 'id', 'user_id_de');
    }

    public function user_para(){
        return $this->hasOne(User::class, 'id', 'user_id_para');
    }
}
