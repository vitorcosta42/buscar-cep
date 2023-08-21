<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'zipcode',
        'ddd',
        'street',
        'city',
        'state',
        'neighborhood',
    ];

      public static $rules = [
        'zipcode' => 'required',
        'ddd'=>'required|min:2|max:2',
        'state' => 'required|min:2|max:2',
        'city' => 'required',
        'neighborhood' => 'nullable',
        'street' => 'nullable',
    ];

    public static $messages = [
        'zipcode.required' => 'O campo CEP é obrigatório.',
        'ddd.required' => 'O campo DDD é obrigatório.',
        'state.required' => 'O campo ESTADO é obrigatório.',
        'city.required' => 'O campo CIDADE é obrigatório.',
        'ddd.min' => 'O campo DDD deve ter ao menos :min caracteres.',
        'state.min' => 'O campo ESTADO deve ter ao menos :min caracteres.',
        'ddd.max' => 'O campo DDD não pode ter mais de :max caracteres.',
        'state.max' => 'O campo ESTADO não pode ter mais de :max caracteres.'
    ];
}
