<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\PostComment;
use App\Repositories\PostRepository;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    // Display all posts
    public function index(Request $request)
    {
       $category = $request->category;
       $type = $request->type??10;
     
       $search = $request->search;
       
       $posts = $this->post->query()->with(['categories', 'tags', 'comments'])
       ->when($category, function ($query) use ($category) {
           return $query->whereHas('categories', function ($query) use ($category) {
               return $query->where('post_category_id', $category);
           });
       })
       ->when($search, function ($query) use ($search) {
           return $query->where(function ($query) use ($search) {
               $query->where('title', 'like', '%' . $search . '%')
                     ->orWhere('short_description', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%');
           });
       })->when($type, function ($query) use ($type) {
            if ($type == 1) {
                return $query->where('add_to_knowledge_hub', 1); // Knowledge Hub Posts
            } elseif ($type == 2) {
                return $query->where('add_to_knowledge_hub', 0); // Blog Posts
            }
        })
       ->latest()
       ->paginate(10);   

        $categories = PostCategory::all();
           
        return view('admin.posts.index', compact('posts','category','categories','search', 'type'));
    }

    // Show the form to create a new post
    public function create()
    {
        $categories = PostCategory::all();
        $tags = PostTag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }


    public function comment($id)
    {
        $customers = Customer::all();
        $post_id = $id;
        return view('admin.posts.comment', compact('customers', 'post_id'));
    }
    // Store a newly created post
    public function store(PostRequest $request)
    {
        PostRepository::storeByRequest($request);
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');

    }

    // Display the specified post
    public function show($id)
    {
        $post = Post::with(['categories', 'tags', 'comments.customer'])->findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    // Show the form to edit an existing post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
        $tags = PostTag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    // Update the specified post
    public function update(PostRequest $request, Post $post)
    {
        PostRepository::updateByRequest($request, $post);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        $post->delete();

        return redirect()->route('admin.posts.index')
                            ->withSuccess(__('Post deleted successfully'));
    }
    // Add a comment to a post
    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        PostComment::create([
            'post_id' => $postId,
            'customer_id' => $request->customer_id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('admin.posts.index');
    }

    public function statusToggle(Post $post)
    {
        $post->update([
            'is_active' => ! $post->is_active,
        ]);

        return back()->withSuccess(__('Status updated successfully'));
    }


    public function updateCommentStatus(Post $post, PostComment $comment)
    {
        $comment->status = !$comment->status;
        $comment->save();

        return redirect()->route('admin.posts.show', $post)->with('success', 'Comment status updated successfully.');
    }


    public function deleteComment(Post $post, PostComment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.posts.show', $post)->with('success', 'Comment  deleted successfully.');
    }


}
