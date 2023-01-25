<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicedetail extends Model
{
    use HasFactory;
    // protected $guarded =[];
    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'Section',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];

    public function section()
    {
        return $this->belongsTo('app\Models\Section','Section','id');
    }
}
