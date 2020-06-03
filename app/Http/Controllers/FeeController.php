<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Level;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;
use App\Student;
use App\Status;
use App\Fee;
use App\Receipt;
use App\Transaction;
use App\StudentFee;
use App\ReceiptDetail;
use App\FeeType;
use DB;

class FeeController extends Controller
{
    //
    public function getPayment()
    {
    	return view('fee.searchPayment');
    }
    public function student_status($StudentId)
    {
    return Status::latest('statuses.status_id')
              ->join('students','students.student_id',"=",'statuses.student_id')
    		  ->join('classes','classes.class_id',"=",'statuses.class_id')
    		  ->join('academics','academics.academic_id',"=",'classes.academic_id')
    		  ->join('shifts','shifts.shift_id',"=",'classes.shift_id')
    		  ->join('times','times.time_id',"=",'classes.time_id')
    		  ->join('groups','groups.group_id',"=",'classes.group_id')
    		  ->join('batches','batches.batch_id',"=",'classes.batch_id')
    		  ->join('levels','levels.level_id',"=",'classes.level_id')
    		  ->join('programs','programs.program_id',"=",'levels.program_id')
              ->where('students.student_id',$StudentId)
              ->first();
    }
    public function show_school_fee($level_id)
    {
       return Fee::join('academics','academics.academic_id',"=",'fees.academic_id')
           ->join('levels','levels.level_id',"=",'fees.level_id')
           ->join('programs','programs.program_id',"=",'levels.program_id')
           ->join('feetypes','feetypes.fee_type_id',"=",'fees.fee_type_id')
           ->where('levels.level_id',$level_id)
           ->orderBy('fees.amount','DESC');

    }
    public function read_student_fee($student_id)
    {
        return StudentFee::join('fees','fees.fee_id',"=",'studentfees.fee_id')
                         ->join('students','students.student_id',"=",'studentfees.student_id')
                         ->join('levels','levels.level_id',"=",'studentfees.level_id')
                         ->join('programs','programs.program_id',"=",'levels.program_id')
                         ->select('levels.level_id',
                         		  'levels.level',
                              'programs.program_id',
                              'programs.program',
                     			  'fees.amount as school_fee',
                     			  'students.student_id',
                     			  'studentfees.s_fee_id',
                     			  'studentfees.amount as student_amount',
                     			  'studentfees.discount')
                         ->where('students.student_id',$student_id)
                         ->orderBy('studentfees.s_fee_id','DESC');
    }
    public function read_student_transaction($student_id)
    {
    	return ReceiptDetail::join('receipts','receipts.receipt_id',"=",'receiptdetails.receipt_id')
    						 ->join('students','students.student_id',"=",'receiptdetails.student_id')
    						 ->join('transactions','transactions.transaction_id',"=",'receiptdetails.transaction_id')
    						 ->join('fees','fees.fee_id',"=",'transactions.fee_id')
    						 ->join('users','users.id',"=",'transactions.user_id')
    						 ->where('students.student_id',$student_id);
    }
    
