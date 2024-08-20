<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

public static function new($sale, $invoiceId)
{
    InvoiceDetails::create([
        'invoice_id'    => $invoiceId,
        'stock_id'      => $sale['id'],
        'sale_price'    => $sale['sale_price'],
        'unit_qty'      => $sale['unit_qty'],
        'sub_unit_qty'  => $sale['sub_unit_qty'],
    ]);
}










    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }   
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }   







}
