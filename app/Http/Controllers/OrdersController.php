<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{

public function index(Request $request)
    {
    $request->validate([
        'phone' => [
            'required',
            'regex:/^(?:\+20|0020|0)?1[0125]\d{8}$/'
        ]
]);    }


}
