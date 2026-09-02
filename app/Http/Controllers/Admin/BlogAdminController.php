<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogAdminController extends Controller
{


    /** Return the Dashboard Index view
     *
     * @return View
     */
    public function index(): View
    {
        $blogs = Blog::orderBy('id', 'desc')->get();

        return view('admin.Blog.index', [
            'blogs' => $blogs,
        ]);
    }

    /** Show a single article in the Dashboard
     *
     * @param Blog $blog
     * @return View
     */
    public function show(Blog $blog): View
    {
        return view('Backend.blog.show', [
            'blog' => $blog,
        ]);
    }

    /** Get the Create Article view
     *
     * @return View
     */
    public function createBlogView(): View
    {
        return view('admin.Blog.create');
    }

    /** Create an article
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:512'],
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ], [
            'image.required' => 'Главната снимка е задължителна.',
            'image.image' => 'Файлът трябва да е изображение.',
            'image.mimes' => 'Позволени формати: jpg, jpeg, png, webp.',
            'image.max' => 'Максимален размер: 0.5MB.',
            'name.required' => 'Името на статията е задължително.',
            'name.max' => 'Името не може да бъде по-дълго от 255 символа.',

            'content.required' => 'Съдържанието на статията е задължително.',
        ]);

        $slug = Str::slug($validated['blog_name']);

        $existingBlog = Blog::where('blog_slug', $slug)->exists();

        if ($existingBlog) {
            return back()->withErrors(['blog_name' => 'Статия със същото име вече съществува.'])->withInput();
        }

        $mainImage = $request->file('blog_image');
        $mainImageName = time() . '_' . preg_replace('/\s+/', '', $mainImage->getClientOriginalName());
        $mainImage->move(public_path('/images/blog'), $mainImageName);

        Blog::create([
            'blog_name' => $validated['blog_name'],
            'blog_slug' => $slug,
            'blog_content' => $validated['blog_content'],
            'blog_image' => $mainImageName,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('super_admin.blog.index')->with('successUploadingBlog', 'Успешно качихте статията.');
    }

    /** Update an article
     *
     * @param Request $request
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validate([
            'blog_name' => ['required', 'string', 'max:255'],
            'blog_content' => ['required', 'string'],
            'blog_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:512'],
        ], [
            'blog_name.required' => 'Името на статията е задължително.',
            'blog_content.required' => 'Съдържанието е задължително.',
            'blog_image.image' => 'Файлът трябва да е изображение.',
            'blog_image.mimes' => 'Файлът трябва да е jpg, jpeg или png.',
            'blog_image.max' => 'Изображението не може да надвишава 0.5MB!',
        ]);

        $newSlug = Str::slug($validated['blog_name']);

        $slugExists = Blog::where('blog_slug', $newSlug)->where('id', '!=', $blog->id)->exists();

        if ($slugExists) {
            return back()->withErrors(['blog_name' => 'Статия със същото име вече съществува.'])->withInput();
        }

        $imageName = $blog->blog_image;

        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $imageName = time() . '_' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            $file->move(public_path('/images/blog'), $imageName);
        }

        $blog->update([
            'blog_name' => $validated['blog_name'],
            'blog_slug' => $newSlug,
            'blog_content' => $validated['blog_content'],
            'blog_image' => $imageName,
        ]);

        return redirect()->route('super_admin.blog.show', $blog)->with('successUpdatingBlog', 'Статията беше обновена успешно!');
    }

    /** Delete an article
     *
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function delete(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('super_admin.blog.index')->with('successDeletingBlog', 'Успешно изтрихте статията!');
    }
}
