<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sitemap generator for current application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = public_path('sitemap.xml');
        // dd($path);
        $products = Product::all();
        $blogs = Blog::all();
        // set_time_limit(3600);
        Sitemap::create()
            ->add(config('app.url'))
            ->add(Url::create('/about-us'))
            ->add(Url::create('/toyota-4wd-hilux'))
            ->add(Url::create('/how-to-buy'))
            ->add(Url::create('https://vigoasia1.click2stream.com/'))
            ->add($products)
            ->add(Url::create('/privacy-policy'))
            ->add(Url::create('/terms-condition'))
            ->add(Url::create('/disclaimer'))
            ->add(Url::create('/blog'))
            ->add($blogs)
            ->add(Url::create('/sitemap.xml'))
            ->writeToFile($path);
        // SitemapGenerator::create('https://sgasiacars.com')->writeToFile($path);
        $this->info('Sitemap generated!');
    }
}
