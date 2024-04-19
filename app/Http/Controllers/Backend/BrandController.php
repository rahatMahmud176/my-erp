<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\BrandInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
   public $brands;
    public function __construct(BrandInterface $brandInterface) {
        $this->brands = $brandInterface;
    }


    public function index()
    {
        Gate::authorize('utility.index');
        $brands =$this->brands->all();
        return view('backend.brand.index', compact('brands'));
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
        Gate::authorize('utility.index');
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->brands->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        Gate::authorize('utility.edit');
        $brand = $brand;
        return view('backend.brand.form', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        Gate::authorize('utility.edit');
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->brands->update($request,$brand);
        notify('updated successfully','success');
        return redirect('admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    { 
        Gate::authorize('utility.delete');
        if($brand->deletable == true){
            $brand->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Brand is not Deletable','Error'); 
        }
        return back();

    }
}
