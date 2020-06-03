<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table='transactions';
    protected $fillable=['transaction_date','fee_id','user_id','student_id','s_fee_id','description','paid','remark'];
    protected $primaryKey='transaction_id';
    public $timestamps=false;
}
