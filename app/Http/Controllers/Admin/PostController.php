<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::orderBy('id', 'DESC')->with('feedbacks')->paginate(4);
            if (empty($posts)) {
                throw new Exception("Post not found");
            }
            return view('admin.posts.index', compact('posts'));
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::get();
            if (empty($categories)) {
                throw new Exception("Categories not found");
            }
            return view('admin.posts.add', compact('categories'));
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        try {
            $post = Post::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => Auth::id(),
            ]);
            if (empty($post)) {
                throw new Exception("Cannot store this post");
            }
            return redirect('/admin/posts')->with('message3', 'Post created successfully');
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $post = Post::find($id);
            if (empty($id)) {
                throw new Exception("Post not found");
            }
            $categories = Category::get();
            return view('admin.posts.update', compact('post', 'categories'));
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        try {
            $post = json_decode($post);
            $post = Post::find($post->id);
            $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body

            ]);
            if (empty($post)) {
                throw new Exception("Cannot update this post");
            }
            return redirect('/admin/posts')->with('message', 'Post updated successfully');
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        try {
            Feedback::where('feedbackable_id', '=', $post)->delete();
            $post = Post::find($post);
            $post->delete();
            if (empty($post)) {
                throw new Exception("Post not found");
            }
            return redirect('/admin/posts')->with('message1', 'Post deleted successfully');
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }

    public function trashPosts()
    {
        try {
            $posts = Post::onlyTrashed()->get();
            if (empty($posts)) {
                throw new Exception("Post not found");
            }
            return view('admin.posts.trash')->with(['posts' => $posts]);
        } catch (Exception $exception) {
        }
    }

    public function restorePost($id)
    {
        try {
            Feedback::where('feedbackable_id', '=', $id)->restore();
            $id = Post::withTrashed()->find($id)->restore();
            if (empty($id)) {
                throw new Exception("Post not found");
            }
            return redirect('/admin/posts')->with('message2', 'Post restored successfully');
        } catch (Exception $exception) {
            return redirect('/admin/posts')->with('error', $exception->getMessage());
        }
    }
}
