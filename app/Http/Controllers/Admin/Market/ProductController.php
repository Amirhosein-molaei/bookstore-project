<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\storeProductRequest;
use App\Http\Requests\Admin\Market\updateProductRequest;
use App\Models\Content\Publisher;
use App\Models\Content\Tag;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publishers = Publisher::all();
        $writers = Writer::all();
        $tags = Tag::where('status', 0)->get();
        $categories = ProductCategory::where('parent_id', null)->get();
        return view('admin.market.product.create', compact('publishers', 'writers', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductRequest $request, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        $tagIds = $inputs['tags'];
        unset($inputs['tags']);
        
        if ($inputs['discount_percentage']) {
            
            $inputs['discounted_price'] = $inputs['price'] - $inputs['price'] * $inputs['discount_percentage'] / 100;
            $expireDate = substr($inputs['discount_expires_at'], 0, 10);
            
            $inputs['discount_expires_at'] = date('Y-m-d H:i:s', (int)$expireDate);
        } else {
            unset($inputs['discount_expires_at']);
        }

        if ($request->hasFile('image')) {

            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        } else {
            return redirect()->back()->with('swal-error', 'فیلد تصویر اجباری است');
        }

        $product = Product::createOrRestore(['title' => $inputs['title']], $inputs);

        $product->tags()->attach($tagIds);

        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.market.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $publishers = Publisher::all();
        $writers = Writer::all();

        // tags are assigned to product already, can't be in $tags. becauase in tag-selection section in edit page, 
        // they will be repeated and therfore user can choose them again and duplicate records will appear in pivot table
        $tags = Tag::where('status', 0)->whereNotIn('id', $product->tags()->pluck('id'))->get();
        $categories = ProductCategory::where('parent_id', null)->get();
        return view('admin.market.product.edit', compact('product', 'publishers', 'writers', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, Product $product, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        $tagIds = $inputs['tags'];
        unset($inputs['tags']);

        if ($inputs['discount_percentage']) {

            $inputs['discounted_price'] = $inputs['price'] - $inputs['price'] * $inputs['discount_percentage'] / 100;
            $expireDate = substr($inputs['discount_expires_at'], 0, 10);
            
            $inputs['discount_expires_at'] = date('Y-m-d H:i:s', (int)$expireDate);
        } else {
            unset($inputs['discount_expires_at']);
        }

        if ($request->hasFile('image')) {

            if (!empty($product->image)) {
                $imageUploadService->removeImage($product->image);
            }

            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }

        $product->update($inputs);

        /* 
            this method will check records in pivot table 
            inert's new one's and deletes those that aren't in $tagIds
        */
        $product->tags()->sync($tagIds);

        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->tags()->detach();
        $product->delete();
        return to_route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت حذف شد');
    }
}
