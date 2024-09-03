<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Invoice;
use App\Models\Backend\Transition; 
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public $accounts;

    public function __construct(AccountInterface $accountInterface = null) {
        $this->accounts = $accountInterface;
    }

public function dashboard()
{
    Gate::authorize('dashboard.index');

    
    // $branches = Branch::select('id','name')
    //                             ->with([
    //                                 'invoices:id,total,branch_id'
    //                             ])
    //                             ->where('id', auth()->user()->branch_id )
    //                             ->get();
    $accounts = $this->accounts->branchAccounts()->skip(1); 
    $today     = date('Y-m-d') . ' 00:00:00';

    $todaySale = Invoice::where([['created_at','>=',$today]]) 
                        ->where('branch_id', auth()->user()->branch_id)->sum('total');
 
    $todayPayment = Transition::where([['created_at','>=',$today]]) 
                            ->where('branch_id', auth()->user()->branch_id)->sum('pay'); 

    return view('dashboard', compact('accounts','todaySale','todayPayment'));
}
  
}
