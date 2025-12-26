<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Tags\Image;

use App\Models\Product;

Artisan::command('generate:sitemap', function () {

    $sitemap = Sitemap::create();

    // الصفحة الرئيسية
    $sitemap->add(Url::create(url('/'))->setPriority(1.0));

    // صفحة المنتجات
    $sitemap->add(Url::create(url('/product'))->setPriority(0.9));

    // المنتجات + الصور
    Product::with('product_img_p')
        ->where('append', 1) // ✅ بدل is_active
        ->cursor()
        ->each(function ($product) use ($sitemap) {

            // ✅ اختار واحد من دول حسب مشروعك:
            // لو عندك slug:
            $productUrl = url("/product/{$product->slug}");

            // لو ماعندكش slug وبتستخدم id:
            // $productUrl = url("/product/{$product->id}");

            $urlTag = Url::create($productUrl)
                ->setPriority(0.8)
                ->setLastModificationDate($product->updated_at);

            foreach ($product->product_img_p as $img) {
                if (!empty($img->mainImage)) {
                    $urlTag->addImage(
                        Image::create(asset('storage/' . $img->mainImage))
                            ->setTitle($product->name)
                    );
                }
            }

            $sitemap->add($urlTag);
        });

    $sitemap->writeToFile(public_path('sitemap.xml'));

    $this->info('Sitemap generated successfully!');

})->purpose('Generate sitemap.xml for the website');


// ✅ نفس اسم الأمر بالظبط
Schedule::command('generate:sitemap')->daily()->at('03:00');
// Schedule::command('generate:sitemap')->everyMinute();

