<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml automatically';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // صفحات ثابتة
        $sitemap->add(Url::create(route('home'))->setPriority(1.0));
        $sitemap->add(Url::create(route('product'))->setPriority(0.9));

        // الأقسام (اختياري)
        // foreach (\App\Models\Category::where('is_active', 1)->cursor() as $cat) {
        //     $sitemap->add(
        //         Url::create(route('category.show', $cat->slug))
        //             ->setLastModificationDate($cat->updated_at)
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        //             ->setPriority(0.7)
        //     );
        // }

        // المنتجات
        foreach (\App\Models\Product::where('append', 1)->cursor() as $p) {
            $sitemap->add(
                Url::create(route('product.show', $p->slug)) // أو /products/{$p->slug}
                    ->setLastModificationDate($p->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('sitemap.xml generated successfully.');
        return self::SUCCESS;
    }
}
