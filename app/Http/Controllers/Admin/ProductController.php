<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Product;
use App\Models\Prodimg;
use App\Models\FabricType;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{
    public function index(Request $request)
    {

        $Productlist = Product::get();
        $fabrics = FabricType::get();
        $categories =  Category::get();

        return view('admin.product.productlist',[
            'Productlist' => $Productlist,
            'fabrics' => $fabrics,
            'categories' => $categories
        ]);

    }


    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string',
            'cat' => 'required|numeric|exists:App\Models\Category,id',
            'fabric_type'=>'required|string',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'desc'=>'required|string',
            'mainImage'=>'required|mimes:jpeg,png,jpg,gif,webp|max:51200',
        ],[
            'mainImage.required'=>'يرجي اضافه صور',
            'mainImage.mimes'=>'الامتدادات المسموح بها فقط (jpeg,png,jpg,gif,webp)',
            'mainImage.max'=>'يجب الا يكون حجم الصوره اكبر من 50 MB',
            'name.required'=>'الاسم مطلوب',
            'price.required'=>'السعر مطلوب',
            'stock.numeric'=>'يجب ان يكون الكميه رقم',
        ]);

        DB::transaction(function () use ($request) {

            if ($request->hasFile('mainImage')) {
                $file = $request->file('mainImage');
                $sizes = [
                    320,
                    480,
                    800,
                    1200,
                ];

                $imageName = Str::random(20);
                $paths = [];

                foreach ($sizes as $width) {

                    $image = Image::make($file)
                        ->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('webp', 85);

                    $fileName = "{$imageName}-{$width}.webp";
                    $path = "storage/images/{$fileName}";

                    $image->save(public_path($path));

                    $paths[$width] = $path;
                }

                // الصورة الأساسية (Fallback)
                $main_image = $paths[800];

            } else {
                $main_image = null;
            }
            if ($request->hasFile('img2')) {
                $file = $request->file('img2');
                $sizes = [
                    320,
                    480,
                    800,
                    1200,
                ];

                $imageName = Str::random(20);
                $paths = [];

                foreach ($sizes as $width) {

                    $image = Image::make($file)
                        ->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('webp', 85);

                    $fileName = "{$imageName}-{$width}.webp";
                    $path = "storage/images/{$fileName}";

                    $image->save(public_path($path));

                    $paths[$width] = $path;
                }

                // الصورة الأساسية (Fallback)
                $img2 = $paths[800];

            } else {
                $img2 = null;
            }
            if ($request->hasFile('img3')) {
                $file = $request->file('img3');
                $sizes = [
                    320,
                    480,
                    800,
                    1200,
                ];

                $imageName = Str::random(20);
                $paths = [];

                foreach ($sizes as $width) {

                    $image = Image::make($file)
                        ->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('webp', 85);

                    $fileName = "{$imageName}-{$width}.webp";
                    $path = "storage/images/{$fileName}";

                    $image->save(public_path($path));

                    $paths[$width] = $path;
                }

                // الصورة الأساسية (Fallback)
                $img3 = $paths[800];

            } else {
                $img3 = null;
            }
            if ($request->hasFile('img4')) {
                $file = $request->file('img4');
                $sizes = [
                    320,
                    480,
                    800,
                    1200,
                ];

                $imageName = Str::random(20);
                $paths = [];

                foreach ($sizes as $width) {

                    $image = Image::make($file)
                        ->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('webp', 85);

                    $fileName = "{$imageName}-{$width}.webp";
                    $path = "storage/images/{$fileName}";

                     $image->save(public_path($path));

                    $paths[$width] = $path;
                }

                // الصورة الأساسية (Fallback)
                $img4 = $paths[800];

            } else {
                $img4 = null;
            }



            $product = Product::create([
                "name" => $request->name,
                "cat_id" => $request->cat,
                "productDetalis" => $request->desc,
                "price" => $request->price,
                "stock" => $request->stock,
                "fabric_id" => $request->fabric_type,


            ]);

            $product->product_img_p()->create([
                "mainImage" => $main_image,
                "img2" => $img2,
                "img3" => $img3,
                "img4" => $img4,
                'alt1' => $request->alt1,
                'alt2' => $request->alt2,
                'alt3' => $request->alt3,
                'alt4' => $request->alt4,
            ]);


        });

        return redirect()->back()->with(['success'=>'اضافه منتج']);


    }


    public function edit_product(Request $request)
    {


        $request->validate([
            'name'=>'required|string',
            'cat' => 'required|numeric|exists:App\Models\Category,id',
            'fabric_type'=>'required|string',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'desc'=>'required|string',
            'mainImage'=>'mimes:jpeg,png,jpg,gif,webp|max:51200',
        ],[
            'mainImage.mimes'=>'الامتدادات المسموح بها فقط (jpeg,png,jpg,gif,webp)',
            'mainImage.max'=>'يجب الا يكون حجم الصوره اكبر من 50 MB',
            'name.required'=>'الاسم مطلوب',
            'price.required'=>'السعر مطلوب',
            'stock.numeric'=>'يجب ان يكون الكميه رقم',
        ]);


        DB::transaction(function () use ($request) {

        $oldimgname = prodimg::where('product_id',$request->product_id)->first();

            if($request->hasFile('mainImage')){
                $image  = ImageManagerStatic::make($request->file('mainImage'))->encode('webp')->resize(566,700);
                $imageName = Str::random().'.webp';
                $image->save(public_path('storage/images/'. $imageName));
                $main_image = 'storage/images/'. $imageName;
            }else{
                $main_image = $oldimgname->mainImage;
            };
            if($request->hasFile('img2')){
                $image  = ImageManagerStatic::make($request->file('img2'))->encode('webp')->resize(566,700);
                $imageName = Str::random().'.webp';
                $image->save(public_path('storage/images/'. $imageName));
                $img2 = 'storage/images/'. $imageName;
            }else{
                $img2 = $oldimgname->img2;
            };
            if($request->hasFile('img3')){
                $image  = ImageManagerStatic::make($request->file('img3'))->encode('webp')->resize(566,700);
                $imageName = Str::random().'.webp';
                $image->save(public_path('storage/images/'. $imageName));
                $img3 = 'storage/images/'. $imageName;
            }else{
                $img3 = $oldimgname->img3;
            };
            if($request->hasFile('img4')){
                $image  = ImageManagerStatic::make($request->file('img4'))->encode('webp')->resize(566,700);
                $imageName = Str::random().'.webp';
                $image->save(public_path('storage/images/'. $imageName));
                $img4 = 'storage/images/'. $imageName;
            }else{
                $img4 = $oldimgname->img4;
            };


            $product = Product::find($request->product_id);

            $product->update([
                "name" => $request->name,
                "cat_id" => $request->cat,
                "FabricType" => $request->fabric_type,
                "productDetalis" => $request->desc,
                "price" => $request->price,
                "stock" => $request->stock,
            ]);


            $product->product_img_p()->update([
                "mainImage" => $main_image,
                "img2" => $img2,
                "img3" => $img3,
                "img4" => $img4,
            ]);

        });

        return redirect()->back()->with(['success'=>'اضافه منتج']);




    }

    public function destroy($productId)
    {
        $Product = Product::findOrFail($productId);
        $Product->delete();

        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }







}
