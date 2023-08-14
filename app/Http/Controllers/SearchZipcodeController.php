<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class SearchZipcodeController extends Controller
{

    protected array $rules = [

    ];
    protected array $messages = [

    ];
    public function searchZipcode($zipcode)
    {
        $response = Http::get("https://viacep.com.br/ws/{$zipcode}/json/");
        return $response->json();
        $response = Http::get("");
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate(Address::$rules, Address::$messages);
        Address::create($validatedData);
        return redirect()->route('addresses.index')->with('success', 'Endereço criado com sucesso!');
    }
}
