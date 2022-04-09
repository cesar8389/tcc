<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversa extends Model
{
    use HasFactory;


    public function save(array $options = []){
        if(!$this->id && !$this->secret){
            //Gerar chave de criptografia da conversa baseada no tempo atual ao criar uma conversa
            $this->secret = Crypt::encryptString(time());
        }

        parent::save($options);
    }

    public function users(){
        return $this->belongsToMany(
            User::class,
            'conversa_users',
            'conversa_id',
            'user_id'
        );
    }

    public function mensagens(){
        return $this->hasMany(Mensagem::class)->with(['user']);
    }
}
