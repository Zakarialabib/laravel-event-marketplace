<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::active()->paginate(3);

        return view('front.index', compact('products'));
    }

    public function catalog()
    {
        return view('front.catalog');
    }

    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->first() ?? abort(404);

        return view('front.product', compact('product'));
    }

    public function categories()
    {
        return view('front.categories');
    }

    public function categoryPage($slug)
    {
        $category = Category::where('slug', $slug)->first() ?? abort(404);

        return view('front.category-page', compact('category'));
    }

    public function subcategories()
    {
        return view('front.subcategories');
    }

     public function SubcategoryPage($slug)
     {
         $subcategory = Subcategory::where('slug', $slug)->first() ?? abort(404);

         return view('front.subcategory-page', compact('subcategory'));
     }

    public function brands()
    {
        return view('front.brands');
    }

    public function brandPage($slug)
    {
        $brand = Brand::where('slug', $slug)->first() ?? abort(404);

        return view('front.brand-page', compact('brand'));
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

    public function myaccount()
    {
        return view('front.user-account');
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
