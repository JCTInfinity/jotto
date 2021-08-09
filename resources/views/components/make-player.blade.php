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
        <x-horizontal-field name="name">
            <div class="flex">
                <x-name-field wire:model.lazy="name"/>
                <x-button icon="play" :text="$action" h7 rounded="right" class="uppercase" />
            </div>
        </x-horizontal-field>
    </div>
</form>
