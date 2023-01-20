<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __invoke()
    {
        return view('address.create', [
            'user' => auth()->user()
        ]);
    }

    public function store()
    {
      dd('opa');
    }


}
