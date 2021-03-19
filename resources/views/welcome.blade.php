<x-layout>
    <x-main>
        <x-header-section>
                <livewire:create-game/>
                <livewire:open-game/>
        </x-header-section>
        <x-title />
        <div class="prose lg:prose-lg max-w-prose mx-auto">
            <h2>How to Play</h2>

            <p>Jotto is a two-player word-guessing game.
                Once you create a game, give the game's code to someone to play against you.</p>

            <h3>Rules</h3>

            <ul>
                <li>Game words are all 5-letter dictionary (English) words without punctuation.</li>

                <li>Each player picks a secret word.</li>

                <li>Players take turns guessing words.</li>

                <li>Guesses get jots for each letter that's also in your opponent's secret word.</li>

                <li>Guess your opponent's word to get Jotto!</li>
            </ul>

            <p>
                The player who creates the game goes first, but the second player gets one more guess
                if the first player gets Jotto first.
            </p>

            <h3>Strategy</h3>

            <ul>
                <li>With carefully selected words you can include 25 letters in 5 guesses.</li>

                <li>0 jots is helpful. You know those letters aren't the jot in other guesses.</li>

                <li>Change out 1 letter in a word; if jots go up it's the new letter, if jots go down it's the old
                    letter.
                </li>

                <li>If you get 5 jots, try a different order.</li>

                <li>Take half the letters of a word with some jots and mix them with letters you know to solve for which
                    letters got jots.
                </li>
            </ul>
            <p>Have fun!</p>
        </div>
    </x-main>
    <x-footer/>
</x-layout>
