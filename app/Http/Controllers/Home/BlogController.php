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
        $searchTerm = $request->get('search');

        $blogs = Blog::query()
            ->when($searchTerm, function($query) use ($searchTerm) {
                $query->search($searchTerm);
            })->sortBy($sort)->paginate(12);


        return view('app.blog.index', compact('blogs', 'sort', 'searchTerm'));
    }
    public function show(Blog $blog )
    {
        $blog->load(['user']);
        $comments = $blog->comments()->whereNull('parent_id')->where('status', 2)->orderByDesc('created_at')->paginate(10);
        $blogs = Blog::latest()->paginate(3);

        return view('app.blog.details',compact(['blog', 'comments', 'blogs']));

    }

}
