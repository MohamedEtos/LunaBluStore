<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Orders;
use App\Models\Order_items;
use App\Models\Order_addresses;
use App\Models\Shaping_Coast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private string $key = 'cart.items';

    public function show(Request $request)
    {
        $items = session($this->key, []);
        return response()->json($this->buildCart($items));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'qty' => ['nullable','integer','min:1'],
        ]);

        $pid = (int) $data['product_id'];
        $qty = (int) ($data['qty'] ?? 1);

        $cart = session($this->key, []);

        if (isset($cart[$pid])) {
            $cart[$pid]['qty'] += $qty;
        } else {
            $cart[$pid] = ['product_id' => $pid, 'qty' => $qty];
        }

        session([$this->key => $cart]);

        return response()->json([
            'message' => 'added',
            'cart' => $this->buildCart($cart),
        ], 201);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer'],
            'qty' => ['required','integer','min:1'],
        ]);

        $pid = (int) $data['product_id'];
        $qty = (int) $data['qty'];

        $cart = session($this->key, []);

        if (!isset($cart[$pid])) {
            return response()->json(['message' => 'item not found'], 404);
        }

        $cart[$pid]['qty'] = $qty;
        session([$this->key => $cart]);

        return response()->json([
            'message' => 'updated',
            'cart' => $this->buildCart($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer'],
        ]);

        $pid = (int) $data['product_id'];
        $cart = session($this->key, []);

        unset($cart[$pid]);
        session([$this->key => $cart]);

        return response()->json([
            'message' => 'removed',
            'cart' => $this->buildCart($cart),
        ]);
    }

    public function clear()
    {
        session()->forget($this->key);

        return response()->json([
            'message' => 'cleared',
            'cart' => [
                'items' => [],
                'subtotal' => 0,
                'count' => 0
            ]
        ]);
    }



private function shippingCost(?string $gov): float
{
    if (!$gov) return 0;

    $row = Shaping_Coast::where('name_ar', $gov)
        ->first(['shipping_cost','free_shipping']);

    if (!$row) return 0;

    return $row->free_shipping ? 0 : (float)$row->shipping_cost;
}


private function buildCart(array $cart): array
{
    $ids = array_keys($cart);

    $products = Product::whereIn('id', $ids)
        ->with(['product_img_p:id,product_id,mainImage'])
        ->get()
        ->keyBy('id');

    $items = [];
    $subtotal = 0;
    $count = 0;

    foreach ($cart as $pid => $row) {
        $p = $products->get($pid);
        if (!$p) continue;

        $image = $p->product_img_p ? asset($p->product_img_p->mainImage) : null;

        $qty = (int) $row['qty'];
        $line = (float) $p->price * $qty;

        $items[] = [
            'product_id' => $p->id,
            'name' => $p->name,
            'slug' => $p->slug,
            'price' => (float) $p->price,
            'qty' => $qty,
            'line_total' => $line,
            'image' => $image,
            'stock_available' => (int) $p->stock,
        ];

        $subtotal += $line;
        $count += $qty;
    }

    $gov = session('cart.governorate'); // هنخزنها هنا
    $shipping = $this->shippingCost($gov);
    $total = $subtotal + $shipping;

    return [
        'items' => $items,
        'subtotal' => (float) $subtotal,
        'shipping_cost' => (float) $shipping,
        'total' => (float) $total,
        'count' => (int) $count,
        'governorate' => $gov,
    ];
}



    public function shopingcart()
    {
        $cartData = $this->buildCart(session($this->key, []));
        $governorate = Shaping_Coast::pluck('name_ar')->toArray();
        return view('store.shoping-cart', [
            'cartData' => $cartData,
            'governorate' => $governorate,
            'title' => 'LunaBlu | سلة التسوق',
            'description' => 'استعرض محتويات سلة التسوق الخاصة بك وتحقق من المنتجات التي قمت بإضافتها قبل إتمام عملية الشراء في متجرنا الإلكتروني.',
            'image' =>  asset('store/images/icons/favicon.ico'),
            'url' => url()->current(),
        ]);
    }



        public function setGovernorate(Request $request)
    {
        $data = $request->validate([
            'governorate' => ['required','string','max:100'],
        ]);

        session(['cart.governorate' => $data['governorate']]);

        $cart = session($this->key, []);

        return response()->json([
            'message' => 'governorate_updated',
            'cart' => $this->buildCart($cart),
        ]);
    }

