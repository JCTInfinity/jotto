<x-layout>
    <x-main class="my-2 mx-auto max-w-5xl border border-black shadow-lg p-2 space-y-4">
        <x-header-section>
            <livewire:create-game/>
            <livewire:open-game/>
        </x-header-section>
        <x-title />
        <section class="prose lg:prose-xl max-w-prose mx-auto">
            <p>An old pen-and paper game where you try to solve for your opponent’s secret 5-letter word.</p>

            <p>I used to play this with my dad, and now I made an app and put it online. I found out the trademark
                expired in 2012. IDK if </p>

            <p>Authentication is Jackbox-inspired, so anyone can make a game and you can share a code or the URL to your
                opponent.</p>

            <p>You each give a name and pick a secret word. Take turns guessing 5-letter words. The jots tell you how
                many letters are correct. The alphabet and a letters box are provided for your convenience.</p>

            <p>Guess your opponent’s word to get Jotto and win the game. Your game is public to anyone with the game’s
                code, and it remains online. I may reset the database or delete games or take the whole thing down or
                whatever. This is for fun.</p>

            <p>Words are validated against a dictionary. The app remembers words it’s learned, but can only learn 1000
                new words a day. After that it won’t let you use words it doesn’t know and might break. This is
                beta!</p>
        </section>
    </x-main>
</x-layout>
