<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversa;
use App\Models\Mensagem;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index($id_conversa = null){
        //Usuario logado
        $user = auth()->user();

        //Conversas do usuario logado
        $conversas = $user->conversas;

        //Conversa selecionada
        $conversa = $id_conversa ? $user->conversas()->find($id_conversa) : null;

        $userDestinatario = $conversa ? $conversa->users->where('id', '!=', $user->id)->first() : null;

        //Lista de usuário para criar uma conversa
        $users = User::where('id', '!=', $user->id)->get();

        return view('chat.index', [
            'user' => $user,
            'conversas' => $conversas,
            'conversa' => $conversa,
            'users' => $users,
            'userDestinatario' => $userDestinatario,
        ]);
    }

    public function save(Request $request){

        $mensagem = new Mensagem();

        $mensagem->fill($request->all());

        $mensagem->save();

        return redirect(route('chat.index', $request->conversa_id));
    }


    public function nova_conversa($user_id){

        $user = auth()->user();

        //Verifica se a conversa já existe
        $conversa = $user->conversas()->whereHas('users', function($q) use($user_id){
            $q->where('users.id', $user_id);
        })->first();

        if(!$conversa || !$conversa->id){
            //Criar a conversa caso não eczista
            $conversa = new Conversa();
            $conversa->save();

            //Incluir membros da conversa
            $conversa->users()->sync([$user->id, $user_id]);
        }

        return redirect(route('chat.index', $conversa->id));
    }
}
