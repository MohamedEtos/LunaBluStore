<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

    private function buildCart(array $cart): array
    {
        $ids = array_keys($cart);
        // $products = Product::whereIn('id', $ids)->get()->keyBy('id');
    $products = Product::whereIn('id', $ids)
        ->with(['product_img_p:id,product_id,mainImage'])
        ->get()
        ->keyBy('id');

        $items = [];
        $subtotal = 0;
        $count = 0;

        foreach ($cart as $pid => $row) {
            // $p = $products->get((int)$pid);
            $p = $products->get($pid);
            $image = $p->product_img_p
                ? asset('storage/' . $p->product_img_p->mainImage)
                : null;
            if (!$p) continue;

            $qty = (int) $row['qty'];
            $line = (float) $p->price * $qty;

            $items[] = [
                'product_id' => $p->id,
                'name' => $p->name,
                'price' => (float) $p->price,
                'qty' => $qty,
                'line_total' => $line,
                 'image' => $image,
                'stock_available' => (int) $p->stock,
            ];

            $subtotal += $line;
            $count += $qty;
        }

        return [
            'items' => $items,
            'subtotal' => (float) $subtotal,
            'count' => (int) $count,
        ];
    }
}
