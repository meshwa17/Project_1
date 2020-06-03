<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{
    //
    protected $table='receiptdetails';
    protected $fillable=['receipt_id','student_id','transaction_id'];
    public $timestamps=false;
}
