<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $authUser = auth()->user()->id;

        return [
            'address'   => ['required', 'min:2', 'max:100'],
            'street'    => ['required', 'min:5', 'max:100'],
            'number'    => ['required', 'min:1', 'max:4', Rule::unique('addresses')->ignore($authUser)],
            'district'  => ['required', 'min:5', 'max:100'],
            'phone'     => ['nullable', 'min:10', 'max:10', Rule::unique('addresses')->ignore($authUser)],
            'cellphone' => ['required', 'min:11', 'max:11', Rule::unique('addresses')->ignore($authUser)],
        ];
    }
}
