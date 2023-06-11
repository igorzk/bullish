<x-app-layout title="Estoque Carteiras">
    <x-has-livewire/>
    <livewire:show-portfolio-quantities
        :portfolios="$portfolios"
        :stocks="$stocks"
    />
</x-app-layout>
