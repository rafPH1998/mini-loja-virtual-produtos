<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'authUser' => auth()->user()
        ]);
    }

    public function edit()
    {
        dd('chegou');
    }
}
