<x-layout>
    <x-main class="my-2 mx-auto max-w-5xl border border-black shadow-lg p-2 space-y-4">
        <x-header-section>
            <p></p>
            <p></p>
        </x-header-section>
        <x-title />
        <section class="prose lg:prose-xl max-w-prose mx-auto">
            <livewire:datatable model="App\Models\Game" include="players.name,created_at,players.active_at,ended_at" />
            <livewire:datatable model="App\Models\Word" include="word" per-page="50"/>
        </section>
    </x-main>
</x-layout>
