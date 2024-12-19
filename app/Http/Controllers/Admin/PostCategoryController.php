<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;
use App\Repositories\PostCategoryRepository;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;

        // Get categories with search and pagination
        $categories = PostCategory::query()->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10);

        return view('admin.post_category.index', compact('categories'));
    }

    /**
     * create a new category
     */
    public function create()
    {
        return view('admin.post_category.create');
    }

    /**
     * store a new category
     */
    public function store(PostCategoryRequest $request)
    {
        $category = PostCategoryRepository::storeByRequest($request);

        $shop = auth()->user()->shop;
        $shop->categories()->attach($category);

        return to_route('admin.post_categories.index')->withSuccess(__('Category created successfully'));
    }

    /**
     * edit a category
     */
    public function edit($id)
    {
        $category = PostCategory::findOrFail($id);
        return view('admin.post_category.edit', compact('category'));
    }

    /**
     * update a category
     */
    public function update(PostCategoryRequest $request, $id)
    {
        $category = PostCategory::findOrFail($id);
        $category = PostCategoryRepository::updateByRequest($request, $category);

        return redirect()->route('admin.post_categories.index')
                            ->withSuccess(__('Category updated successfully'));    
    }

    /**
     * category status toggle
     */
    public function statusToggle(PostCategory $category)
    {
        $category->update(['status' => ! $category->status]);

        return back()->withSuccess(__('Status updated successfully'));
    }

    public function destroy($id)
    {
        $category = PostCategory::findOrFail($id);
        
        $category->delete();

        return redirect()->route('admin.post_categories.index')
                            ->withSuccess(__('Category deleted successfully'));
    }
}