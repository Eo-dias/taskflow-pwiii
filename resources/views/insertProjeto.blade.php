<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow · Novo cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="agenda-layout">
        <aside class="agenda-sidebar">
            <div class="brand-box">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo TaskFlow">
                <div class="brand-text">
                    <h1>TaskFlow</h1>
                    <p>Workspace de produtividade</p>
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

                <form action="/criar-projeto" method="POST" class="agenda-form" novalidate>
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-grid">
                        <div class="form-field full-width">
                            <label for="txNome">Título do Projeto <span class="required-mark" aria-label="obrigatório">*</span><span class="required-note">Campo obrigatório</span></label>
                            <input type="text" id="txNome" name="txNome" placeholder="Digite o título do Projeto" value="{{ old('txNome') }}" required>
                        </div>

                        <div class="form-field full-width">
                            <label for="txDesc">Descrição <span class="required-mark" aria-label="obrigatório">*</span><span class="required-note">Campo obrigatório</span></label>
                            <textarea id="txDesc" name="txDesc" placeholder="Digite a descrição do Projeto" required>{{ old('txDesc') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="txUser">Usuário <span class="required-mark" aria-label="obrigatório">*</span><span class="required-note">Campo obrigatório</span></label>
                            <select id="txUser" name="txUser" required>
                                <option value="">Selecionar Usuario</option>
                                @foreach($usuario as $u)
                                <option value="{{ $u->id }}" {{ old('txUser') == $u->id ? 'selected' : '' }}>{{ $u->nome }}</option>
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

    <script>
        // Exibe o aviso apenas nos campos obrigatórios que estiverem vazios.
        document.querySelectorAll('.agenda-form').forEach(function (form) {
            const campos = Array.from(form.querySelectorAll('[required]'));

            function estaVazio(campo) {
                return campo.value.trim() === '';
            }

            function atualizarAvisos() {
                campos.forEach(function (campo) {
                    const label = form.querySelector('label[for="' + campo.id + '"]');
                    const aviso = label ? label.querySelector('.required-note') : null;
                    const vazio = estaVazio(campo);

                    if (aviso) {
                        aviso.style.display = vazio ? 'inline-flex' : 'none';
                    }
                    campo.setAttribute('aria-invalid', vazio ? 'true' : 'false');
                });
            }

            // Impede o envio se ainda houver campos obrigatórios vazios.
            form.addEventListener('submit', function (event) {
                atualizarAvisos();
                if (campos.some(estaVazio)) {
                    event.preventDefault();
                }
            });

            // Conforme o usuário preenche ou limpa um campo, atualiza o aviso na hora.
            campos.forEach(function (campo) {
                campo.addEventListener('input', atualizarAvisos);
                campo.addEventListener('change', atualizarAvisos);
            });

            // Ao abrir a tela, mostra o aviso nos campos que já estiverem vazios.
            atualizarAvisos();
        });
    </script>
</body>

</html>