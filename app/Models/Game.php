<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property Carbon $created_at
 * @property Carbon $ended_at
 *
 * @property string $url
 * @property string $title
 * @property Collection|Player[] $players
 * @property Collection|Guess[] $guesses
 *
 * @mixin Builder
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'code'
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function getUrlAttribute()
    {
        return route('game',['game'=>$this->code]);
    }

    public function getTitleAttribute()
    {
        return $this->players->map->name->join(' and ') ."'s game from ".$this->created_at->toDayDateTimeString();
    }

    public function opponent(Player $player): ?Player
    {
        return $this->players->firstWhere('id','!=',$player->id);
    }

    public function guesses()
    {
        return $this->hasManyThrough(Guess::class, Player::class);
    }
}
