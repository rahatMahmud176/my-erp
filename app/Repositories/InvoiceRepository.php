<?php

namespace App\Repositories;

use App\Contracts\InvoiceInterface;
use App\Models\Backend\Invoice;
use App\Models\Backend\InvoiceDetails;

class InvoiceRepository implements InvoiceInterface
{
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
}