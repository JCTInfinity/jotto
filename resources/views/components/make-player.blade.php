@props(['action'])
<form {{ $attributes->merge(['class'=>'px-6 w-full flex flex-col items-center']) }} wire:submit.prevent="submit">
    <div>
        <x-name-field wire:model.lazy="name"/>
        <div class="flex">
            <x-horizontal-field :label="Word">
                <x-word-field wire:model.lazy="word"/>
            </x-horizontal-field>
            <x-button :text="$action" class="rounded-l-none h-7"/>
        </div>
    </div>
</form>
