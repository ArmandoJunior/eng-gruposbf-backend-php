<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            'USD' => 'Estados Unidos',
            'EUR' => 'Países da União Europeia',
            'INR' => 'Índia'
        ];

        foreach ($currencies as $currencyCode => $territory) {
            $response = $this->getResponseCurrencyApi($currencyCode);
            $body = $response->body();
            $jsonResponse = json_decode($body);
            $attribute = "BRL$currencyCode";
            $json = $jsonResponse->$attribute;
            Price::query()->create([
                'value' => $json->high,
                'currency_code' =>  $json->codein,
                'territory' =>  $territory
            ]);
        }
    }

    private function getResponseCurrencyApi(string $currencyCode): Response
    {
        return Http::get("https://economia.awesomeapi.com.br/last/BRL-$currencyCode");
    }
}
