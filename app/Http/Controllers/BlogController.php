<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    // Публічний перелік у вигляді карток
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])
            ->orderByDesc('dt_created')
            ->paginate(6);

        return view('blog.index', compact('blogs'));
    }

    // Адміністративний перелік у вигляді таблиці
    public function admin()
    {
        $blogs = Blog::with('category')
            ->orderByDesc('dt_created')
            ->paginate(10);

        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create', ['categories' => $this->categories()]);
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('blog.show', $blog);
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'author']);

        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', [
            'blog'       => $blog,
            'categories' => $this->categories(),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return redirect()->route('blog.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin');
    }

    // Пари «ідентифікатор => назва» для випадаючого списку
    private function categories()
    {
        return Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');
    }
}
