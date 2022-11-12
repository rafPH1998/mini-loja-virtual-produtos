<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifyProductController extends Controller
{
    public function notify()
    {
        return view('products.notifys');
    }
}
