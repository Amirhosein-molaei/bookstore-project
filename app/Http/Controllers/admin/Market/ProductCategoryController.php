<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Http\Requests\Admin\Market\StoreProductCategoryRequest;
use App\Http\Requests\Admin\Market\UpdateProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::get();
        return view('admin.market.product-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = ProductCategory::where('parent_id', null)->get();
        return view('admin.market.product-category.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $inputs = $request->all();
        ProductCategory::create($inputs);
        return to_route('admin.market.product-category.index')->with('swal-success', 'دسته بندی با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        $parents = ProductCategory::where('parent_id', null)->get()->except($productCategory->id);

        return view('admin.market.product-category.edit', compact('productCategory', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $inputs = $request->all();


        $productCategory->update($inputs);
        return to_route('admin.market.product-category.index')->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return back()->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }
}
