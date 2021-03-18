@props(['player','user','game'])
<div class="px-6 w-full flex flex-col items-center">
    <p class="flex flex-col">
    @if($player)
        @if($player->is($user))
{{--        If you are a player and this is your side,--}}
            <span>Your secret word</span>
            <x-secret-word class="block" :word="$player->word"/>
            <span class="text-xs flex" x-data="{open:false,copied:false}">
                <button class="underline" x-on:click="open = true" x-show="!open">Need to switch devices?</button>
                <x-button x-cloak x-show="open" rounded="left" h7 text="Copy a return link" icon="clipboard"
                     x-on:click="navigator.clipboard.writeText('{{$player->url}}').then(()=>copied=true)"/>
                <x-button x-cloak x-show="open" x-bind:disabled="!copied"
                          x-bind:class="{'bg-blue-200':copied,'bg-gray-200':!copied,'cursor-not-allowed':!copied}"
                          rounded="right" h7 text="Disconnect" icon="zap-off" wire:click="disconnectPlayer"/>
            </span>
        @else
{{--        If this is not your side, but it does have a player,--}}
            <span>{{ $player->name }}'s secret Jotto Letters</span>
            <x-opponents-letters class="block"/>
            <x-activity :player="$player"/>
        @endif
    @else
        @if($user)
{{--        If you are a player and this is not your side and it does not have a player,--}}
            Give your opponent this code
            <x-word class="select-all">{{$game->code}}</x-word>
        @else
{{--        If you are an observer and this side does not have a player,--}}
            <livewire:join-game :game="$game"/>
        @endif
    @endif
    </p>
</div>
