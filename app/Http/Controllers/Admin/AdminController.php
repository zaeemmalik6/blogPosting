<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->count();
        $categories = Category::count();
        $posts = Post::count();
        return view('admin.adminDashboard')->with(['users' => $users, 'categories' => $categories, 'posts' => $posts]);
    }
}
