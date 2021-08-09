<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Rules\DictionaryWord;
use App\Models\Player;

/**
 * @method static void run(Player $player, string $word)
 */
class SetPlayerWord
{
    use AsAction;

    public function rules(): array
    {
        return [
            'word' => ['required', 'string', 'size:5', 'alpha', new DictionaryWord()],
        ];
    }

    public function handle(Player $player, string $word): void
    {
        $player->update(['word'=>$word]);
    }
}
