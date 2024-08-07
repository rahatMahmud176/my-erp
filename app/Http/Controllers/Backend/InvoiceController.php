<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\InvoiceInterface;
use App\Contracts\SettingInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Invoice;
use App\Models\Backend\Setting;
use App\Models\Backend\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{


    public $accounts;
    public $settings;
    public $invoices;


    public function __construct(AccountInterface $accountInterface,
                                SettingInterface $settingInterface,
                                InvoiceInterface $invoiceInterface,
    ) { 
        $this->accounts = $accountInterface; 
        $this->settings = $settingInterface;
        $this->invoices = $invoiceInterface;
    } 




    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $invoices = $this->invoices->branchInvoices(); 
        $accounts = $this->accounts->branchAccounts()->skip(1); 
        return view('backend.invoice.index', compact('invoices','accounts'));
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
    public function show(string $id)
    {
        $invoice = Invoice::with('transitions:id,invoice_id,deposit,created_at')->find($id);
        $company = $this->settings->companyInfo();
        return view('backend.invoice.invoice', compact('invoice','company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        DB::beginTransaction();

            try {
                $invoice = Invoice::find($id); 
                foreach ($invoice->details as $key => $detail) {
                    $stock =   Stock::find($detail->stock_id);
                    $stock->unit_qty = $stock->unit_qty + $detail->unit_qty;
                    $stock->sub_unit_qty = $stock->sub_unit_qty + $detail->sub_unit_qty;
                    $stock->save(); 
                }  
                $invoice->delete();  

                DB::commit();
                notify('Deleted Successfully', 'Deleted');  
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                notify()->error('This Invoice Not Deleted', 'Error');
            } 
        return back();
    }
}
