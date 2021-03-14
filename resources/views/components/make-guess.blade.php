<form wire:key="guess" wire:submit.prevent="guess" wire:loading.attr="disabled" wire:target="guess">
    <p class="flex justify-center items-center">
        <x-word-field wire:model="guessWord" required x-data="{}" x-init="$el.focus()" />
        <x-button class="rounded-l-none h-7 shadow-none">Guess</x-button>
    </p>
    <x-error name="guessWord" class="text-center"/>
</form>
