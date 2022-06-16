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
        $categories = Category::orderBy('id', 'DESC')->paginate(3);
        return view('admin.categories.index')->with(['categories' => $categories]);
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
        $validator = Validator::make($request->all(), [
            'category_type' => 'required|string',
        ]);
        if ($validator->fails()) {
            $data = [
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ];
            return response()->json($data);
        }

        DB::beginTransaction();
        try {
            $category = Category::create([
                'category_type' => $request->category_type,
                'user_id' => Auth::id(),
            ]);
            DB::commit();
            return redirect('/admin/categories')->with('message3', 'Category created successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('message3', 'Category created successfully');
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

        $category = Category::find($id);
        if (!$category) return redirect(route('categories.index'));
        // dd($category);
        return view('admin.categories.update')->with(['category' => $category]);
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
        // dd($request->category_type);
        $category = json_decode($category);
        $category = Category::find($category->id)->update([
            'category_type' => $request->category_type,
        ]);
        return redirect('/admin/categories')->with('message', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $user = json_decode($category);
        $user = Category::find($user->id)->delete();
        return redirect('/admin/categories')->with('message1', 'Category deleted successfully');
    }

    public function trashCategories()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.categories.trash')->with(['categories' => $categories]);
    }

    public function restoreCategory($id)
    {
        $category = Category::withTrashed()->find($id)->restore();
        return redirect('/admin/categories')->with('message2', 'Category restored successfully');
    }
}
