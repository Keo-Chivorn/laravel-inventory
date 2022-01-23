<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view("category.index",[
            'categories' => $categories
        ]);
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
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Category was created successfully');
        return back();
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
    public function edit(Request $request)
    {
        if($request->ajax()){
            $category = Category::findOrFail($request->category);
            $html = view('category.form', [
                'category' => $category
            ])->render();
            return response()->json([
                'html'=>$html
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($request->category);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Category was updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if(count($category->products)){
            foreach($category->products as $product){
                if(!is_null($product->image)){
                    if(File::exists("uploads/images/".$product->image)){
                        unlink("uploads/images/".$product->image);
                    }
                }
            }
        }

        $category->delete();

        Alert::success('Success', 'Category was deleted successfully');
        return back();
    }
}
