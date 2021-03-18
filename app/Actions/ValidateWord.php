<?php

namespace App\Actions;

use App\Models\Word;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidateWord
{
    use AsAction;

    const API_ROOT = 'https://www.dictionaryapi.com/api/v3/references/collegiate/json/';

    public function handle(string $word)
    {
        $word = strtoupper($word);
        $wordRecord = Word::firstWhere('word',strtoupper($word));
        if($wordRecord) return $wordRecord->valid;

        $response = Http::get(self::API_ROOT.$word,['key'=>config('services.dictionaryapi.key')]);

        if(!$response->ok()){
            Log::error('Dictionary API response invalid',['status'=>$response->status(),'response'=>$response->json()]);
            throw new \Exception('Dictionary API response invalid');
        }

        $json = $response->collect();
        $valid = !$json->every(fn($item)=>is_string($item));
        Word::create([
            'word'=>$word,
            'valid'=>$valid,
            'api_response'=>$json,
        ]);
        return $valid;
    }
}
