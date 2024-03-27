<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\UnitInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public $units;

    public function __construct(UnitInterface $unitInterface) {
        $this->units = $unitInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $units = $this->units->all();  
       return view('backend.unit.index', compact('units'));
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

        $this->units->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    { 
        $unit = $unit;
        return view('backend.unit.form', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    { 
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->units->update($request,$unit);
        notify('updated successfully','success');
        return redirect('admin/units');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    { 
        if($unit->deletable == 1){
            $unit->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Unit is not Deletable','Error'); 
        }
        return back();
    }
}
