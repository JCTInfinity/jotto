<main class="m-2 border-2 shadow-lg p-2 space-y-4" @unless($game->ended) wire:poll="attend" @endunless >
    <x-header-section>
        <x-game-header-content :player="$player1" :user="$player" :game="$game"/>
        <x-game-header-content :player="$player2" :user="$player" :game="$game"/>
    </x-header-section>
    <x-title />
    <section class="max-w-lg mx-auto">
        <div class="flex flex-col space-y-2 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-2">
            <x-guess-cell header left>
                <span class="w-35">{{$player1->name}}'s test&nbsp;word</span>
                <span class="text-center w-10">Jots</span>
            </x-guess-cell>
            <x-guess-cell header>
                <span class="w-35">{{$opponent->name ?? 'Opponent'}}'s test&nbsp;word</span>
                <span class="text-center w-10">Jots</span>
            </x-guess-cell>
            @if($player2)
                @foreach($player1->guesses->zip($player2->guesses) as $i=>list($guess1,$guess2))
                    <x-guess-cell left wire:key="guess-{{$i}}-left">
                        <x-word>
                            {{ $guess1->word ?? '' }}
                        </x-word>
                        @if($guess1)<x-jots :guess="$guess1"/>@endif
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
                @endif
            @endif
        </div>
    </section>
    <section class="mt-3 container mx-auto">
        <x-alphabet/>
    </section>
</main>
