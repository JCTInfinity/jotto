<form wire:submit.prevent="submit" class="space-y-2 mx-auto max-w-prose flex flex-col items-center">
    <h2 class="text-xl font-serif">{{$game?'Join':'Create'}} Game</h2>
    <div class="w-full">
        <label class="block font-bold">Name</label>
        <input type="text" required wire:model.lazy="name" class="rounded shadow p-2 w-full">
        <x-error name="name"/>
    </div>
    <div class="w-full">
        <label class="block font-bold">Word</label>
        <input type="text" min="5" max="5" required wire:model.lazy="word" class="font-hand rounded shadow p-2 uppercase w-full">
        <x-error name="word"/>
    </div>
    <x-button text="Join"/>
</form>
