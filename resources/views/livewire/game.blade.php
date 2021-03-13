<main class="m-2 border-2 shadow-lg p-2 space-y-4" wire:poll="attend">
    <section class="container mx-auto flex uppercase divide-x divide-dashed justify-center">
        <p class="px-6 w-full flex flex-col items-center">
            @if($player)
                <span>Your secret word</span>
                <x-secret-word class="block" :word="$player->word"/>
            @else
            <span>{{ $player1->name }}'s secret Jotto Letters</span>
                <x-opponents-letters class="block"/>
            @endif
        </p>
        <p class="text-center px-6 w-full flex flex-col items-center justify-center">
            @if($opponent)
                <span>{{ $opponent->name }}'s secret Jotto Letters</span>
                <x-opponents-letters class="block"/>
            @elseif($player)
                Give your opponent this code
                <x-word>{{$game->code}}</x-word>
            @else
                <livewire:join-game :game="$game"/>
            @endif
        </p>
    </section>
    <x-title />
    <section class="container mx-auto">
        <table class="w-full">
            <tr class="bg-black text-white divide-x divide-white">
                <th>{{$player1->name}}'s test word</th>
                <th>No. of<br>Jots</th>
                <th class="w-1/12"></th>
                <th>{{$opponent->name ?? 'Opponent'}}'s test word</th>
                <th>No. of<br>Jots</th>
            </tr>
            @if($opponent)
                @foreach($player1->guesses->zip($opponent->guesses) as $i=>list($guess1,$guess2))
                    <tr wire:key="guesses-row-{{$i}}">
                        <td class="pt-2">
                            @if($guess1)
                                <x-word class="mx-auto">{{ $guess1->word }}</x-word>
                            @elseif($player->turn ?? false)
                                @php($secondPlayer = true)
                                <x-make-guess />
                            @endif
                        </td>
                        <td class="pt-2 text-center">
                            <x-jots :guess="$guess1"/>
                        </td>
                        <td class="pt-2"></td>
                        <td class="pt-2">
                            @if($guess2)<x-word class="mx-auto">{{ $guess2->word }}</x-word>@endif
                        </td>
                        <td class="pt-2 text-center">
                            <x-jots :guess="$guess2"/>
                        </td>
                    </tr>
                @endforeach
                @if(($player->turn ?? false) && !($secondPlayer??false))
                    <tr>
                        <td class="pt-2">
                            <x-make-guess />
                        </td>
                        <td class="pt-2" colspan="4"></td>
                    </tr>
                @endif
            @else
                <tr wire:key="join">
                    <td class="pt-2" colspan="5">

                    </td>
                </tr>
            @endif
        </table>
    </section>
</main>
