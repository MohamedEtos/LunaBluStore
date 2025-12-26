<!-- <?php

use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
 use Illuminate\Support\Facades\Schedule;
use App\Models\Product; // لو عندك منتجات
use App\Models\Category; // لو عندك أقسام
Artisan::command('generate:sitemap', function () {

    $sitemap = Sitemap::create();

    // صفحات ثابتة
    $sitemap->add(Url::create('/')->setPriority(1.0));
    $sitemap->add(Url::create('/product')->setPriority(0.9));
    $sitemap->add(Url::create('/shopingcart')->setPriority(0.6));
    $sitemap->add(Url::create('/cart')->setPriority(0.2));

    // منتجات (اختياري، لو عندك Model Product)
        if (class_exists(Product::class)) {
            foreach (Product::all() as $product) {
                $sitemap->add(
                    Url::create("/product/{$product->name}")
                        ->setPriority(0.8)
                );
            }
        }

    // أقسام (اختياري، لو عندك Model Category)
    if (class_exists(Category::class)) {
        foreach (Category::all() as $category) {
            $sitemap->add(
                Url::create("/category/{$category->name}")
                    ->setPriority(0.7)
            );
        }
    }

    // حفظ الملف في public/sitemap.xml
    $sitemap->writeToFile(public_path('sitemap.xml'));

    $this->info('Sitemap generated successfully!');

})->purpose('Generate sitemap.xml for the website');




Schedule::command('sitemap:generate')
    ->daily()
    ->at('03:00');
