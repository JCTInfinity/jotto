<x-layout>
    <main class="m-2 border border-black shadow-lg p-2 space-y-4">
        <section class="container mx-auto flex uppercase divide-x divide-dashed justify-center">
{{--            <p class="px-6 w-full flex flex-col items-center">--}}
                <livewire:create-game/>
{{--            </p>--}}
{{--            <p class="text-center px-6 w-full flex flex-col items-center justify-center">--}}
                <livewire:open-game/>
{{--            </p>--}}
        </section>
        <x-title />

    </main>
    <x-dictionary-credit/>
</x-layout>
