<?php
namespace App\Contracts;

interface InvoiceInterface{

    public function allInvoices();
    public function branchInvoices();
    public function newInvoice($request, $customerId);
    public function newDetails($sale,$invoiceId);




}