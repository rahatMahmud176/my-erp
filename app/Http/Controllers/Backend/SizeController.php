<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SizeInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SizeController extends Controller
{
    public $sizes;

    public function __construct(SizeInterface $sizeInterface) {
        $this->sizes = $sizeInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('utility.index'); 
       $sizes = $this->sizes->all();  
       return view('backend.size.index', compact('sizes'));
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

        $this->sizes->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    { 
        Gate::authorize('utility.edit');
        $size = $size;
        return view('backend.size.form', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    { 
        Gate::authorize('utility.edit');
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->sizes->update($request,$size);
        notify('updated successfully','success');
        return redirect('admin/sizes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    { 
        Gate::authorize('utility.delete');
        if($size->deletable == 1){
            $size->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Size is not Deletable','Error'); 
        }
        return back();
    }
}
