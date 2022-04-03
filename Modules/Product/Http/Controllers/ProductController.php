<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class ProductController extends Controller
{
    public function index()
    {
     
        $products = Product::all();
        return view('product::product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
         return view('product::product.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $data=[
            'name'=> $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ];
    
        if($request->hasfile('image')) 
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/products/',$filename);
            // $product->image = $filename;
            $data['image']=$filename;
        }
       Product::create($data); 
        // $product->save(); 
        return redirect()->back()->with('status','Product Added Successfully');
    }

// laravel eloquent
    public function edit($id)
     {
        $categories = Category::all();
        $product = Product::find($id);
         return view('product::product.edit',compact('categories'), compact('product'));

        // return view(' product.edit', compact('product'));
    
    }


    public function update(Request $request, $id)
    {
        try {
            $product = Product::findorfail($id);
        
            $data=[
                'name'=> $request->name,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ];
            if($request->hasfile('image')) 
            {
                $destination = 'uploads/products/'.$product->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/products/',$filename);
                // $product->image = $filename;
                $data['image']= $filename;
            }
    
            $product->update($data); 
            return redirect()->back()->with('status','Product Updated Successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $destination = 'uploads/products/'.$product->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $product->delete();
        return redirect()->back()->with('status','Product Deleted Successfully');
    
 }
}
