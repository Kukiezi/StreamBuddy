<?php

namespace App\Http\Services;

use App\Post;
use Illuminate\Support\Facades\DB;

class NewsService
{

    public function fetchPosts()
    {
        $posts = Post::with('author')->orderByDesc(
            'created_at'
        )->get();
        return $posts;
    }

    public function fetchPostsPagination()
    {
        $posts = Post::with('author')->orderByDesc('created_at')->paginate(4);
        return $posts;
    }

    public function fetchPostWithId($id)
    {
//        return Post::with('author')->find($id);
        return Post::find($id);
    }

    public function fetchPostWithSlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }
}