<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Stringable::macro('letters',fn()=>str_split($this));
        Stringable::macro('orderedLetters',fn()=>collect($this->letters())->sort());
        Stringable::macro('comparableLetters',function(){
            $lettersCount = [];
            $comparableLetters = [];
            foreach($this->orderedLetters() as $letter){
                $lettersCount[$letter] ??= 0;
                $comparableLetters[] = $letter . (++$lettersCount[$letter]);
            }
            return collect($comparableLetters);
        });
    }
}
