<?php


namespace App\DB\Seed;


use App\DB\SeedInterface;
use App\Model\HttpRequest;
use function MongoDB\BSON\toJSON;

class HttpRequestSeed implements SeedInterface
{

    /**
     * @param array $seeds
     */
    public function run(array $seeds): void
    {
        foreach($seeds as $seed){
            HttpRequest::create($seed);
        }
    }

    /**
     * @return array
     */
    public function default(): array
    {
        return [
            [
                'name' => 'test',
                'url' => "https://api.binance.com",
                'uri' => "/api/v3/ticker/24hr",
                'options' => json_encode(array('query' => array('symbol'=>'BTCEUR'))),

            ]
        ];
    }
}