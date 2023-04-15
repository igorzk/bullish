<x-layout title="cadastro">
    <main class="m-auto w-50 container">
        <!-- Validation Errors -->
        <x-errors class="mb-4 alert alert-danger" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Cadastro</h1>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="nome" autofocus
                    value="{{ old('name') }}">
                <label for="name">Nome de Usuário</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@seuemail.com"
                    value="{{ old('email') }}" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" required name="password"
                    autocomplete="new-password" placeholder="password">

                <label for="password">Senha</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password_confirmation" required
                    name="password_confirmation" placeholder="password" autocomplete="new-password">
                <label for="password_confirmation">Confirme Senha</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>
            <div class="text-center m-md-4">
                <p class="text-muted">
                    {{ __('Already registered?') }}
                    <a class="text-decoration-none ms-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                </p>
            </div>
        </form>
    </main>
</x-layout>
