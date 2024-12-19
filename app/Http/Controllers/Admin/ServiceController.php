<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ServiceController extends Controller
{

    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

   public function index(Request $request)
    {
       $category = $request->category;
     
       $search = $request->search;


       $services = $this->service->query()->when($category, function ($query) use ($category) {
           return $query->whereHas('categories', function ($query) use ($category) {
               return $query->where('service_category_id', $category);
           });
       })->when($search, function ($query) use ($search) {
           return $query->where('name', 'like', "%$search%");
       })->paginate(10);

       $categories = ServiceCategory::all();

       return view('admin.services.index', compact('services', 'categories'));
    }

   public function create()
   {
       $categories = ServiceCategory::all();
       return view('admin.services.create', compact('categories'));
   }

   public function store(ServiceRequest $request)
   {

        $code = Service::where('code', $request->code)->exists();

        if ($code) {
            return back()->withInput()->withErrors(['code' => __('Service code already exists!')])->with('error', __('Product code already exists!'));
        }
        ServiceRepository::storeByRequest($request);

        return redirect()->route('admin.service.index')->with('success', 'Service created successfully.');
   }

   public function edit(Service $service)
   {
  
        $categories = ServiceCategory::active()->get();

        $categoryId = $service->categories()->latest('id')->first()->id;


        return view('admin.services.edit', compact('service', 'categories'));
   }

   public function update(ServiceRequest $request, Service $service)
   {

    ServiceRepository::updateByRequest($request,$service);

    return redirect()->route('admin.service.index')->with('success', 'Service created successfully.');
   }



   public function show(Service $service)
   {
       return view('admin.services.show', compact('service'));
   }


   public function statusToggle(Service $service)
    {
        $service->update([
            'is_active' => ! $service->is_active,
        ]);

        return back()->withSuccess(__('Status updated successfully'));
    }
    
   
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.service.index')->with('success', 'Service deleted successfully.');
    }
}