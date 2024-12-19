<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryRequest;
use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    // Display all service categories
    public function index()
    {
         $categories = ServiceCategory::query();

        $search = $request->search ?? null;

        $categories = $categories->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    // Show form for creating a new service category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a new service category
    public function store(ServiceCategoryRequest  $request)
    {

        $category = ServiceCategoryRepository::storeByRequest($request);
        return redirect()->route('admin.serviceCategory.index')->with('success', __('Category created successfully'));

    }

    // Show form for editing a service category
    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.categories.edit', compact('serviceCategory'));
    }

    // Update a service category
    public function update(ServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
        $category = ServiceCategoryRepository::updateByRequest($request, $serviceCategory);

        return redirect()->route('admin.serviceCategory.index')->with('success', 'Service Category updated successfully.');
    }

    // Delete a service category
    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return redirect()->route('admin.serviceCategory.index')->with('success', 'Service Category deleted successfully.');
    }

    public function statusToggle(ServiceCategory $serviceCategory)
    {
        $serviceCategory->update(['status' => ! $serviceCategory->status]);

        return redirect()->route('admin.serviceCategory.index')->with('success', 'Status updated successfully.');
    }
}
