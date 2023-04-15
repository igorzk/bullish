<x-table-withcreate header="Aprovar Usuários" title="Aprovar usuários" tableId="usersTable" columnDefs="{
                    orderable: false,
                    searchable: false,
                    targets: 'aprovar'}">
    <x-datatable tableId="usersTable">
        <x-slot:thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">nome</th>
                <th scope="col">e-mail</th>
                <th scope="col" class="aprovar">aprovar</th>
            </tr>
        </x-slot:thead>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="post" action="{{ route('users.approve') }}">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="id">
                        <button type="submit" class="btn text-success">
                            <i class="fa-solid fa-user-check fa-lg" style="display:block"></i>
                        </button>
                    </form>
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

