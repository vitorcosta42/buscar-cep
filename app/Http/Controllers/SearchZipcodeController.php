<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;

class SearchZipcodeController extends Controller
{
    public function searchZipcode($zipcode)
    {
        $response = Http::get("https://viacep.com.br/ws/{$zipcode}/json/");
        return $response->json();
        $response = Http::get("");
    }
}
