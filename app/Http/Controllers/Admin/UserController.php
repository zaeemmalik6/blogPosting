<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::where('type', '!=', 'admin')->with('feedbacks')->orderBy('id', 'DESC')->paginate(1);
            if (empty($users)) {
                throw new Exception("Users not found");
            }
            return view('admin.users.index', compact('users'));
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
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
        try {
            $user = User::find($id);
            if (empty($user)) {
                throw new Exception("User not found");
            }
            return view('admin.users.update', compact('user'));
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
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
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        try {
            $user = json_decode($user);
            $user = User::find($user->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if (empty($user)) {
                throw new Exception("Can not update this user");
            }
            return redirect('/admin/users')->with('message', 'User updated successfully');
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        try {
            $user = User::find($user)->delete();
            Feedback::where('feedbackable_id', '=', $user)->delete();
            if (empty($user)) {
                throw new Exception("User not found");
            }
            return redirect('/admin/users')->with('message1', 'User deleted successfully');
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
    }

    public function trashUsers()
    {
        try {
            $users = User::onlyTrashed()->get();
            if (empty($users)) {
                throw new Exception("User not found");
            }
            return view('admin.users.trash', compact('users'));
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
    }

    public function restoreUser($id)
    {
        try {
            $id = User::withTrashed()->find($id)->restore();
            Feedback::where('feedbackable_id', '=', $id)->restore();
            if (empty($id)) {
                throw new Exception("User not found");
            }
            return redirect('/admin/users')->with('message2', 'User restored successfully');
        } catch (Exception $exception) {
            return redirect('/admin/users')->with('error', $exception->getMessage());
        }
    }
}
