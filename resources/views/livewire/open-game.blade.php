<form class="pt-2 md:pt-0 px-6 w-full flex flex-col items-center" wire:submit.prevent="submit">
    <x-horizontal-field name="code" label="Game">
        <div class="flex">
            <x-word-field wire:model.defer="code" />
            <x-button text="Join" class="rounded-l-none h-7"/>
        </div>
    </x-horizontal-field>
</form>
