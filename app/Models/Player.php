<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
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
 * @property Carbon $active_at
 *
 * @property Game $game
 * @property Collection|Guess[] $guesses
 * @property Guess $latestGuess
 * @property string $lastActive
 */
class Player extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'word',
        'code',
        'turn',
        'active_at',
    ];

    protected $hidden = [
        'word',
    ];

    protected $casts = [
        'turn'=>'bool',
        'winner'=>'bool',
    ];

    protected $dates = [
        'active_at',
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
        return $this->code ?
            URL::signedRoute('return-to-game',['game'=>$this->game,'player'=>$this])
            : route('game',['game'=>$this->game]);
    }

    public function activity()
    {
        $this->update(['active_at'=>now()]);
    }

    public function getLastActiveAttribute()
    {
        return $this->active_at ? $this->active_at->diffForHumans() : 'never';
    }

    public function latestGuess()
    {
        return $this->hasOne(Guess::class)->latest();
    }
}
