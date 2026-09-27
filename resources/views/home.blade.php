<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Agenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="agenda-layout">
        <aside class="agenda-sidebar">
            <div class="brand-box">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Minha Agenda">
                <div class="brand-text">
                    <h1>Minha Agenda</h1>
                    <p>Organização do dia a dia</p>
                </div>
            </div>

           <nav class="agenda-nav">
                <a href="/dashboard">Dashboard</a>
                <a href="/" class="active">Tarefas</a>
                <a href="/usuario">Usuários</a>
                <a href="/projeto">Projetos</a>
            </nav>
        </aside>

        <main class="agenda-main">
            @php
            $usuario = Auth::user();
            @endphp
            
            <section class="hero-box">
                <div>
                    <h2>Bem-vindo, {{ Auth::user()->nome }}!</h2>
                    <p>Acompanhe suas tarefas e organize sua rotina.</p>
                </div>

                <div class="top-actions">
                    <a href="/projeto" class="btn-primary">Projetos</a>

                    <form action="/logout" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-secondary">Sair</button>
                    </form>
                </div>
            </section>
            
            <section class="agenda-cards">
                <div class="agenda-card">
                    <span>Total de tarefas</span>
                    <strong>{{$tarefasTotais}}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas pendentes</span>
                    <strong>{{$tarefasPendentes}}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas concluídas</span>
                    <strong>{{ $tarefasConcluidas}}</strong>
                </div>
            </section>

            <section class="agenda-panel">
                <div class="panel-top">
                    <div>
                        <h3>Minhas tarefas</h3>
                        <p>Veja todas as tarefas já criadas.</p>
                    </div>

                    <div class="filtros">

                        <label for="txFiltro">Filtrar por:</label>

                        <form action="/" method="$_GET">
                            <div class="form-filtro">
                                <select name="selecionarFiltro" id="selecionarFiltro" onchange="this.form.submit()">

                                    <option value="status"
                                        {{ request('selecionarFiltro') == 'status' ? 'selected' : '' }}>
                                        Status
                                    </option>

                                    <option value="data"
                                        {{ request('selecionarFiltro') == 'data' ? 'selected' : '' }}>
                                        Data final
                                    </option>

                                    <option value="entreData"
                                        {{ request('selecionarFiltro') == 'entreData' ? 'selected' : '' }}>
                                        Entre datas
                                    </option>
                                </select>
                            </div>
                        </form>

                        <form method="GET" action="/" id="filtroStatus" style="display:none">
                            <div class="form-field">
                                <input type="hidden" name="selecionarFiltro" value="status">
                                <select id="txStatus" name="txFiltroStatus" onchange="this.form.submit()">
                                    <option value="" {{request('txFiltroStatus') == '' ? 'selected' : '' }}>Todas as Tarefas</option>
                                    <option value="concluidas" {{request('txFiltroStatus') == 'concluidas' ? 'selected' : '' }}>Tarefas Concluídas</option>
                                    <option value="pendentes" {{request('txFiltroStatus') == 'pendentes' ? 'selected' : '' }}>Tarefas Pendentes</option>
                                </select>
                            </div>
                        </form>

                        <form method="GET" action="/" id="filtroData" style="display:none">
                            <div class="form-filtro">
                                <input type="hidden" name="selecionarFiltro" value="data">
                                <label for="txData">Data:</label>
                                <input type="date" id="txData" name="txData" required value="{{request('txData', date('Y-m-d'))}}">
                                <button type="submit" class="btn-primary">Filtrar</button>
                            </div>
                        </form>

                        <form method="GET" action="/" class="entreDataForm" id="filtroEntreData" style="display:none">
                            <div class="form-filtro">
                                <input type="hidden" name="selecionarFiltro" value="entreData">
                                <label for="txDataPrimeira">Data inicial:</label>
                                <input type="date" id="txDataPrimeira" name="txDataPrimeira" required value="{{request('txDataPrimeira', now()->subDay()->format('Y-m-d')) }}" max="{{request('txDataSegunda', date('Y-m-d'))}}">
                                <label for="txDataSegunda">Data final:</label>
                                <input type="date" id="txDataSegunda" name="txDataSegunda" required value="{{request('txDataSegunda', date('Y-m-d'))}}">
                                <button type="submit" class="btn-primary">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="agenda-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Projeto</th>
                                <th>Usuário</th>
                                <th>Status</th>
                                <th>Prazo</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarefas as $t)
                            <tr>
                                <td>{{ $t->titulo }}</td>
                                <td>{{ $t->projeto_nome }}</td>
                                <td>{{ $t->usuario_nome }}</td>
                                <td>
                                    <span class="status-badge {{ strtolower($t->status) == 'pendente' ? 'status-pendente' : 'status-concluida' }}">
                                        {{ $t->status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($t->data_fim)->format('d/m/Y') }}</td>
                                @if(strtolower($t->status)=='pendente')
                                <td>
                                    <form method="POST" action="/concluir-tarefa/{{$t->id}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Concluir" class="btn-primary-concluir">
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn-primary-editar"
                                        data-toggle="modal"
                                        data-target="#modalEditar{{$t->id}}">
                                        Editar
                                    </button>
                                </td>
                                @else
                                <td>
                                    <form method="POST" action="/desfazer-tarefa/{{$t->id}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Desfazer" class="btn-primary-desativar">
                                    </form>
                                </td>
                                <td>
                                    <input type="button" value="Editar" class="btn-primary-desabilitado" disabled>
                                </td>
                                @endif
                                <td>
                                    <button type="button" class="btn-primary-excluir"
                                        data-toggle='modal'
                                        data-target="#modalexcluir{{$t->id}}">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                            <!--Modal do botão de editar-->
                            <div class="modal fade" id="modalEditar{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Tarefa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/editar-tarefa/{{$t->id}}" method="post" class="agenda-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-field">
                                                    <label for="titulo" class="col-form-label">Titulo:</label>
                                                    <input type="text" id="txNome" name="txNome" placeholder="Digite o título da tarefa" value="{{$t->titulo}}" required class="form-control">
                                                </div>
                                                <div class="form-field">
                                                    <label for="descricao" class="col-form-label">Descrição:</label>
                                                    <textarea id="txDesc" name="txDesc" placeholder="Digite a descrição da tarefa" required class="form-control">{{$t->descricao}}</textarea>
                                                </div>
                                                <div class="form-field">
                                                    <label for="txData">Prazo</label>
                                                    <input type="date" id="txData" name="txData" required value="{{$t->data_fim}}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn-primary">Salvar tarefa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Modal do botão de excluir-->
                            <div class="modal fade" id="modalexcluir{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Confirmar Exclusão</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Você quer mesmo excluir essa tarefa?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-secondary" data-dismiss="modal">Fechar</button>
                                            <form method="POST" action="/excluir-tarefa/{{$t->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Excluir" class="btn-primary-excluir">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="8">Nenhuma tarefa cadastrada ainda.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script src="{{asset('js/filtro.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>