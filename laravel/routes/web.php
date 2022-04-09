<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Chat rotas
//Chat
Route::get('/chat/{id_conversa?}', [ChatController::class, 'index'])->middleware(['auth'])->name('chat.index');

//Salvar Mensagem
Route::post('/chat/save', [ChatController::class, 'save'])->middleware(['auth'])->name('chat.save');

//Criar Conversa
Route::get('/chat/nova_conversa/{user_id}', [ChatController::class, 'nova_conversa'])->middleware(['auth'])->name('chat.nova_conversa');
