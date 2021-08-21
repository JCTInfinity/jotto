<x-main :poll="$game->ended ? false : 'attend'">
    <x-header-section>
        <div class="w-1/2">
            <x-game-header-content :player="$player1" :user="$player" :game="$game"/>
        </div>
        <div class="w-1/2">
            <x-game-header-content :player="$player2" :user="$player" :game="$game"/>
        </div>
    </x-header-section>
    <x-title />
    <script>
        function gameData(){
            return {
                fireNotification: function($event){
                    console.log($event.detail);
                    new Notification('Jotto',{body:$event.detail.body});
                    this.$wire.readNotifications($event.detail.id);
                }
            }
        }
    </script>
    <section class="max-w-lg mx-auto" x-data="gameData()" x-on:notification.window="fireNotification($event)">
        <div class="flex flex-col space-y-2 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-2">
            <x-guess-cell header left>
                <span class="w-35">
                    @if($player && $player->is($player1)) Your test&nbsp;word
                    @elseif($player1) {{$player1->name}}'s test&nbsp;word
                    @endif
                </span>
                <span class="text-center w-10">Jots</span>
            </x-guess-cell>
            <x-guess-cell header>
                <span class="w-35">
                    @if($player && $player->is($player2)) Your test&nbsp;word
                    @else {{$player2->name ?? 'Opponent'}}'s test&nbsp;word</span>
                    @endif
                <span class="text-center w-10">Jots</span>
            </x-guess-cell>
            @if($player2){{-- If the game has both players --}}
                @foreach($player1->guesses->zip($player2->guesses) as $i=>list($guess1,$guess2))
                    <x-guess-cell left wire:key="guess-{{$i}}-left">
                        <x-word>
                            {{ $guess1->word ?? '' }}
                        </x-word>
                        @if($guess1)
                            <x-jots :guess="$guess1"/>
                        @endif
                    </x-guess-cell>
                    @if($guess2)
                        <x-guess-cell  wire:key="guess-{{$i}}-right">
                            <x-word>
                                {{ $guess2->word }}
                            </x-word>
                            <x-jots :guess="$guess2"/>
                        </x-guess-cell>
                    @endif
                @endforeach
                @if($player->turn ?? false)
                    <x-guess-cell :left="$player->is($player1)" wire:key="guess-last">
                        <x-make-guess />
                    </x-guess-cell>
                    @if($player1->latestGuess->jotto ?? false)
                        <span></span>
                        <span class="text-red-500">One chance to tie!</span>
                    @endif
                @endif
            @endif
        </div>
    </section>
    <section class="mt-3 container mx-auto">
        <textarea wire:ignore placeholder="Notes" class="w-full max-w-xl mx-auto mb-3 shadow-inner p-2 block"></textarea>
        <x-alphabet/>
    </section>
</x-main>
