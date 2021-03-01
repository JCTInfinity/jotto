<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class);
            $table->foreign('game_id')->references('id')->on('games');
            $table->string('name');
            $table->string('word',5);
            $table->string('code',10)->nullable()->unique();
            $table->boolean('turn')->default(false);
            $table->boolean('winner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
