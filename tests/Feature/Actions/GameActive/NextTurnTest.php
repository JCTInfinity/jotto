<?php

namespace Tests\Feature\Actions\GameActive;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NextTurnTest extends TestCase
{
    public function test_it_fails_when_a_player_doesnt_have_a_word()
    {
        // TODO: Create this test
        // TODO: Fix so NextTurn fails if a player doens't have a word set, and isn't called in that situation.
    }
}
