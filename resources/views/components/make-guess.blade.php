@props(['disabled'=>false])
<form wire:submit.prevent="guess" {{ $attributes }}>
    <fieldset class="flex justify-center items-center" @if($disabled) disabled @endif wire:loading.attr="disabled" wire:loading.class="opacity-70" wire:target="guess">
        <x-word-field wire:model="guessWord" required x-data="{}" x-init="$el.focus()" />
        <x-button rounded="right" unshadowed h7>Guess</x-button>
    </fieldset>
    <x-error name="guessWord" class="text-center"/>
</form>
