<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{

    public function index()
    {
        return response()->json(Address::paginate(5), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(Address::$rules, Address::$messages);
        $address = Address::create($validatedData);
        return response()->json($address, 201);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(Address::$rules, Address::$messages);
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $address->update($validatedData);
        return response()->json($address, 200);
    }

    public function destroy(string $id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return response()->json(['message' => 'Endereço excluído com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir o endereço'], 500);
        }
    }
}
