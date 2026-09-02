<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /** Return the view on the Front end
     * @return View
     */
    public function index(): View
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        $latestArticle = Blog::latest()->first();

        return view('Frontend.blog.Index', [
            'blogs'          => $blogs,
            'latestArticlle' => $latestArticle
        ]);
    }

    /** Show an article on the front end
     * @param string $articleSlug
     * @return View
     */
    public function article(string $articleSlug): View
    {
        $article = Blog::where('blog_slug', $articleSlug)
            ->firstOrFail();

        return view('Frontend.blog.Show', [
            'article' => $article,
        ]);
    }



}
