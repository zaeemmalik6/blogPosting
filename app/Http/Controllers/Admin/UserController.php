<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->with('feedbacks')->orderBy('id', 'DESC')->paginate(1);
        return view('admin.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        return view('admin.users.update')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = json_decode($user);
        $user = User::find($user->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect('/admin/users')->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        // $user = json_decode($user);
        // dd($user);
        Feedback::where('feedbackable_id', '=', $user)->delete();
        $user = User::find($user)->delete();
        return redirect('/admin/users')->with('message1', 'User deleted successfully');
    }

    public function trashUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash')->with(['users' => $users]);
    }

    public function restoreUser($id)
    {
        $reviews = Feedback::where('feedbackable_id', '=', $id)->restore();
        $user = User::withTrashed()->find($id)->restore();
        return redirect('/admin/users')->with('message2', 'User restored successfully');
    }
}
