<x-app-layout title="Conta de Usuário">
    <section class="container my-2">
        <div class="row row-cols-md-3 row-cols-1 g-2 justify-content-center">
            <article class="col">
                <div class="card text-center">
                    <div class="card-header mb-2">
                        <h4 class="card-title mt-2">Usuário:</h4>
                        <p class="card-subtitle text-muted">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <p class="card-text me-2">login:</p>
                                <p class="card-text">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <p class="card-text me-2">registrado em:</p>
                                <p class="card-text">
                                    {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <h6 class="card-text h6">permissões:</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach (Auth::user()->permissions as $permission)
                            <li class="list-group-item">
                                {{ $permission->name }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        <div class="py-2">
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalDeletar">
                                Destruir Conta
                            </button>
                        </div>
                    </div>
                    <x-modals.confirmation-danger modalId="modalDeletar" modalTitle="Deletar Conta?"
                        modalText="Tem certeza que deseja deletar a conta?" modalMethod="DELETE"
                        modalAction="{{ route('users.destroy') }}" />
                </div>
            </article>
        </div>
    </section>
</x-app-layout>
