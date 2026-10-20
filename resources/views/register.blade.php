<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta | TaskFlow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <main class="login-layout">
        <section class="login-visual" aria-hidden="true">
            <div class="visual-content">
                <div class="visual-brand">
                    <div class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" width="48" height="48">
                            <rect width="48" height="48" rx="12" fill="currentColor" />
                            <path d="M14 20h20M14 28h14M14 36h8" stroke="white" stroke-width="3" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="brand-text-2">
                        <h1>TaskFlow</h1>
                        <p>Organize tarefas, projetos e equipe com clareza.</p>
                    </div>
                </div>

                <div class="visual-illustration" aria-hidden="true">
                    <div class="illustration-grid">
                        <div class="ill-card done">
                            <div class="ill-card-header">
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                            </div>
                            <div class="ill-card-body">
                                <div class="ill-line"></div>
                                <div class="ill-line short"></div>
                                <div class="ill-line"></div>
                            </div>
                            <div class="ill-badge">Concluída</div>
                        </div>
                        <div class="ill-card progress">
                            <div class="ill-card-header">
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                            </div>
                            <div class="ill-card-body">
                                <div class="ill-line"></div>
                                <div class="ill-line"></div>
                                <div class="ill-progress">
                                    <div class="ill-progress-bar" style="width: 65%"></div>
                                </div>
                            </div>
                            <div class="ill-badge">Em andamento</div>
                        </div>
                        <div class="ill-card pending">
                            <div class="ill-card-header">
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                                <span class="ill-dot"></span>
                            </div>
                            <div class="ill-card-body">
                                <div class="ill-line"></div>
                                <div class="ill-line"></div>
                                <div class="ill-line"></div>
                            </div>
                            <div class="ill-badge">Pendente</div>
                        </div>
                    </div>
                    <div class="ill-stats">
                        <div class="ill-stat">
                            <strong>24</strong>
                            <span>Tarefas esta semana</span>
                        </div>
                        <div class="ill-stat">
                            <strong>8</strong>
                            <span>Projetos ativos</span>
                        </div>
                        <div class="ill-stat">
                            <strong>92%</strong>
                            <span>Taxa de conclusão</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="login-form-area">
            <div class="login-container">
                <header class="login-header">
                    <h2>Criar sua conta</h2>
                    <p>Comece a organizar seus projetos em segundos.</p>
                </header>

                <form id="registerForm" class="login-form" method="POST" action="{{ url('/register') }}" novalidate>
                    @csrf
                    <div class="form-field">
                        <label for="name">
                            Nome <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="txNome"
                            value="{{old('txNome')}}"
                            autocomplete="name"
                            placeholder="Seu nome completo"
                            required
                            aria-describedby="nameError">

                        @error('txNome')
                        <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="email">
                            E-mail <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="txEmail"
                            value="{{old('txEmail')}}"
                            autocomplete="email"
                            placeholder="seu@email.com"
                            required
                            aria-describedby="emailError">
                        @error('txEmail')
                        <span class="form-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="password">
                            Senha <span class="required">*</span>
                        </label>
                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="txSenha"
                                value="{{old('txSenha')}}"
                                autocomplete="new-password"
                                placeholder="••••••••"
                                required
                                aria-describedby="passwordError">
                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword"
                                aria-label="Mostrar senha"
                                aria-pressed="false">
                                <svg class="icon-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" aria-hidden="true">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg class="icon-eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" aria-hidden="true" style="display:none">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                        </div>
                        @error('txSenha')
                        <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="password_confirm">
                            Confirmar senha <span class="required">*</span>
                        </label>
                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password_confirm"
                                name="password_confirm"
                                value="{{old('password_confirm')}}"
                                autocomplete="new-password"
                                placeholder="••••••••"
                                required
                                aria-describedby="passwordConfirmError">
                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePasswordConfirm"
                                aria-label="Mostrar senha"
                                aria-pressed="false">
                                <svg class="icon-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" aria-hidden="true">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg class="icon-eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" aria-hidden="true" style="display:none">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirm')
                        <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login" id="registerBtn">Criar conta</button>
                </form>

                <footer class="login-footer">
                    <p>Já possui conta? <a href="/login" class="forgot-link">Entrar</a></p>
                </footer>
            </div>
        </section>
    </main>

    <!--<script src="{{ asset('js/register.js') }}"></script>-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>