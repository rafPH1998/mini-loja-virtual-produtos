<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $authUser = auth()->user()->id;

        $rules = [
            'name' => [
                'required',
                'min:2',
                'max:100',
                'string',
                Rule::unique('users')->ignore($authUser),

            ],
            'email' => [
                'required',
                'email',
                "unique:users,email,{$authUser},id",
                Rule::unique('users')->ignore($authUser),
            ],
            'avatar' => [
                'nullable',
                'image',
                'max: 1024'
            ]
        ];

        if ($this->method("PUT")) {

            $rules['password'] = [
                'nullable',
                'min:4',
                'max:20'
            ];
        }

        return $rules;
    }
}
