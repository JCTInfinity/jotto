@props(['action'])
<form {{ $attributes->merge(['class'=>'px-6 w-full flex flex-col items-center']) }}
    x-data="{
        getNotifyPermission: function(){
            if('Notification' in window && Notification.permission !== 'denied'){
                Notification.requestPermission().then(()=>this.$wire.submit());
            } else {
                this.$wire.submit();
            }
        }
    }" x-on:submit.prevent="getNotifyPermission()">
    <div class="space-y-0.5">
        <x-name-field wire:model.lazy="name"/>
        <x-horizontal-field name="word">
            <div class="flex">
                <x-word-field wire:model.defer="word"/>
                <x-button icon="play" :text="$action" h7 rounded="right" />
            </div>
{{--            <x-button rounded type="button" icon="hard-drive" text="Random" wire:click="randomWord"/>--}}
        </x-horizontal-field>
    </div>
</form>