    public function payment($viewName,$student_id)
    {
    	  $feetypes=FeeType::all();
    	  $status=$this->student_status($student_id)->first();
    	  $programs=Program::where('program_id',$status->program_id)->get();
    	  $levels=Level::where('program_id',$status->program_id)->get();
        $studentfee=$this->show_school_fee($status->level_id)->first();
        $readStudentFee=$this->read_student_fee($student_id)->get();
        $readStudentTransaction=$this->read_student_transaction($student_id)->get();
        $receipt_id=ReceiptDetail::where('student_id',$student_id)->max('receipt_id');

		return view($viewName,compact('programs','levels','status','studentfee','receipt_id','readStudentFee','readStudentTransaction','feetypes'))->with('student_id',$student_id);
    }
    public function showStudentPayment(Request $request)
    {
    	$student_id=$request->student_id;
    	return $this->payment('fee.payment',$student_id);
    }
    public function goPayment($student_id)
    {
        return $this->payment('fee.payment',$student_id);
    }
    public function savePayment(Request $request)
    {
     
      $studentFee=StudentFee::create($request->all());
     //dump($studentFee);
        $transaction=Transaction::create(['transaction_date'=>$request->transaction_date,
                                          'fee_id'=>$request->fee_id,
                                          'user_id'=>$request->user_id,
                                          'student_id'=>$request->student_id,
                                          's_fee_id'=>$studentFee->s_fee_id,
                                          'paid'=>$request->paid,
                                          'remark'=>$request->remark,
                                          'description'=>$request->description]);
        $receipt_id=Receipt::autoNumber();
        ReceiptDetail::create(['receipt_id'=>$receipt_id,
                                'student_id'=>$request->student_id,
                               'transaction_id'=>$transaction->transaction_id]);
        return back();
    }
    public function createFee(Request $request)
    {
        dd($request->all());
        // if($request->ajax())
        // {
        //   $fee=Fee::create($request->all());
        //   return response($fee);
        // }
    }
    public function pay(Request $request)
    {
       if($request->ajax())
        {
          $studentFee = StudentFee::join('levels','levels.level_id',"=",'studentfees.level_id')
                    ->join('programs','programs.program_id',"=",'levels.program_id')
                    ->join('fees','fees.fee_id',"=",'studentfees.fee_id')
                    ->join('students','students.student_id',"=",'studentfees.student_id')
                    ->select('levels.level_id',
                              'levels.level',
                             'programs.program_id',
                              'programs.program',
                             'fees.fee_id',
                             'students.student_id',
                             'studentfees.s_fee_id',
                             'fees.amount as school_fee',
                              'studentfees.amount as student_amount',
                              'studentfees.discount')
                    ->where('studentfees.s_fee_id',$request->s_fee_id)
                    ->first();
                    //
            return response($studentFee);
         }
    }
    public function exstraPay(Request $request)
    {
     
        // dump($request->all());
       $transaction=Transaction::create($request->all());
       if(count($transaction)!=0)
       {
        $transaction_id=$transaction->transaction_id;
        $student_id=$transaction->student_id;
        $receipt_id=Receipt::autoNumber();
        ReceiptDetail::create(['receipt_id'=>$receipt_id,'student_id'=>$student_id,'transaction_id'=>$transaction_id]);
        return back();
       }

    }
    public function printInvoice($receipt_id)
    {
      $invoice=ReceiptDetail::join('receipts','receipts.receipt_id',"=",'receiptdetails.receipt_id')
                    ->join('students','students.student_id',"=",'receiptdetails.student_id')
                    ->join('transactions','transactions.transaction_id',"=",'receiptdetails.transaction_id')
                    ->join('fees','fees.fee_id',"=",'transactions.fee_id')
                    ->join('levels','levels.level_id',"=",'fees.level_id')
                    ->join('programs','programs.program_id',"=",'levels.program_id')
                    ->join('users','users.id',"=",'transactions.user_id')
                    ->join('statuses','statuses.student_id',"=",'students.student_id')
                    ->select('students.student_id',
                             'students.first_name',
                             'students.last_name',
                              'students.sex',
                              'fees.amount as school_fee',
                              'fees.fee_id',
                              'transactions.transaction_date',
                              'transactions.paid',
                              'users.name',
                              'receipts.receipt_id',
                              'statuses.class_id',
                              'transactions.s_fee_id')
                    ->where('receipts.receipt_id',$receipt_id)
                    ->first();

            $status=MyClass::join('levels','levels.level_id',"=",'classes.level_id')
                            ->join('shifts','shifts.shift_id',"=",'classes.shift_id')
                            ->join('times','times.time_id',"=",'classes.time_id')
                            ->join('groups','groups.group_id',"=",'classes.group_id')
                            ->join('batches','batches.batch_id',"=",'classes.batch_id')
                            ->join('academics','academics.academic_id',"=",'classes.academic_id')
                            ->join('programs','programs.program_id',"=",'levels.program_id')
                            ->join('statuses','statuses.class_id',"=",'classes.class_id')
                            ->where('classes.class_id',$invoice->class_id)
                            // ->where('levels.level_id',$invoice->level_id)
                            // ->where('statuses.student_id',$invoice->student_id)
                            ->select(DB::raw('CONCAT(programs.program,
                                                    " / Level-",levels.level,
                                                    " / Shift-",shifts.shift,
                                                    " / Time-",times.time,
                                                    " / Group-",groups.group,
                                                    " / Batch-",batches.batch,
                                                    " / Academic-",academics.academic,
                                                    " / Start Date-",classes.start_date,
                                                    " / End Date-",classes.end_date
                                                    ) As detail'))
                            ->first();
                            
            $studentFee=StudentFee::where('s_fee_id',$invoice->s_fee_id)->first();
             // dump($studentFee);
            $totalPaid=Transaction::where('s_fee_id',$invoice->s_fee_id)->sum('paid');
            // dump($totalPaid);
            // dump($status);
            // dump($invoice);
            return view('invoice.invoice',compact('invoice','status','totalPaid','studentFee'));
    }
    public function deleteTransaction($transaction_id)
    {
        Transaction::destroy($transaction_id);
        return back();
    }
    public function showLevelStudent(Request $request)
    {
         $status=MyClass::join('levels','levels.level_id',"=",'classes.level_id')
                            ->join('shifts','shifts.shift_id',"=",'classes.shift_id')
                            ->join('times','times.time_id',"=",'classes.time_id')
                            ->join('groups','groups.group_id',"=",'classes.group_id')
                            ->join('batches','batches.batch_id',"=",'classes.batch_id')
                            ->join('academics','academics.academic_id',"=",'classes.academic_id')
                            ->join('programs','programs.program_id',"=",'levels.program_id')
                            ->join('statuses','statuses.class_id',"=",'classes.class_id')
                            ->where('levels.level_id',$request->level_id)
                            ->where('statuses.student_id',$request->student_id)
                            ->select(DB::raw('CONCAT(programs.program,
                                                    " / Level-",levels.level,
                                                    " / Shift-",shifts.shift,
                                                    " / Time-",times.time,
                                                    " / Group-",groups.group,
                                                    " / Batch-",batches.batch,
                                                    " / Academic-",academics.academic,
                                                    " / Start Date-",classes.start_date,
                                                    " / End Date-",classes.end_date
                                                    ) As detail'))
                            ->first();
        return response($status);
    }
    public function createStudentLevel()
    {
        Status::insert(['student_id'=>21,'class_id'=>6]);
    }
//......................................
    public function getFeeReport()
    {
      return view('fee.feeReport');
    }
    //.........................................
    public function showFeeReport(Request $request)
    {
        $fees=$this->feeInfo()
        ->select("users.name",
                 "students.student_id",
                 "students.first_name",
                 "students.last_name",
                 "fees.amount as school_fee",
                 "studentfees.amount as student_fee",
                 "studentfees.discount",
                 "transactions.transaction_date",
                 "transactions.paid")
        ->whereDate("transactions.transaction_date",">=",$request->from)
        ->whereDate("transactions.transaction_date","<=",$request->to)
        ->orderBy("students.student_id")
        ->get();
        return view('fee.feeList',compact('fees'));
    }
    public function feeInfo()
    {
      return Transaction::join('fees','fees.fee_id',"=",'transactions.fee_id')
                ->join('students','students.student_id',"=",'transactions.student_id')
                ->join('studentfees','studentfees.s_fee_id',"=",'transactions.s_fee_id')
                ->join('users','users.id',"=",'transactions.user_id');
    }

}
