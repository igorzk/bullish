<x-layout :title="$title">
    @isset($scripts)
        <x-slot:scripts>
            {{ $scripts }}
        </x-slot:scripts>
    @endisset
    <x-navbar />
    <div class="flex-shrink-0 container-xxl">
        <div class="pt-2 pb-1">
            <!-- Session Status -->
            <x-session-status class="mb-4 mt-2 alert alert-info alert-dismissible" :status="session('status')" />

            <!-- Errors -->
            <x-errors class="mb-4 alert alert-danger alert-dismissible" :errors="$errors" />
        </div>
        <main class="my-md-4 pb-md-5 my-2">
            {{ $slot }}
        </main>
    </div>
    <x-footer />
</x-layout>
