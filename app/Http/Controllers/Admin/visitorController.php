<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;


class VisitorController extends Controller
{
     public function index(Request $request)
    {
    $visitorsList = Visit::orderBy('id', 'desc')->get();
        return view('admin.visitors.visitorsList',[
            'visitorsList'=>$visitorsList,
        ]);
    }
}
