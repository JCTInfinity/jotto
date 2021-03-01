<form wire:key="guess" wire:submit.prevent="guess" wire:loading.attr="disabled" wire:target="guess">
    <p class="flex justify-center items-center">
        <input x-data="{}" x-init="$el.focus()" wire:model="guessWord" min="5" max="5" required class="w-36 px-2 py-1 h-8 font-hand border border-r-0 uppercase">
        <x-button class="rounded-l-none h-8 shadow-none">Guess</x-button>
    </p>
    <x-error name="guessWord" class="text-center"/>
</form>
