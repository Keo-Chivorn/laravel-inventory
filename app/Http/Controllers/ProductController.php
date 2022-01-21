<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where("category_id", $request->category)->get();
        
        return view("product.index",[
            'products' => $products
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
        $category = Category::findOrFail($request->category);
        
        DB::beginTransaction();
        try{

            $category->products()->create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'description' => $request->description,
            ]); 
            DB::commit();

        }catch(Exception $ex){

            DB::rollBack();
            Log::info("Create Product >>>".$ex->getMessage());
            Alert::error('Error', 'Something went wrong');
            return back();

        }
        
        Alert::success('Success', 'Product was created successfully');
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
            $product = Product::findOrFail($request->product);
            $html = view('product.form', [
                'product' => $product
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
        $product = Product::findOrFail($request->product);
        $category = Category::findOrFail($request->category);
        DB::beginTransaction();
        try{

            $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'category_id'=> $category->id
            ]); 

            DB::commit();

        }catch(Exception $ex){

            DB::rollBack();
            Log::info("Create Product >>>".$ex->getMessage());
            Alert::error('Error', 'Something went wrong');
            return back();

        }
        
        Alert::success('Success', 'Product was updated successfully');
        return redirect()->route('product.index', [
            'category' => $category->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $category = $product->category;
        $product->delete();

        if(count($category->products)){
            Alert::success('Success', 'Product was deleted successfully');
            return back();
        }

        Alert::success('Success', 'Product was deleted successfully');
        return redirect()->route("dashboard");
        
    }
}
