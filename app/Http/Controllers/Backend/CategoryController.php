<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    
    public $categories;

    public function __construct(CategoryInterface $categoryInterface) {
        $this->categories = $categoryInterface;
    }



    public function index()
    {
        Gate::authorize('utility.index');

       $categories = $this->categories->all();  
       return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('utility.create');

        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->categories->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    { 
        Gate::authorize('utility.edit'); 
        $category = $category;
        return view('backend.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        Gate::authorize('utility.edit'); 
        $this->validate($request,[
            'name'  => 'required'
        ]); 
        $this->categories->update($request,$category);
        notify('updated successfully','success');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('utility.delete'); 
        if($category->deletable == 1){
            $category->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Category is not Deletable','Error'); 
        }
        return back();
    }
}
