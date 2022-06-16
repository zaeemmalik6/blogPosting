<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $posts = Post::orderBy('id', 'DESC')->with('feedbacks')->paginate(3);
        return view('admin.posts.index')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.posts.add')->with(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = Post::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
        // dd($post->user->name);
        return redirect('/admin/posts')->with('message3', 'Post created successfully');
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
        $post = Post::find($id);
        $categories = Category::get();
        // dd($categories);
        // dd($category);
        return view('admin.posts.update', compact('post', 'categories'));
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
        // dd($request->all());


        $post = json_decode($post);
        $post = Post::find($post->id);

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body

        ]);
        return redirect('/admin/posts')->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        // dd($post);
        // $post = json_decode($post);
        $comments = Feedback::where('feedbackable_id', '=', $post)->delete();
        $post = Post::find($post);
        $post->delete();
        // $post->feedbacks()->detach();
        return redirect('/admin/posts')->with('message1', 'Post deleted successfully');
    }

    public function trashPosts()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trash')->with(['posts' => $posts]);
    }

    public function restorePost($id)
    {
        $comments = Feedback::where('feedbackable_id', '=', $id)->restore();
        $post = Post::withTrashed()->find($id)->restore();
        return redirect('/admin/posts')->with('message2', 'Post restored successfully');
    }
}
