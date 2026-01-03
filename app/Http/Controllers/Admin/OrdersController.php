<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function index()
    {

        $Orderlist = Orders::with('items')->get();

        return view('admin.orders.index',[
            'Orderlist' => $Orderlist
        ]);
    }
    public function Send_whatsapp(Request $request)
    {
        Orders::where('id', $request->id)->update([
            'payment_status' => 'accepted'
        ]);

        return redirect()->route('Orders');

    }
}
