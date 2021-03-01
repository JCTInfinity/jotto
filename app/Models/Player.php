<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * @property int $id
 * @property int $game_id
 * @property string $name
 * @property Stringable $word
 * @property string|null $code
 * @property boolean $turn
 * @property boolean|null $winner
 *
 * @property Game $game
 * @property Collection|Guess[] $guesses
 */
class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'word',
        'code',
        'turn'
    ];

    protected $hidden = [
        'word',
    ];

    protected $casts = [
        'turn'=>'bool',
        'winner'=>'bool',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function guesses()
    {
        return $this->hasMany(Guess::class);
    }

    public function opponent()
    {
        return $this->game->opponent($this);
    }

    public function getWordAttribute($value)
    {
        return Str::of($value);
    }

    public function getUrlAttribute()
    {
        return route('player',['game'=>$this->game->code,'player'=>$this->code]);
    }
}
