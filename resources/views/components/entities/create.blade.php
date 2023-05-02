@props(['entityName', 'storeRoute'])

<x-create-form route="{{ route($storeRoute) }}" method="POST" create="Criar" title="criar {{ $entityName }}"
    header="Criando {{ $entityName }}:">
    <div class="w-50">
        <label class="form-label" for="nickname">Apelido para {{ $entityName }}</label>
        <input class="form-control" type="text" name="nickname" id="nickname">
        <p class="form-text">deve ser um nome único</p>
    </div>
</x-create-form>
