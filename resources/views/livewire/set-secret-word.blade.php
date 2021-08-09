<form class="flex" wire:submit.prevent="setWord">
    <x-word-field wire:model.defer="word"/>
    <x-button text="Choice" h7 rounded="right" class="uppercase" />
</form>
