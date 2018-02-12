<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();
	Route::get('/home', 'HomeController@index');
	Route::get('/mssql', 'HomeController@mssql');
    Route::get('/', 'HomeController@index');
    Route::get('/workflow', function () {
    	return view('workflow');
    });	
    Route::get('/student/tableau', function () {
    	return view('student.tableau');
    });	
	Route::get('/student/new', function () {
    	return view('student.new');
    });
    Route::get('/student/register', function () {
    	return view('student.register');
    });
    Route::get('/student/official', function () {
    	return view('student.official');
    });
	
	/*薪資報告專區*/
	Route::get('/salary_report', function () {
    	return view('salary_report');
    });
	
	/*校務基金公開專區*/
	Route::get('/endowment_fund/endowment_fund1', function () {
    	return view('endowment_fund.endowment_fund1');
    });
	Route::get('/endowment_fund/endowment_fund2', function () {
    	return view('endowment_fund.endowment_fund2');
    });
	Route::get('/endowment_fund/endowment_fund3', function () {
    	return view('endowment_fund.endowment_fund3');
    });
	
	/*統計年報*/
	Route::get('/reportlist', function () {
    	return view('reportlist');
    });
	Route::get('/reports/{year}/index', 'ReportsController@index');
	Route::get('/reports/{year}/{category}/{no}', 'ReportsController@dashboard');
	
	
	/*儀錶板*/
	Route::get('/dashboard', function () {
    	return view('dashboard');
    });

    /*校務與財務資訊公開專區*/
	Route::get('/infopublic', function () {
    	return view('infopublic');
    });
	Route::get('/info_public/contact', function () {
    	return view('info_public.contact');
    });
	
    /*校務資訊系統說明*/
	Route::get('/info_public/ir_sys/ir_sys1', function () {
    	return view('info_public.ir_sys.ir_sys1');
    });
	Route::get('/info_public/ir_sys/ir_sys2', function () {
    	return view('info_public.ir_sys.ir_sys2');
    });
	Route::get('/info_public/ir_sys/ir_sys3', function () {
    	return view('info_public.ir_sys.ir_sys3');
    });
	Route::get('/info_public/ir_sys/ir_sys4', function () {
    	return view('info_public.ir_sys.ir_sys4');
    });
	Route::get('/info_public/ir_sys/ir_sys5', function () {
    	return view('info_public.ir_sys.ir_sys5');
    });
	
	/*財務資訊分析*/
	Route::get('/info_public/fund/fund1', function () {
    	return view('info_public.fund.fund1');
    });
	Route::get('/info_public/fund/fund2', function () {
    	return view('info_public.fund.fund2');
    });
	
	
	/*學雜費與就學補助資訊*/
	Route::get('/info_public/fee/fee1', function () {
    	return view('info_public.fee.fee1');
    });
	Route::get('/info_public/fee/fee2', function () {
    	return view('info_public.fee.fee2');
    });
	Route::get('/info_public/fee/fee3', function () {
    	return view('info_public.fee.fee3');
    });
	
	/*學校其他重要資訊*/
	Route::get('/info_public/oth_info/oth_info1', function () {
    	return view('info_public.oth_info.oth_info1');
    });
	Route::get('/info_public/oth_info/oth_info2', function () {
    	return view('info_public.oth_info.oth_info2');
    });
	Route::get('/info_public/oth_info/oth_info3', function () {
    	return view('info_public.oth_info.oth_info3');
    });
	Route::get('/info_public/oth_info/oth_info4', function () {
    	return view('info_public.oth_info.oth_info4');
    });
	Route::get('/info_public/oth_info/oth_info5', function () {
    	return view('info_public.oth_info.oth_info5');
    });
	
	/*內部內稽執行情形*/
	Route::get('/info_public/control/control1', function () {
    	return view('info_public.control.control1');
    });
	
	/* Portal post接收 */
	Route::post('/home', 'ReportsController@portal_post');
	
	/* 電子表單 */
	Route::get('/myApply', 'ApplyController@myApply');
	Route::resource('apply', 'ApplyController',
                array('only' => array('create', 'store', 'show', 'update', 'destroy', 'edit')));
	
	/* 碩博士生調查 */
	Route::get('/analysis/analysis_menu', function () {
    	return view('analysis.analysis_menu');
    });
	Route::get('/analysis/_source', 'AnalysisSourceController@analysis_source');	
	Route::get('/analysis/source/get_departments', 'AnalysisSourceController@get_departments');
	
	Route::get('/analysis/_status', 'AnalysisStatusController@analysis_status');
	Route::get('/analysis/status/get_departments', 'AnalysisStatusController@get_departments');
	Route::get('/analysis/status/get_enrolltype', 'AnalysisStatusController@get_enrolltype');
	
	//Route::get('/analysis/analysis_source', 'AnalysisSourceController@analysis_source');
		

});

 

