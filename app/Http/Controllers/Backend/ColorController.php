<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ColorInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ColorController extends Controller
{

    public $colors;

    public function __construct(ColorInterface $colorInterface) {
        $this->colors = $colorInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('utility.index');
       $colors = $this->colors->all();  
       return view('backend.color.index', compact('colors'));
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

        $this->colors->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    { 
        Gate::authorize('utility.edit');
        $color = $color;
        return view('backend.color.form', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    { 
        Gate::authorize('utility.edit');
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->colors->update($request,$color);
        notify('updated successfully','success');
        return redirect('admin/colors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    { 
        Gate::authorize('utility.delete');
        if($color->deletable == 1){
            $color->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Color is not Deletable','Error'); 
        }
        return back();
    }
}
