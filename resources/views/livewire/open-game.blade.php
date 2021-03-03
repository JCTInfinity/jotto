<form class="px-6 w-full flex flex-col items-center" wire:submit.prevent="submit">
    <div class="flex">
        <x-word-field wire:model.lazy="code" />
        <x-button text="Join" class="rounded-l-none"/>
    </div>
</form>
