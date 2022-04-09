<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversa_id',
        'conteudo'
    ];

    protected $appends = [
        'conteudo_encrypt'
    ];

    public function setConteudoAttribute($value)
    {
        //Criptografar mensagem ao salvar
        $this->attributes['conteudo'] = encrypt($value);
    }

    public function getConteudoAttribute($value)
    {
        //Descriptografar mensagem ao exibir
        return decrypt($value);
    }

    public function getConteudoEncryptAttribute($value)
    {
        //Exibir mensagem criptografada
        return $this->attributes['conteudo'];
    }

    public function save(array $options = []){
        $this->user_id = auth()->user()->id;

        return parent::save($options);
    }


    public function conversa(){
        return $this->belongsTo(conversa::class);
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
