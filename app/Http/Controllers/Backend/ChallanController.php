<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\ChallanInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Challan;
use Illuminate\Http\Request;

class ChallanController extends Controller
{
   public $challans;
   public $accounts;


    public function __construct(ChallanInterface $challanInterface = null, 
                                AccountInterface $accountInterface) {
        $this->challans = $challanInterface;
        $this->accounts = $accountInterface;
        
    }  

    public function index()
    {
     
        $accounts = $this->accounts->branchAccounts()->skip(1); 
        $challans = $this->challans->branchChallan();
       return view('backend.challan.index', compact('challans','accounts'));
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
        return view('backend.challan.challan-view', compact('challan'));
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


    // ajax functions 
    public function getFullMonthChallans()
    {
        $accounts = $this->accounts->branchAccounts()->skip(1); 
        $challans = $this->challans->branchChallanThisMonth();
       return response()->view('backend.challan.challan-body-ajax', compact('challans','accounts'));
    }

    public function getTodayChallans()
    {
        $accounts = $this->accounts->branchAccounts()->skip(1); 
        $challans = $this->challans->branchChallan();
        return response()->view('backend.challan.challan-body-ajax', compact('challans','accounts'));
    }














}
