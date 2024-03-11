<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\CategoryInterface;
use App\Contracts\subCategoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public $subCategory;
    public $category;

    public function __construct(subCategoryInterface $subCategoryInterface = null, 
                                CategoryInterface $categoryInterface) {
        $this->subCategory = $subCategoryInterface;
        $this->category    = $categoryInterface;
    }


    public function index()
    {
        $subCategories = $this->subCategory->all();  
        $categories = $this->category->all();  
        return view('backend.sub-category.index', compact('subCategories','categories'));
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
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->subCategory->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
