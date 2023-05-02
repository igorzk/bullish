@props(['entities', 'entitiesPlural', 'entityName', 'routeDestroy', 'routeCreate', 'routeUpdate'])

<x-cardlist-withcreate title="{{ $entitiesPlural }}">
    <x-slot:header>
        <h4>Lista de {{ $entitiesPlural }}:</h4>
    </x-slot:header>
    <x-slot:create>
        @can('create-entity')
            <a class="btn btn-secondary py-3 px-5" href="{{ route($routeCreate) }}">
                <span class="h6">Novo Cadastro</span>
            </a>
        @endcan
    </x-slot:create>
    @foreach ($entities as $entity)
        <x-entities.card :entity="$entity" :entityName="$entityName" :routeDestroy="$routeDestroy" :routeUpdate="$routeUpdate" />
    @endforeach
</x-cardlist-withcreate>
