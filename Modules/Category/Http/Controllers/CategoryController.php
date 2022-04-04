<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Category\Entities\Category;
use Modules\Category\Repository\CategoryRepository;


class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->CategoryRepository = $categoryRepository;
    }
    public function index()
    {
     
        $category = $this->CategoryRepository->index();
        // dd($category);
        return view('category::categories.index', compact('category'));
    }


    public function create()
    {
         return view('category::categories.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if($request->hasfile('image')) 
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/categories/',$filename);
            $data['image'] = $filename;
        }
        $this->CategoryRepository->store($data);
        return redirect()->back()->with('status','category Added Successfully');
    }


    public function edit($id)
     {
         $category = $this->CategoryRepository->find($id);
        return view('category::categories.edit', compact('category'));
    
    }


    public function update(Request $request, $id)
    {
       
        $data = [
            'name' => $request->name,
            'description' =>$request->description
        ];
        
        $category = $this->CategoryRepository->find($id);
         //dd($category);
        if($request->hasfile('image')) 
        {
            $destination = 'uploads/categories/'.$category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/categories/',$filename);
            $data['image'] = $filename;
        }
        
        Category::where('id', $id)->update($data); 
        return redirect()->back()->with('status','Category Updated Successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $destination = 'uploads/categories/'.$category->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $this->CategoryRepository->destroy($id);
        return redirect()->back()->with('status','Category Deleted Successfully');
    
 }
}
