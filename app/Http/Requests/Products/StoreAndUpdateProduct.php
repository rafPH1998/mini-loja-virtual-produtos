<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAndUpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->product;

        return [
            'name'               => ['required', 'min:3', 'max:100', Rule::unique('products')->ignore($id, 'id')],
            'image'              => ['required'],
            'type'               => [
                'required',
                Rule::in(['livros', 'jogos', 'roupas', 'eletronicos', 'brinquedos', 'acessorios', 'perfumaria']),
            ],
            'price'              => 'required|integer',
            'discount'           => 'nullable',
            'description'        => 'required|min:3|max:100',
            'quantity_inventory' => 'required|integer|min:1',
            'quality'      => [
                'required',
                Rule::in(['novo', 'semi_novo', 'bom', 'medio']),
            ],
        ];
    }
}
