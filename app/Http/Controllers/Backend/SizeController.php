<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SizeInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Size;
use Illuminate\Http\Request;

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
        $size = $size;
        return view('backend.size.form', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    { 
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
        if($size->deletable == 1){
            $size->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Size is not Deletable','Error'); 
        }
        return back();
    }
}
