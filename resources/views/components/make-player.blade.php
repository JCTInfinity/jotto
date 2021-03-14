@props(['action'])
<form {{ $attributes->merge(['class'=>'px-6 w-full flex flex-col items-center']) }} wire:submit.prevent="submit">
    <div class="space-y-0.5">
        <x-name-field wire:model.lazy="name"/>
        <div class="flex">
            <x-horizontal-field name="word">
                <div class="flex">
                    <x-word-field wire:model.defer="word"/>
                    <x-button :text="$action" class="rounded-l-none h-7"/>
                </div>
            </x-horizontal-field>
        </div>
    </div>
</form>
