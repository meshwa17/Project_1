<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as'=>'/','uses'=>'LoginController@getLogin']);
Route::post('/login',['as'=>'login','uses'=>'LoginController@postLogin']);

Route::get('/noPermission',function(){
		return view('permission.noPermission');
});

//Route::group(['middleware'=>['authen']],function(){
	Route::get('/logout',['as'=>'logout','uses'=>'LoginController@getLogout']);
	Route::get('/dashboard',['as'=>'dashboard','uses'=>'DashboardController@dashboard']);

 //});

// Route::group(['middleware'=>['authen','roles'],'roles'=>['admin']],function(){
		//for admin

	Route::get('/manage/course',['as'=>'manageCourse','uses'=>'CourseController@getManageCourse']);

	Route::post('/manage/course/insert',['as'=>'postInsertAcademic','uses'=>'CourseController@postInsertAcademic']);

	Route::post('/manage/course/insert-program',['as'=>'postInsertProgram','uses'=>'CourseController@postInsertProgram']);

	Route::post('/manage/course/insert-level',['as'=>'postInsertLevel','uses'=>'CourseController@postInsertLevel']);
	Route::get('/manage/course/showLevel',['as'=>'showLevel','uses'=>'CourseController@showLevel']);

	Route::post('/manage/course/shift',['as'=>'createShift','uses'=>'CourseController@createShift']);

	Route::post('/manage/course/time',['as'=>'createTime','uses'=>'CourseController@createTime']);

	Route::post('/manage/course/batch',['as'=>'createBatch','uses'=>'CourseController@createBatch']);

	Route::post('/manage/course/group',['as'=>'createGroup','uses'=>'CourseController@createGroup']);

	Route::get('/manage/course/class',['as'=>'createClass','uses'=>'CourseController@createClass']);

	Route::get('/manage/course/classinfo',['as'=>'showClassInformation','uses'=>'CourseController@showClassInformation']);

	Route::post('/manage/course/class/delete',['as'=>'deleteClass','uses'=>'CourseController@deleteClass']);

	Route::get('/manage/course/class/edit',['as'=>'editClass','uses'=>'CourseController@editClass']);

	Route::post('/manage/course/class/update',['as'=>'updateClassInfo','uses'=>'CourseController@updateClassInfo']);
	//.......................student registarion......................
	Route::get('/student/getregister',['as'=>'getStudentRegister','uses'=>'StudentController@getStudentRegister']);

	Route::post('/student/postregister',['as'=>'postStudentRegister','uses'=>'StudentController@postStudentRegister']);

	Route::get('/student/info',['as'=>'studetInfo','uses'=>'StudentController@studetInfo']);
	//..........................fee registaration........................

	Route::get('/student/show/payment',['as'=>'getPayment','uses'=>'FeeController@getPayment']);

	Route::get('/student/payment',['as'=>'showStudentPayment','uses'=>'FeeController@showStudentPayment']);
	Route::get('/student/go/to/payment/{student_id}',['as'=>'goPayment','uses'=>'FeeController@goPayment']);

	Route::post('/student/payment/save',['as'=>'savePayment','uses'=>'FeeController@savePayment']);

	Route::post('/fee/create',['as'=>'createFee','uses'=>'FeeController@createFee']);

	Route::get('/fee/student/pay',['as'=>'pay','uses'=>'FeeController@pay']);

	Route::post('/fee/student/exstra/pay',['as'=>'exstraPay','uses'=>'FeeController@exstraPay']);

	Route::get('/fee/student/print/invoice/{receiptId}',['as'=>'printInvoice','uses'=>'FeeController@printInvoice']);
	Route::get('/fee/student/transaction/delete/{transactionId}',['as'=>'deleteTransaction','uses'=>'FeeController@deleteTransaction']);
	Route::get('/fee/student/show/level',['as'=>'showLevelStudent','uses'=>'FeeController@showLevelStudent']);
	//-------------------------------------------------------
	Route::get('/fee/report',['as'=>'getFeeReport','uses'=>'FeeController@getFeeReport']);

	Route::get('/fee/show/fee-report',['as'=>'showFeeReport','uses'=>'FeeController@showFeeReport']);


	//route test
	Route::get('/create/student/level',['as'=>'createStudentLevel','uses'=>'FeeController@createStudentLevel']);

	//..........................Report Controller..............................
	Route::get('/report/student-list',['as'=>'getStudentlist','uses'=>'ReportController@getStudentlist']);
	Route::get('/report/student-info',['as'=>'showStudentInfo','uses'=>'ReportController@showStudentInfo']);

	Route::get('/report/student-multi-class',['as'=>'getStudentListMultiClass','uses'=>'ReportController@getStudentListMultiClass']);

	Route::get('/report/student-info-multi-class',['as'=>'showStudentInfoMultiClass','uses'=>'ReportController@showStudentInfoMultiClass']);

	Route::get('/student/new/register',['as'=>'getnewStudentRegister','uses'=>'ReportController@getnewStudentRegister']);

	//-----------------
 //});

