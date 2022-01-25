<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $category = Category::findOrFail($request->category);
        
        return view("product.index",[
            'products' => $products,
            'category' => $category
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
            $img_name = null;

            if($request->image){
                $file_img = $request->image;
                $img_name = time().'.'.$file_img->extension();  
                $file_img->move(public_path('uploads/images/products'), $img_name);
            }

            $category->products()->create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => $img_name
            ]); 
            DB::commit();

        }catch(Exception $ex){
            DB::rollBack();
            Log::info("Create Product >>>".$ex->getMessage());
            Alert::error('Error', 'Something went wrong');
            return back();
        }
        
        Alert::success('Success', 'Product was created successfully');
        return redirect()->route('product.index', [
            'category' => $category->id
        ]);
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

            if($request->image){
                if(!is_null($product->image) && File::exists("uploads/images/products/".$product->image)){
                    unlink("uploads/images/products/".$product->image);
                }

                $file_img = $request->image;
                $img_name = time().'.'.$file_img->extension();  
                $file_img->move(public_path('uploads/images/products/'), $img_name);
            }

            $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'image' => $request->image ? $img_name : $product->image,
                'description' => $request->description,
                'category_id'=> $category->id
            ]); 

            DB::commit();

        }catch(Exception $ex){

            DB::rollBack();
            Log::info("Update Product >>>".$ex->getMessage());
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

        if(!is_null($product->image) && File::exists("uploads/images/products/".$product->image)){
            unlink("uploads/images/products/".$product->image);
        }

        $product->delete();

        if(count($category->products)){
            Alert::success('Success', 'Product was deleted successfully');
            return back();
        }

        Alert::success('Success', 'Product was deleted successfully');
        return redirect()->route("dashboard");
        
    }
}
