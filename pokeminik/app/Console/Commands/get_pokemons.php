<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class get_pokemons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minik:get_pokemons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes HTTP request to get Pokemons';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   $limit="151";
        $url = 'https://pokeapi.co/api/v2/pokemon/?limit='.$limit;
        $httpClient = new Client();
        $request = $httpClient->get($url);
        $response = json_decode($request->getBody()->getContents());
        $pokemonAPIURLS = collect($response->results)->map(function ($result){
            return $result->url;
        });

        $alreadyExistsCount = 0;
        $addedCount = 0;
        for ($i=0; $i < count($pokemonAPIURLS); $i++) {

            $pokemonRequest = $httpClient->get($pokemonAPIURLS[$i]);
            $pokemonResponse = json_decode($pokemonRequest->getBody());
            $alreadyExistsPokemon = Pokemon::query()->where('id',$pokemonResponse->id)->first();

            if ($alreadyExistsPokemon) {
                $alreadyExistsCount++;
                $alreadyExistsPokemon->id =$pokemonResponse->id;
                $alreadyExistsPokemon->name =$pokemonResponse->name;
                $alreadyExistsPokemon->moves =$pokemonResponse->moves;
                $alreadyExistsPokemon->types =$pokemonResponse->types;
                $alreadyExistsPokemon->stats =$pokemonResponse->stats;
                $alreadyExistsPokemon->sprites =$pokemonResponse->sprites;
                $alreadyExistsPokemon->base_experience =$pokemonResponse->base_experience;
                $alreadyExistsPokemon->height =$pokemonResponse->height;
                $alreadyExistsPokemon->weight =$pokemonResponse->weight;
                $alreadyExistsPokemon->save();
            }else{
                $pokemon = new Pokemon;
                $pokemon->id =$pokemonResponse->id;
                $pokemon->name =$pokemonResponse->name;
                $pokemon->moves =$pokemonResponse->moves;
                $pokemon->types =$pokemonResponse->types;
                $pokemon->stats =$pokemonResponse->stats;
                $pokemon->sprites =$pokemonResponse->sprites;
                $pokemon->base_experience =$pokemonResponse->base_experience;
                $pokemon->height =$pokemonResponse->height;
                $pokemon->weight =$pokemonResponse->weight;
                $pokemon->save();
                $addedCount++;
            }

        }
        echo collect([ "Added:" =>$addedCount," Updated:" => $alreadyExistsCount]);

        return 0;
    }
}
