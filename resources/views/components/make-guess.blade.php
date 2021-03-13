<form wire:key="guess" wire:submit.prevent="guess" wire:loading.attr="disabled" wire:target="guess">
    <p class="flex justify-center items-center">
        <x-word-field wire:model="guessWord" required x-ref="input" x-init="$refs.input.focus()" />
{{--        <input x-data="{}" x-init="$el.focus()" wire:model="guessWord" min="5" max="5" required class="w-36 px-2 py-1 h-8 font-mono border border-r-0 uppercase">--}}
        <x-button class="rounded-l-none h-7 shadow-none">Guess</x-button>
    </p>
    <x-error name="guessWord" class="text-center"/>
</form>
