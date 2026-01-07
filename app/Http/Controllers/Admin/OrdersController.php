<?php

namespace App\Http\Controllers\Admin;

use DB;
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

        $product = Product::findOrFail($id);

        return response()->json([
            'price' => $product->price, // غيرها لو اسم العمود مختلف
        ]);

        // $GetProductInfo = Product::where('id', $id)->first();
        // return response()->json($GetProductInfo);

    }

    public function Send_whatsapp(Request $request)
    {
        Orders::where('id', $request->id)->update([
            'payment_status' => 'accepted'
        ]);

        return redirect()->route('Orders');

    }

    public function StoreOrder(Request $request)
    {

        // dd($request->all());

    $data = $request->validate([
        'items'                  => ['required','array','min:1'],
        'items.*.product_id'     => ['required','integer','exists:products,id'],
        'items.*.price'          => ['required','numeric','min:0'],
        'items.*.qty'            => ['required','numeric','min:0'],

        'shipping__coast'         => ['required','integer','exists:shaping__coasts,id'], // عدّل الجدول لو مختلف
        'descount'               => ['nullable','numeric','min:0'],

        'customer'               => ['required','string','max:255'],
        'area'                   => ['required','string','max:255'],
        'address'                => ['required','string','max:1000'],
        'bilding'                => ['nullable','string','max:50'],
        'floor_number'           => ['nullable','string','max:50'],

        'total'                  => ['nullable','numeric','min:0'],
    ]);

    return DB::transaction(function () use ($data) {

        // 1) subtotal من العناصر
        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += (float)$item['price'] * (float)$item['qty'];
        }

        // 2) shipping cost من الداتا بيز
        $shipping = Shaping_Coast::findOrFail($data['shaping__coasts']);
        $shippingCost = (float)$shipping->shipping_cost;

        // 3) discount
        $discount = (float)($data['descount'] ?? 0);

        // 4) total النهائي (لا نعتمد على total القادم من الفورم)
        $total = $subtotal + $shippingCost - $discount;
        if ($total < 0) $total = 0;

        // 5) حفظ Order
        $order = Order_items::create([
            'full_name'           => $data['customer'],
            'area'               => $data['area'],
            'address'            => $data['address'],
            'bilding'            => $data['bilding'] ?? null,
            'floor_number'       => $data['floor_number'] ?? null,

            'shipping_coast_id'  => $data['shipping__coast'],   // عدّل اسم العمود لو مختلف
            'shipping_cost'      => $shippingCost,
            'discount'           => $discount,
            'subtotal'           => $subtotal,
            'total'              => $total,
        ]);

        // 6) حفظ Order Items
        foreach ($data['items'] as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => (int)$item['product_id'],
                'price'      => (float)$item['price'],
                'qty'        => (float)$item['qty'],
                'line_total' => (float)$item['price'] * (float)$item['qty'],
            ]);
        }

        // return $order; // أو redirect تحت
    });

    // مثال لو عايز redirect:
    return redirect()->back()->with(['success'=>'تم حفظ الطلب بنجاح']);


    }


}
