@props(['player','user','game'])
<p class="text-center px-6 w-full flex flex-col items-center justify-center">
    @if($player)
        @if($player->is($user))
{{--        If you are a player and this is your side,--}}
            <span>Your secret word</span>
            <x-secret-word class="block" :word="$player->word"/>
        @else
{{--        If this is not your side, but it does have a player,--}}
            <span>{{ $player->name }}'s secret Jotto Letters</span>
            <x-opponents-letters class="block"/>
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
