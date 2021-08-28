<x-button rounded wire:poll="update" wire:click="continueToNextGame">
    Play Again
    @if($this->otherPlayerContinued)
        (Your opponent has continued)
    @endif
{{-- TODO: Why is this wrong?   --}}
    otherPlayerContinued: @json($this->otherPlayerContinued)
</x-button>
