<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\CountryVariantInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\CountryVariant;
use Illuminate\Http\Request;

class CountryVariantController extends Controller
{ 
    public $countryVariants;

    public function __construct(CountryVariantInterface $countryVariantInterface) {
        $this->countryVariants = $countryVariantInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $countryVariants = $this->countryVariants->all();  
       return view('backend.country-variant.index', compact('countryVariants'));
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

        $this->countryVariants->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(CountryVariant $countryVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CountryVariant $countryVariant)
    { 
        $countryVariant = $countryVariant;
        return view('backend.country-variant.form', compact('countryVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CountryVariant $countryVariant)
    { 
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->countryVariants->update($request,$countryVariant);
        notify('updated successfully','success');
        return redirect('admin/country_variants');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CountryVariant $countryVariant)
    { 
        if($countryVariant->deletable == 1){
            $countryVariant->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This CountryVariant is not Deletable','Error'); 
        }
        return back();
    }
}
