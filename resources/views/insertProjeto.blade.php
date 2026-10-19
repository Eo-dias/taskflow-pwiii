<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Tarefa | Minha Agenda</title>
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
                <a href="/">Tarefas</a>
                <a href="/usuario">Usuários</a>
                <a href="/projeto" class="active">Projetos</a>
            </nav>
        </aside>

        <main class="agenda-main">
            <section class="agenda-panel form-page">
                <div class="panel-top">
                    <div>
                        <h3>Novo Projeto</h3>
                        <p>Cadastre um novo projeto na agenda.</p>
                    </div>
                </div>

                <form action="/criar-projeto" method="POST" class="agenda-form">
                    @csrf

                    <div class="form-grid">
                        <div class="form-field full-width">
                            <label for="txNome">Titulo do Projeto</label>
                            <input type="text" id="txNome" name="txNome" placeholder="Digite o título do Projeto" required>
                        </div>

                        <div class="form-field full-width">
                            <label for="txDesc">Descrição</label>
                            <textarea id="txDesc" name="txDesc" placeholder="Digite a descrição do Projeto" required></textarea>
                        </div>

                        <div class="form-field">
                            <label for="txUser">Usuario</label>
                            <select id="txUser" name="txUser" required>
                                <option value="">Selecionar Usuario</option>
                                @foreach($usuario as $u)
                                <option value="{{ $u->id }}">{{ $u->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="/" class="btn-secondary">Cancelar</a>
                        <button type="submit" class="btn-primary">Cadastrar Projeto</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>

</html>