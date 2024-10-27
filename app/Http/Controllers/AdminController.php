<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){
        $category = new Category;

        $category-> category_name = $request -> category;
        $category->save();

        // toaster() -> addSuccess('Category Added Successfully.');
        session()->flash('success', 'Category Added Successfully.');

        return redirect() -> back();
    }

    public function delete_category($id){
        $data = category:: find($id);
        $data -> delete();
       

        session()->flash('success', 'Category Deleted Successfully.');
        return redirect() ->back();
    }

    public function edit_category($id){
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request,$id){
        $data = Category::find($id);
        $data -> category_name = $request ->category;
        $data ->save();

        session()->flash('success', 'Category Updated Successfully.');

        return redirect('/view_category');

    }

    public function add_product(){
        $category = Category::all();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $req){
        $data = new Product;
        $data->title = $req -> title;
        $data ->description = $req -> description;
        $data -> price = $req -> price;
        $data -> quantity = $req -> qty;
        $data -> category = $req -> category;

        $image = $req->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $req ->image ->move('products',$imagename );
            $data ->image = $imagename;
        }
        $data -> save();
        return redirect()->back()->with('success', 'Product added successfully');
    }
}
