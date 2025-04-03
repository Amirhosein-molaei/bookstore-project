<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Blog;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'latest');
        $categoryId = $request->get('category');
        $searchTerm = $request->get('search');

        $categories = ProductCategory::with('children.children')
            ->whereNull('parent_id')
            ->get();

        $blogs = Blog::query()
            ->when($searchTerm, function($query) use ($searchTerm) {
                $query->search($searchTerm);
            })
            ->when($categoryId, function($query) use ($categoryId) {
                $query->whereHas('categories', function($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->sortBy($sort)
            ->paginate(12);


        return view('app.layouts.blog.index', compact('blogs', 'sort', 'categories', 'searchTerm'));
    }
    public function show(Blog $blog )
    {
        $blog->load(['user']);
        $blogs=Blog::latest()->paginate(3);
        return view('app.layouts.blog.details',compact('blog','blogs'));

    }

}
