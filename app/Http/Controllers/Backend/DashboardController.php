<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Branch;
use App\Models\Backend\Invoice;
use Illuminate\Http\Request;
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

    $accounts = $this->accounts->branchAccounts()->skip(1); 
    $branches = Branch::select('id','name')
                                ->with([
                                    'invoices:id,total,branch_id'
                                ])
                                ->where('id', auth()->user()->branch_id )
                                ->get();

    return view('dashboard', compact('accounts','branches'));
}
  
}
