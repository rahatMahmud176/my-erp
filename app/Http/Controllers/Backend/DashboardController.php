<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\InvoiceInterface;
use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Invoice;
use App\Models\Backend\Transition; 
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public $accounts;
    public $invoices;
    public $transitions;

    public function __construct(AccountInterface $accountInterface = null,
                                InvoiceInterface $invoiceInterface,
                                TransitionInterface $transitionInterface
                                ) {
        $this->accounts     = $accountInterface;
        $this->invoices     = $invoiceInterface;
        $this->transitions  = $transitionInterface;
    }

public function dashboard()
{
    Gate::authorize('dashboard.index');  
    $accounts       = $this->accounts->branchAccounts()->skip(1);  
    $todaySale      = $this->invoices->todaySaleAmount();
    $todayPayment   = $this->transitions->todayPayment(); 
    return view('dashboard', compact('accounts','todaySale','todayPayment'));
}
  
}
