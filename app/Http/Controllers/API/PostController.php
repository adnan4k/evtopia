<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;


class PostController extends Controller
{



    public function mobile_index(Request $request)
    {
        $page = $request->page;
        $perPage = $request->per_page;
        $skip = ($page * $perPage) - $perPage;
    
        $search = $request->filter['search'] ?? null;
        $categoryName = $request->categoryName ?? null;  // Category name filter from query parameter
        $tagID = $request->filter['tag_id'] ?? null;
    
        $sortType = $request->sort_type;
    
        $posts = PostRepository::query()
            ->with(['categories', 'tags', 'comments', 'user'])
            // Filter by category name if provided
            ->when($categoryName, function ($query) use ($categoryName) {
                $query->whereHas('categories', function ($query) use ($categoryName) {
                    // Match categories by name (partial match with 'like')
                    $query->where('name', 'like', '%' . $categoryName . '%');
                });
            })
            ->when($tagID, function ($query) use ($tagID) {
                $query->whereHas('tags', function ($query) use ($tagID) {
                    $query->where('post_tag_id', $tagID);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('short_description', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($sortType == 'heigh_to_low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sortType == 'low_to_high', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sortType == 'newest' || $sortType == 'just_for_you', function ($query) {
                return $query->orderBy('id', 'desc');
            })
            ->latest()
            ->isActive();
    
        // Get the total number of posts
        $total = $posts->count();
    
        // Apply pagination
        $posts = $posts->when($perPage && $page, function ($query) use ($perPage, $skip) {
            return $query->skip($skip)->take($perPage);
        })->get();
    
        // Return the paginated and filtered posts
        return $this->json('posts', [
            'total' => $total,
            'posts' => PostResource::collection($posts),
        ]);
    }
    
    public function categories(Request $request)
    {
        $categories = PostCategory::all();
        return response()->json($categories);
    }
    public function index(Request $request)
    {
        $page = $request->page;
        $perPage = $request->per_page;
        $skip = ($page * $perPage) - $perPage;

        $search = $request->filter['search']??null;
        $categoryID = $request->filter['category_id']??null;
        $tagID = $request->filter['tag_id']??null;

        $sortType = $request->sort_type;

        $posts = PostRepository::query()
            ->with(['categories', 'tags', 'comments','user'])
            ->when($categoryID, function ($query) use ($categoryID) {
                $query->whereHas('categories', function ($query) use ($categoryID) {
                    $query->where('post_category_id', $categoryID);
                });
            })
            ->when($tagID, function ($query) use ($tagID) {
                $query->whereHas('tags', function ($query) use ($tagID) {
                    $query->where('post_tag_id', $tagID);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('short_description', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($sortType == 'heigh_to_low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sortType == 'low_to_high', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sortType == 'newest' || $sortType == 'just_for_you', function ($query) {
                return $query->orderBy('id', 'desc');
            })
            ->latest()
            ->isActive();

        $total = $posts->count();
        $posts = $posts->when($perPage && $page, function ($query) use ($perPage, $skip) {
            return $query->skip($skip)->take($perPage);
        })->get();

        return $this->json('posts', [
            'total' => $total,
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function featured(Request $request)
    {
        $page = $request->page;
        $perPage = $request->per_page;
        $skip = ($page * $perPage) - $perPage;

        $search = $request->filter['search']??null;
        $categoryID = $request->filter['category_id']??null;
        $tagID = $request->filter['tag_id']??null;

        $sortType = $request->sort_type;

        $posts = PostRepository::query()
            ->with(['categories', 'tags', 'comments','user'])
            ->when($categoryID, function ($query) use ($categoryID) {
                $query->whereHas('categories', function ($query) use ($categoryID) {
                    $query->where('post_category_id', $categoryID);
                });
            })
            ->when($tagID, function ($query) use ($tagID) {
                $query->whereHas('tags', function ($query) use ($tagID) {
                    $query->where('post_tag_id', $tagID);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('short_description', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($sortType == 'heigh_to_low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sortType == 'low_to_high', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sortType == 'newest' || $sortType == 'just_for_you', function ($query) {
                return $query->orderBy('id', 'desc');
            })->isActive()
            ->latest()
            ->take(5)->get();


        $total = $posts->count();


        return $this->json('posts', [
            'total' => $total,
            'posts' => PostResource::collection($posts),
        ]);
    }

    /**
     * Show the product details.
     *
     * @param  datatype  $id  description
     * @return response
     */
    public function show(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
        ]);

        $post = Post::with(['categories', 'tags', 'comments','user'])
            ->where(function ($query) use ($request) {
                if (is_numeric($request->post_id)) {
                    $query->where('id', $request->post_id);
                } else {
                    $query->where('slug', $request->post_id);
                }
            })
            ->firstOrFail();
            $relatedPosts = Post::whereHas('categories', function ($query) use ($post) {
                $query->whereIn('post_category_id', $post->categories->pluck('id'));
            })
            ->with(['categories', 'tags', 'comments','user'])
            ->where(function ($query) use ($request) {
                if (is_numeric($request->post_id)) {
                    $query->where('id','!=' ,$request->post_id);
                } else {
                    $query->where('slug','!=', $request->post_id);
                }
            })
            ->isActive()
            ->inRandomOrder()
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return $this->json('product details', [
            'post' => PostResource::make($post),
            'related_posts' => PostResource::collection($relatedPosts),
            'related_posts' => PostResource::collection($relatedPosts),
        ]);
    }
}
