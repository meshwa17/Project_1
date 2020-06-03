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
use App\User;
use Charts;
use DB;

class ReportController extends Controller
{
    public function getStudentlist()
    {
    	$programs=Program::all();
        $shift=Shift::all();
        $time=Time::all();
        $batch=Batch::all();
        $group=Group::all();
        $academics=Academic::orderBy('academic_id','DESC')->get();
    	return view('report.studentList',compact('programs','academics','shift','time','batch','group'));
    }
    public function showStudentInfo(Request $re)
    {
    	$classes=$this->info()
                      ->select(DB::raw('students.student_id,
                        CONCAT(students.first_name," ",students.last_name) as name,
                        (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                        students.dob,
                        CONCAT(programs.program," / ",levels.level,
                        " / ",shifts.shift," / ",times.time," Start-(",classes.start_date," / ",classes.end_date,")") as program
                        '))
                     ->where('classes.class_id',$re->class_id)
                     ->get();

        //dump($classes);
    	return view('report.studentInfo',compact('classes'));
    }
    public function info()
    {
    	return Status::join('classes','classes.class_id',"=",'statuses.class_id')
    				 ->join('students','students.student_id',"=",'statuses.student_id')
    				 ->join('levels','levels.level_id',"=",'classes.level_id')
    				 ->join('programs','programs.program_id',"=",'levels.program_id')
    				 ->join('academics','academics.academic_id',"=",'classes.academic_id')
    				 ->join('shifts','shifts.shift_id',"=",'classes.shift_id')
    				 ->join('times','times.time_id',"=",'classes.time_id')
    				 ->join('batches','batches.batch_id',"=",'classes.batch_id')
    				 ->join('groups','groups.group_id',"=",'classes.group_id');
    				 
    				
    				 
    }

    //............................multi student class--------------------

    public function getStudentListMultiClass()
    {
        $programs=Program::all();
        $shift=Shift::all();
        $time=Time::all();
        $batch=Batch::all();
        $group=Group::all();
        $academics=Academic::orderBy('academic_id','DESC')->get();

        return view('report.studentListMultiClass',compact('programs','academics','shift','time','batch','group'));
    }
    public function showStudentInfoMultiClass(Request $request)
    {
        if($request->ajax())
        {
            if(!empty($request['chk'])){
        $classes=$this->info()
                ->select(DB::raw('students.student_id,
                        CONCAT(students.first_name," ",students.last_name) as name,
                        (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                        students.dob,
                        programs.program,
                        levels.level,
                        shifts.shift,
                        times.time,
                        batches.batch,
                        groups.group
                            '))
                     ->whereIn('classes.class_id',$request['chk'])
                     ->get();

            return view('report.studentInfoMultiClass',compact('classes'));
        }
            }
    }

    public function getnewStudentRegister()
    {
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

                    ->get();

        $chart = Charts::database($users, 'bar', 'highcharts')

                  ->title("Monthly new Register Users")

                  ->elementLabel("Total Users")

                  ->dimensions(1000, 500)

                  ->responsive(false)

                  ->groupByMonth(date('Y'), true);

    
        return view('report.newStudentRegister',compact('chart'));
    }
}
