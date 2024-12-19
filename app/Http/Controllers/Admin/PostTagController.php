<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostTag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
   // Display a listing of post tags
   public function index(Request $request)
   {
       $search = $request->search ?? null;

        $tags = PostTag::query()->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10);

       return view('admin.post_tag.index', compact('tags'));
   }

   // Show the form for creating a new post tag
   public function create()
   {
       return view('admin.post_tag.create');
   }

   // Store a newly created post tag
   public function store(Request $request)
   {
       $data = $request->validate([
           'name' => 'required|string|max:255|unique:post_tags',
       ], [
        'name.unique' => 'This tag name exists.',
        ]);

       PostTag::create($data);

       return redirect()->route('admin.post_tags.index');
   }

   // Show the form for editing the specified post tag
   public function edit($id)
   {
       $postTag = PostTag::findOrFail($id);
       return view('admin.post_tag.edit', compact('postTag'));
   }

   // Update the specified post tag
   public function update(Request $request, PostTag $postTag)
   {
        // tag  must be unique
       $data = $request->validate([
           'name' => 'required|string|max:255|unique:post_tags,name,' . $postTag->id,
       ],[
        'name.unique' => 'This tag name exists.',
        ]);

       $postTag->update($data);

       return redirect()->route('admin.post_tags.index');
   }

   // Remove the specified post tag
   public function destroy($id)
   {
       $tag = PostTag::findOrFail($id);
       
       $tag->delete();

       return redirect()->route('admin.post_tags.index')
                           ->withSuccess(__('Tag deleted successfully'));
   }
}