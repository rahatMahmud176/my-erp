<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SubUnitInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\SubUnit;
use Illuminate\Http\Request;

class SubUnitController extends Controller
{
    public $subUnits;

    public function __construct(SubUnitInterface $subUnitInterface) {
        $this->subUnits = $subUnitInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $subUnits = $this->subUnits->all();  
       return view('backend.sub-unit.index', compact('subUnits'));
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

        $this->subUnits->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(SubUnit $subUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubUnit $subUnit)
    { 
        $subUnit = $subUnit;
        return view('backend.sub-unit.form', compact('subUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubUnit $subUnit)
    { 
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->subUnits->update($request,$subUnit);
        notify('updated successfully','success');
        return redirect('admin/sub_units');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubUnit $subUnit)
    { 
        if($subUnit->deletable == 1){
            $subUnit->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This SubUnit is not Deletable','Error'); 
        }
        return back();
    }
}
