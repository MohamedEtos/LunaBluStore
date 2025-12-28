<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FabricType;
use App\Models\Categotry;
class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::with(['Category', 'FabricType'])->paginate(12);
        $fabrics = FabricType::get();

        return view('store.product', [
            'products' => $products,
            'fabrics' => $fabrics,
            'title' => 'LunaBlu | متجر طرح حريمي عصرية – خامات فاخرة وأسعار مناسبة',
            'description'=>'تسوّق أحدث المنتجات بجودة عالية وأسعار مميزة. اكتشف تشكيلتنا المتنوعة التي تناسب جميع الأذواق مع تجربة شراء سهلة وآمنة.',
            'image' =>  asset('store/images/icons/favicon.png'),
            'url' => url()->current(),
        ]);

        // return view('store.product', compact('products'));
    }

    public function show(Product $product)
    {
        $products = Product::with(['Category', 'FabricType'])->get();

        return view('store.productshow',[
            'product' => $product,
            'products' => $products,
            'title' => $product->name . ' | LunaBlu',
            'description' =>$product->slug . '||' . $product->productDetalis,
            'image' =>  $product->product_img_p->mainImage,
            'url' => url()->current(),
        ]);

    }



}
