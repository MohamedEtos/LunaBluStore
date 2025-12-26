<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Product;
use App\Models\orders;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

         $count_vistors = Visit::distinct('ip_address')->count('ip_address');
        $today_vistors = Visit::whereDate('created_at', now())->distinct('ip_address')->count('ip_address');
        $product_count = product::count();
        $orders_count = orders::count();
        // Visit::where('url', 'products')->count();اذا كنت تريد حساب صفحه معينه


        return view('admin.index', [
            'count_vistors' => $count_vistors,
            'today_vistors' => $today_vistors,
            'product_count' => $product_count,
            'orders_count' => $orders_count,
        ]);

    }
}
