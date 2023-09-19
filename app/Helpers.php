<?php

declare(strict_types=1);

namespace App;

use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Blog;
use App\Models\RaceLocation;
use App\Models\Menu;
use App\Models\Pagesetting;
use App\Models\Faq;
use App\Models\Race;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Helpers
{
    public static function pageSettings()
    {
        $pageSettings = Pagesetting::where('is_default', true)->first();

        if ( ! $pageSettings) {
            $pageSettings = Pagesetting::first();
        }

        return $pageSettings;
    }

    public static function getActiveCategories()
    {
        return Category::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveSubcategories()
    {
        return Subcategory::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveFaqs()
    {
        return Faq::active()
            ->select('id', 'title', 'description')
            ->get();
    }

    public static function getActiveProductCategories()
    {
        return ProductCategory::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveBrands()
    {
        return Brand::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveRaceLocations()
    {
        return RaceLocation::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveRace()
    {
        return Race::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActivePages()
    {
        return Page::select('id', 'slug', 'title')
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public static function getActiveFeaturedBlogs()
    {
        return Blog::active()->where('featured', true)
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public static function getActiveBlogs()
    {
        return Blog::active()
            ->select(['id', 'title', 'slug', 'image', 'description', 'created_at'])
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public static function getMenusByPlacement(string $placement)
    {
        return Menu::active()->where('placement', $placement)->get();
    }

    public static function categoryName($category_id)
    {
        return Category::find($category_id)->name ?? null;
    }

    public static function brandName($brand_id)
    {
        return Brand::find($brand_id)->name;
    }

    /** @return string|null */
    public static function productLink(mixed $product)
    {
        if ($product) {
            return route('front.product', $product->slug);
        }

        return null;
    }

    /** @return mixed */
    public static function createCategory(mixed $category)
    {
        // Make sure $category is a string
        $category = implode('', $category);

        $slug = Str::slug($category, '-');

        return Category::create([
            'name' => $category,
            'slug' => $slug,
        ])->id;
    }

    /** @return mixed */
    public static function createBrand(mixed $brand)
    {
        // Make sure $brand is a string
        $brand = implode('', $brand);

        return Brand::create([
            'name' => $brand,
            'slug' => Str::slug($brand, '-'),
        ])->id;
    }

    public static function handleUpload($image, $width, $height, $productName): string
    {
        $imageName = Str::slug($productName).'-'.Str::random(5).'.'.$image->extension();

        $img = Image::make($image->getRealPath())->encode('webp', 85);

        // we need to resize image, otherwise it will be cropped
        if ($img->width() > $width) {
            $img->resize($width, null, static function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        if ($img->height() > $height) {
            $img->resize(null, $height, static function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        $watermark = Image::make(public_path('images/logo.png'));
        $watermark->opacity(25);
        $watermark->width();
        $watermark->height();
        $img->insert($watermark, 'bottom-left', 20, 20)->resizeCanvas($width, $height, 'center', false, '#ffffff');

        $img->stream();

        Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');

        return $imageName;
    }

    public static function addMediaFromUrlToCollection(HasMedia $model, string $url, string $collectionName): Media
    {
        return $model->addMediaFromUrl($url)->toMediaCollection($collectionName);
    }
}
