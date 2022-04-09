<x-app-layout-bs>
    <div class="row mt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Conversas
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($conversas as $conversaItem)
                            <a class="list-group-item" href="{{ route('chat.index', $conversaItem->id) }}">{{ $conversaItem->users->where('id', '!=', $user->id)->first()->name }}</a>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-flat" data-bs-toggle="modal"
                                data-bs-target="#newChatModal">
                                Nova Conversa
                            </button>
                            </div>
                            <div class="modal fade" id="newChatModal" tabindex="-1" aria-labelledby="newChatModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newChatModalLabel">Selecione um Usuário</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($users as $userItem)
                                                <a class="list-group-item" href="{{ route('chat.nova_conversa', $userItem->id) }}">{{ $userItem->name }}</a>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                @if ($conversa->id ?? false)
                    <div class="card-header fw-bold">
                        {{ $userDestinatario->name }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @foreach ($conversa->mensagens as $mensagem)
                                    <div
                                        class="row {{ $mensagem->user_id == $user->id ? 'justify-content-end' : '' }}">
                                        <div class="col-8">

                                            <div class="card border-success mb-3">
                                                <div class="card-body">
                                                    {{ $mensagem->conteudo }}<br>
                                                    <hr>
                                                    <details>
                                                        <summary>Mensagem Criptografada</summary>
                                                        <p><div class="alert alert-secondary fs-6" role="alert">
                                                            {{ $mensagem->conteudo_encrypt }}
                                                          </div></p>
                                                      </details>

                                                </div>
                                                <div class="card-footer text-end">
                                                    <small class="fst-italic">Enviado por <b>{{ $mensagem->user_id == $user->id ? 'você' : $mensagem->user->name }}</b> as
                                                        {{ $mensagem->created_at->format('d/m/Y H:i:s') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('chat.save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="conversa_id" value="{{ $conversa->id }}">
                                        <textarea type="text" name="conteudo" class="form-control" placeholder="Mensagem"
                                            aria-label="Mensagem" aria-describedby="button-addon2"></textarea>
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-addon2">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        Selecione uma conversa
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
