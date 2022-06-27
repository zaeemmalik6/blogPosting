<?php

namespace App\Http\Controllers\Apis\v1;

use Exception;
use App\Models\Post;
use App\Models\PostMeta;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function createPost(PostRequest $request)
    {
        try {
            $post = Post::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => Auth::id(),
            ]);

            $images = $request->file('image');
            if ($request->hasFile('image')) {
                // dd($request->image);

                // $postMeta = [];

                foreach ($images as $image) {

                    $image_name = rand() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('/uploads/images'), $image_name);

                    // $postMeta[] = ['post_id' => $post->id, 'image' => $image_name];
                    PostMeta::create(['post_id' => $post->id, 'image' => $image_name]);
                }

                // dd($postMeta);

                return response()->json('success');
            }
            return response()->json('image null');

            return ['Success', 'Post created successfully'];
        } catch (Exception $exception) {
            return ['Error', $exception->getMessage()];
        }
    }
}
