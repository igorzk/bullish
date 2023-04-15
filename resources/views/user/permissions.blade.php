<x-table-withcreate header="Gerenciar Permissões de Usuários" title="permissões" tableId="usersTable" columnDefs="{
                    orderable: false,
                    searchable: false,
                    targets: 'addPermissions'}">
    <x-datatable tableId="usersTable">
        <x-slot:thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">nome</th>
                <th scope="col">e-mail</th>
                <th scope="col">permissões</th>
                <th scope="col" class="addPermissions">Adicionar/Remover</th>
            </tr>
        </x-slot:thead>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="align-items-center">
                    @foreach ($user->permissions as $permission)
                        <div>{{ $permission->name }}</div>
                    @endforeach
                </td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalPerm{{ $user->id }}"
                            class="btn" type="button" style="color:darkorange">
                        <i class="fa-solid fa-key fa-lg"></i>
                    </button>
                    <x-modals.form modalId="modalPerm{{ $user->id }}"
                                   modalTitle="Permissões para {{ $user->name }}?" modalText="Escolha as permissões:"
                                   modalMethod="PUT" modalAction="{{ route('permissions.store', $user) }}">
                        <div class="form-check d-table">
                            @foreach ($permissions as $permission)
                                <div class="row p-2">
                                    <input autocomplete="off" class="for-check-input col-3" type="checkbox"
                                           value="{{ $permission->id }}" id="perm-{{ $permission->id }}"
                                           name="perms[]" @if ($user->permissions->contains($permission->id)) checked @endif>
                                    <label class="form-check-label col-3" for="perm-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </x-modals.form>
                </td>
            </tr>
        @endforeach
        <x-slot:pagination>
            <div class="mt-2">
                {{ $users->links() }}
            </div>
        </x-slot:pagination>
    </x-datatable>
</x-table-withcreate>
