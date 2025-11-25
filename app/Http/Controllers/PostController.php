<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // 2MB máximo
        ]);

        if($request->hasFile('image')){
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        return response()->json([
            'id' => $post->id,
            'userName' => $post->user->name,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name),
            'content' => $post->content,
            'image' => $post->image_path ? asset('storage/' . $post->image_path) : null,
            'timestamp' => $post->created_at->diffForHumans(),
            'likes' => 0
        ]);
    }
}
