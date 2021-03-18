<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * @property int $id
 * @property int $player_id
 * @property Stringable $word
 * @property int|null $jots
 *
 * @property-read Game $game
 * @property-read Player $player
 * @property-read bool $hasJots
 * @property-read bool $jotto
 */
class Guess extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'jots',
    ];

    public function getWordAttribute($value)
    {
        return Str::of($value);
    }

    public function getLettersAttribute()
    {
        return $this->word->letters();
    }

    public function getHasJotsAttribute()
    {
        return $this->jots !== null;
    }

    public function game()
    {
        return $this->hasOneThrough(Game::class, Player::class,
            'id','id','player_id','game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getJottoAttribute()
    {
        return $this->jots === 6;
    }
}
