<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\ProductRepository;

class ProductController extends Controller
{
    private $ProductRepository;
    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function index()
    {
     
        $products = $this->ProductRepository->index();
        // $products = Product::all();
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
        $this->ProductRepository->store($data); 
        // $product->save(); 
        return redirect()->back()->with('status','Product Added Successfully');
    }

// laravel eloquent
    public function edit($id)
     {
        $categories = Category::all();
        $product = $this->ProductRepository->find($id);
         return view('product::product.edit',compact('categories'), compact('product'));

    }


    public function update(Request $request, $id)
    {
        try {
            // $product = Product::findorfail($id);
        
            $data=[
                'name'=> $request->name,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ];
            $product = $this->ProductRepository->find($id);
            // dd($product);
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
    
            Product::where('id', $id)->update($data); 
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
        $this->ProductRepository->destroy($id);
        return redirect()->back()->with('status','Product Deleted Successfully');
    
 }
}
