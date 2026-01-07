<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Shaping_Coast;

class OrdersController extends Controller
{
    public function index()
    {

        $Orderlist = Orders::with('items')->get();
        $ProductList = Product::get();
        $Shaping_CoastList = Shaping_Coast::get();

        return view('admin.orders.index',[
            'Orderlist' => $Orderlist,
            'ProductList' => $ProductList,
            'Shaping_CoastList' => $Shaping_CoastList,
        ]);
    }
    public function GetProductInfo($id)
    {
        $GetProductInfo = Product::where('id', $id)->first();
        return response()->json($GetProductInfo);

    }

    public function Send_whatsapp(Request $request)
    {
        Orders::where('id', $request->id)->update([
            'payment_status' => 'accepted'
        ]);

        return redirect()->route('Orders');

    }


}
