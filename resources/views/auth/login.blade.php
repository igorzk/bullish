<x-layout title="login">
    <main class="m-sm-auto mt-5 w-75 container px-md-5">
        <div class="mx-md-5">
            <form method="POST" action="{{ route('login') }}" class="px-md-5 mx-md-5">
                @csrf
                <!-- Session Status -->
                <x-session-status class="mb-4 alert alert-warning" :status="session('status')" />

                <!-- Validation Errors -->
                <x-errors class="mb-4 alert alert-danger" :errors="$errors" />

                <h1 class="h3 mb-3 fw-normal">Autenticação</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" required name="password"
                        placeholder="Password">
                    <label for="password">Senha</label>
                </div>

                <div class="checkbox mb-3 mt-1">
                    <label>
                        <input type="checkbox" name="remember"> {{ __('Remember me') }}
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
            </form>
            <div class="text-center m-md-4">
                <p class="text-muted">
                    Caso não possua usuário,
                    <a class="text-decoration-none" href="{{ route('register') }}">registre-se</a>
                </p>
            </div>
        </div>
    </main>
</x-layout>
