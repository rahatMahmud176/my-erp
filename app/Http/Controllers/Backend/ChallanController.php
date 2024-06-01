<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ChallanInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Challan;
use Illuminate\Http\Request;

class ChallanController extends Controller
{
   public $challans;


    public function __construct(ChallanInterface $challanInterface = null) {
        $this->challans = $challanInterface;
    } 



    public function index()
    {
       $challans = $this->challans->all();
       return view('backend.challan.index', compact('challans'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Challan $challan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challan $challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challan $challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challan $challan)
    { 
        if($challan->deletable == 1){
            $challan->delete();
            notify()->success('delete Successfully','Success');
        }else{
            notify()->error('This Category is not Deletable','Error'); 
        }
        return back();
    }
}
