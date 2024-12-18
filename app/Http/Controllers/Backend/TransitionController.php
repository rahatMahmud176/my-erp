<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Transition;
use Illuminate\Http\Request;

class TransitionController extends Controller
{
    public $transitions;

    public function __construct(TransitionInterface $transitionInterface = null) {
        $this->transitions = $transitionInterface;
    } 


    public function index()
    {
        $today = date('Y-m-d').' 00:00:00';

        $transitions = Transition::where([['created_at','>=', $today]])
                                  ->where('branch_id', auth()->user()->branch_id)
                                  ->where('branch_id', auth()->user()->branch_id)->get();

        return view('backend.transition.index',compact('transitions'));
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
        $this->transitions->deposit($request,$request->invoice_id);
        notify('Successfully Pay done','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Transition $transition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transition $transition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transition $transition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transition $transition)
    {
        //
    }

    // ajax Functions 
   
    public function getTransitionsByDate()
    {
        $getDate = $_GET['date'];
        $transitions = Transition::whereDate('created_at','=', date($getDate))
                                   ->where('branch_id', auth()->user()->branch_id)
                                   ->get();
        return view('backend.transition.body-ajax',compact('transitions'));
    }

    public function getTodayTransitions()
    {
        $today = date('Y-m-d').' 00:00:00';

        $transitions = Transition::where([['created_at','>=', $today]])
                                  ->where('branch_id', auth()->user()->branch_id)
                                  ->where('branch_id', auth()->user()->branch_id)->get(); 
      return view('backend.transition.body-ajax',compact('transitions'));
    }





    public function getThisMonthTransitions()
    {
        $transitions = $this->transitions->branchTransitions(); 
        return view('backend.transition.body-ajax',compact('transitions'));
    }









}
