<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\FabricType;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
public function index(Request $request)
{
    // عدد المنتجات اللي تتحمل أول مرة

    // أول تحميل للصفحة
        $products = Product::with(['Category', 'FabricType'])->paginate(12);
        $fabrics = FabricType::get();

    return view('store.index', [
        'products' => $products,
        'fabrics' => $fabrics,
        'title' => 'LunaBlu | متجر طرح حريمي عصرية – خامات فاخرة وأسعار مناسبة',
        'description' => 'LunaBlu متجر متخصص في بيع الطرح الحريمي العصرية بخامات عالية وجودة مميزة. اكتشفي أحدث الموديلات والألوان المناسبة لكل الإطلالات مع أسعار تنافسية وتجربة تسوق سهلة وآمنة.',
        'image' =>  asset('store/images/icons/favicon.png'),
        'url' => url()->current(),
    ]);
}








}
