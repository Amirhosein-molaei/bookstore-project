<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\storeProductFileRequest;
use App\Http\Requests\Admin\Market\updateProductFileRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductFile;
use Illuminate\Support\Facades\Storage;

class ProductFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $files = ProductFile::where('product_id', $product->id)->latest()->paginate(10);
        return view('admin.market.product-file.index', compact('files', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product-file.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductFileRequest $request, Product $product)
    {
        $file = $request->file('file');

        if (!empty($file)) {
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            try {
                $path = $file->storeAs('products/' . $product->id, $fileName);

                ProductFile::create([
                    'name' => str_replace(' ', '_', $file->getClientOriginalName()),
                    'type' => $file->getMimeType(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'product_id' => $product->id
                ]);
                return to_route('admin.market.product-file.index', $product)->with('swal-success', 'فایل با موفقیت ذخیره شد');
            } catch (\Throwable $th) {
                return redirect()->back()->with('swal-error', 'خطا در آپلود فایل');
            }
        } else {
            return redirect()->back()->with('swal-error', 'فایل نامعتبر');
        }
    }

    /**
     * Download the specified resource.
     */
    public function download(ProductFile $productFile)
    {
        if (Storage::exists($productFile->path)) {
            return response()->download(storage_path('app/private/' . $productFile->path), $productFile->name);
        } else {
            return to_route('admin.market.product-file.index')->with('swal-error', 'فایل یافت نشد');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductFile $productFile)
    {
        return view('admin.market.product-file.edit', compact('product', 'productFile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductFileRequest $request, Product $product, ProductFile $productFile)
    {
        $file = $request->file('file');

        if (!empty($file)) {
            if (Storage::exists($productFile->path)) {
                // remove previous file from project folders
                Storage::delete($productFile->path);

                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                try {
                    $path = $file->storeAs('products/' . $product->id, $fileName);

                    $productFile->update([
                        'name' => str_replace(' ', '_', $file->getClientOriginalName()),
                        'type' => $file->getMimeType(),
                        'path' => $path,
                        'size' => $file->getSize()
                    ]);
                    return to_route('admin.market.product-file.index', $product)->with('swal-success', 'فایل با موفقیت ذخیره شد');
                } catch (\Throwable $th) {
                    return redirect()->back()->with('swal-error', 'خطا در آپلود فایل');
                }
            } else {
                return redirect()->back()->with('swal-error', 'فایل قبلی یافت نشد');
            }
        } else {
            return redirect()->back()->with('swal-error', 'فایل ارسال شده نامعتبر است');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductFile $productFile)
    {
        if (Storage::exists($productFile->path)) {
            
            Storage::delete($productFile->path);
            $productFile->delete();

            return to_route('admin.market.product-file.index', $product)->with('swal-success', 'فایل با موفقیت حذف شد');
        } else {
            return redirect()->back()->with('swal-error', 'فایل یافت نشد');
        }
        
    }
}
