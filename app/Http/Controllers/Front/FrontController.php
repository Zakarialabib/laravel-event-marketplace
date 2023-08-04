<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->first() ?? abort(404);

        return view('front.product', compact('product'));
    }

    public function subcategories()
    {
        return view('front.subcategories');
    }

    public function brands()
    {
        return view('front.brands');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function about()
    {
        return view('front.about');
    }

    public function blog()
    {
        $blogs = Blog::with('category')->get();

        return view('front.blog', compact('blogs'));
    }

    public function blogPage($slug)
    {
        $blog = Blog::where('slug', $slug)->first() ?? abort(404);

        return view('front.blog-page', compact('blog'));
    }

    public function redirect($url)
    {
        // return view('front.redirect', compact('url'));
        return redirect()->away($url);
    }

    public function dynamicPage($slug)
    {
        $page = Page::where('slug', $slug)->first() ?? abort(404);

        return view('front.dynamic-page', compact('page'));
    }

    public function generateSitemaps()
    {
        try {
            Artisan::call('generate:sitemap');

            Log::info('Sitemap generated successfully!');

            return back();
        } catch (Throwable $th) {
            Log::info('Sitemap generation failed!', $th->getMessage());

            return back();
        }
    }
}