public function prossesCart(Request $request)
{

    // dd($request->all());

    $request->validate([
        'items' => ['required','array','min:1'],
        'items.*.id'  => ['required','integer','exists:products,id'],
        'items.*.qty' => ['required','integer','min:1'],
        'name' => 'Required|string|max:100',
        'phone' => ' Required|string|max:11',
        'governorate' => ' Required|string|max:100|exists:shaping__coasts,name_ar',
        'area' =>  ' Required|string|max:100',
        'address' => ' Required|string|max:200',
        'floor_number' => ' Required|string|max:20',
        'building' => ' Required|string|max:20',
        'note' => ' nullable|string|max:200',
    ]);

    return DB::transaction(function () use ($request) {

        // 1) جمّع الكميات لنفس المنتج: [product_id => qty]
        $items = collect($request->items)
            ->groupBy('id')
            ->map(fn($g) => (int) $g->sum('qty'))
            ->toArray();

        // 2) هات الأسعار: [id => price] + اقفل الصفوف للخصم الآمن
        $prices = Product::whereIn('id', array_keys($items))
            ->lockForUpdate()
            ->pluck('price', 'id')
            ->toArray();

        // (اختياري) تأكد المخزون يكفي
        $stocks = Product::whereIn('id', array_keys($items))
            ->pluck('stock', 'id')
            ->toArray();

        foreach ($items as $pid => $qty) {
            if (($stocks[$pid] ?? 0) < $qty) {
                // abort(422, "Insufficient stock for product id: $pid");
            return redirect()->back()->withInput()->with(['error'=>' الكمية المطلوبة غير متوفرة في المخزون من المنتج رقم: ' . $pid . ' ']);
            }
        }

        // 3) احسب subtotal من الداتا
        $subtotal = 0;
        foreach ($items as $pid => $qty) {
            $subtotal += ((float)($prices[$pid] ?? 0)) * $qty;
        }

        $shipping = 50; // عدّلها حسب نظامك
        $total = $subtotal + $shipping;

        // 4) أنشئ الأوردر
        $order = Orders::create([
            'user_ip' => $request->ip(),
            'order_number' => 'ORD' . time(),
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'total' => $total,
            'status' => 'done',
            'payment_method' => 'COD',
            'payment_status' => 'notaccepted',
        ]);


        $order_address = Order_addresses::create([
            'order_id' => $order->id,
            'full_name' => $request->name,
            'phone' => $request->phone,
            'governorate' =>  $request->governorate,
            'area' =>  $request->area,
            'address' => $request->address,
            'floor_number' => $request->floor_number,
            'building' => $request->building,
            'note' => $request->note,
        ]);

        // 5) جهّز الـ order items دفعة واحدة
        $rows = [];
        foreach ($items as $pid => $qty) {
            $price = (float)($prices[$pid] ?? 0);

            $rows[] = [
                'order_id'   => $order->id,
                'product_id' => (int)$pid,
                'quantity'   => (int)$qty,
                'price'      => $price,
                'total'      => $price * $qty,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // 6) خصم المخزون
            Product::where('id', $pid)->decrement('stock', $qty);
        }

        // إدخال مرة واحدة بدل create داخل loop
        Order_items::insert($rows);
        session()->forget($this->key); // ازاله السيشن عند اكمال الطلب
        $order_id = Orders::latest()->first();


        session()->put('success_order_id', $order->id);
        session()->put('can_view_success', true);

            return view ('store.successOrder',[ 
            'order' => $order_id,
            'title' => 'LunaBlu | تأكيد الطلب',
            'description' => 'تم تأكيد طلبك بنجاح في متجرنا الإلكتروني. شكرًا لاختيارك لنا!',
            'image' =>  asset('store/images/icons/favicon.ico'),
            'url' => url()->current(),
            ]);


        // return view('store.successOrder', [
        // // 'order_id' => $order_id,
        // 'title' => 'LunaBlu | تأكيد الطلب',
        // 'description' => 'تم تأكيد طلبك بنجاح في متجرنا الإلكتروني. شكرًا لاختيارك لنا!',
        // 'image' =>  asset('store/images/icons/favicon.ico'),
        // 'url' => url()->current(),
         // ]);


    });
}


}
