<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create()
    {
        return view('address.create', [
            'user' => auth()->user()
        ]);
    }

    public function store(StoreAddressRequest $request, Address $address)
    {    
        $loggedUser = auth()->user();

        try {
            $addresses = Address::with('user')
                                ->where('user_id', '=', $loggedUser->id)
                                ->count();

            if ($addresses >= 4) {
                return redirect()
                            ->route('address.create')
                            ->with('error', "O número máximo de endereço que você pode cadastrar é 4!");
            }

            $address->fill([
                'address'   => $request->get('address'),
                'street'    => $request->get('street'),
                'number'    => $request->get('number'),
                'district'  => $request->get('district'),
                'phone'     => $request->get('phone'),
                'cellphone' => $request->get('cellphone'),
                'user_id'   => $loggedUser->id
            ]);

            $address->save();
    
            return redirect()->route('address.create')
                            ->with('success', "Endereço cadastrado para cliente {$loggedUser->name} com sucesso!");


        } catch (\Throwable $th) {
            return redirect()->route('address.create')
                             ->with('error', $th->getMessage());
        }
    }


}
