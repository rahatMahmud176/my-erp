<?php

namespace App\Repositories;

use App\Contracts\InvoiceInterface;
use App\Models\Backend\Invoice;
use App\Models\Backend\InvoiceDetails;

class InvoiceRepository implements InvoiceInterface
{
    public $today;
    public function __construct() {
        $this->today = date('Y-m-d') . ' 00:00:00'; 
    }


    public function allInvoices()
    {
        return Invoice::allInvoices();
    }
    public function branchInvoices()
    {
        return Invoice::branchInvoices();
    }
    public function branchInvoicesThisMonth()
    {
        return Invoice::branchInvoicesThisMonth();
    }
    public function newInvoice($request, $customerId)
    {
        return Invoice::newInvoice($request, $customerId);
    }
 
    public function newDetails($sale,$invoiceId)
    {
        return InvoiceDetails::new($sale, $invoiceId);
    }

    public function todaySaleAmount()
    { 
       return Invoice::where([['created_at','>=',$this->today]]) 
                        ->where('branch_id', auth()->user()->branch_id)->sum('total'); 
    }





}