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


        $query = Product::query();
        $search = trim((string) $request->input('search', ''));

        $relations = ['Category', 'FabricType'];

        $query->where(function ($q) use ($search, $relations) {

            //  أعمدة المنتج نفسها
            $q->where('name', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
            ->orWhere('productDetalis', 'LIKE', "%{$search}%")
            ->orWhere('meta_title', 'LIKE', "%{$search}%")
            ->orWhere('meta_description', 'LIKE', "%{$search}%")
            ->orWhere('slug', 'LIKE', "%{$search}%");

            //  أعمدة العلاقات (حسب اللي موجود فعلاً في جداولهم)
            foreach ($relations as $relation) {
                $q->orWhereHas($relation, function ($q2) use ($search) {
                    $q2->where(function ($x) use ($search) {
                        $x->where('name', 'LIKE', "%{$search}%");
                        // ->orWhere('slug', 'LIKE', "%{$search}%"); // لو موجودة
                    });
                });
            }
        });

        $products = $query->latest()->paginate(12);


        return view('store.index', [
            'products' => $products,
            'fabrics' => $fabrics,
            'title' => 'LunaBlu | متجر طرح حريمي عصرية – خامات فاخرة وأسعار مناسبة',
            'description' => 'LunaBlu متجر متخصص في بيع الطرح الحريمي العصرية بخامات عالية وجودة مميزة. اكتشفي أحدث الموديلات والألوان المناسبة لكل الإطلالات مع أسعار تنافسية وتجربة تسوق سهلة وآمنة.',
            'image' =>  asset('store/images/icons/favicon.ico'),
            'url' => url()->current(),
        ]);
    }
}








