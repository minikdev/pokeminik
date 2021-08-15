<?php

namespace App\Console\Commands;

use App\Models\Item;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class get_items extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minik:get_items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes HTTP request to get Items';

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
    {
        $limit="150";
        $url = 'https://pokeapi.co/api/v2/item/?limit='.$limit;
        $httpClient = new Client();
        $request = $httpClient->get($url);
        $response = json_decode($request->getBody()->getContents());
        $itemAPIURLS = collect($response->results)->map(function ($result){
            return $result->url;
        });
        $alreadyExistsCount = 0;
        $addedCount = 0;
        for ($i=0; $i < count($itemAPIURLS); $i++) {

            $itemRequest = $httpClient->get($itemAPIURLS[$i]);
            $itemResponse = json_decode($itemRequest->getBody());
            $alreadyExistItem = Item::query()->where('id',$itemResponse->id)->first();

            if ($alreadyExistItem) {
                $alreadyExistItem->id =$itemResponse->id;
                $alreadyExistItem->name =$itemResponse->name;
                $alreadyExistItem->cost =$itemResponse->cost;
                $alreadyExistItem->sprites =$itemResponse->sprites;
                $alreadyExistItem->flavor_text_entries =$itemResponse->flavor_text_entries;
                $alreadyExistItem->category =$itemResponse->category;
                $alreadyExistItem->save();

                $alreadyExistsCount++;
            }else{
                $item = new Item;
                $item->id =$itemResponse->id;
                $item->name =$itemResponse->name;
                $item->cost =$itemResponse->cost;
                $item->sprites =$itemResponse->sprites;
                $item->flavor_text_entries =$itemResponse->flavor_text_entries;
                $item->category =$itemResponse->category;
                $item->save();

                $addedCount++;
            }

        }
        echo collect([ "Added:" =>$addedCount," Updated:" => $alreadyExistsCount]);
        return 0;
    }
}
