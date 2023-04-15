<x-layout title="mudar senha">
    <main class="m-auto w-50 container">
        <!-- Validation Errors -->
        <x-errors class="mb-4 alert alert-danger" :errors="$errors" />
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <h1 class="h3 mb-3 fw-normal">Mudar Senha</h1>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@seuemail.com"
                    required value="{{ old('email', $request->email) }}">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" required name="password"
                    placeholder="password" autocomplete="new-password">

                <label for="password">Nova Senha</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password_confirmation" required
                    name="password_confirmation" placeholder="password" autocomplete="new-password">
                <label for="password_confirmation">Confirme Nova Senha</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">
                {{ __('Reset Password') }}
            </button>
        </form>
    </main>
</x-layout>
