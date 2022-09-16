<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::orderBy('id', 'DESC')->paginate(3);
            return view('admin.categories.index', compact('categories'));
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
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
            'category_type' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $category = Category::create([
                'category_type' => $request->category_type,
                'user_id' => Auth::id(),
            ]);
            if (empty($category)) {
                throw new Exception("Category can not be stored");
            }
            DB::commit();
            return redirect('/admin/categories')->with('message3', 'Category created successfully');
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
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
            $category = Category::find($id);
            if (empty($category)) {
                throw new Exception("Category not found");
            }
            return view('admin.categories.update',  );
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $request->validate([
            'category_type' => 'required',
        ]);
        try {
            $category = json_decode($category);
            $category = Category::find($category->id)->update([
                'category_type' => $request->category_type,
            ]);
            if (empty($id)) {
                throw new Exception("Category cannot be updated");
            }
            return redirect('/admin/categories')->with('message', 'Category updated successfully');
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        try {
            $user = json_decode($category);
            $user = Category::find($user->id)->delete();
            if (empty($category)) {
                throw new Exception("Category not found");
            }
            return redirect('/admin/categories')->with('message1', 'Category deleted successfully');
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
        }
    }

    public function trashCategories()
    {
        try {
            $categories = Category::onlyTrashed()->get();
            if (empty($categories)) {
                throw new Exception("Categories not found");
            }
            return view('admin.categories.trash')->with(['categories' => $categories]);
        } catch (Exception $exception) {
            return redirect('/admin/categories')->with('error', $exception->getMessage());
        }
    }

    public function restoreCategory($id)
    {
        try {
            $category = Category::withTrashed()->find($id)->restore();
            if (empty($category)) throw new Exception("Category not found");

            return redirect('/admin/categories')->with('message2', 'Category restored successfully');
        } catch (Exception $exception) {
        }
    }
}
