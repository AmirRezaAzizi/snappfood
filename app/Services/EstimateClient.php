<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class EstimateClient
{
    private string $url = 'https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7';

    public function get()
    {
        return Http::get($this->url)->json();
    }

}
