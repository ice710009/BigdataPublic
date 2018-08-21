<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Report;
use Log;
use Config;
use Session;
use DB;
use sqlsrv_connect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//   public function __construct()
//   {
//        $this->middleware('auth');
//   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//		$permission =  config('GV.user');
//		Session::put('permission', $permission);
//		var_dump(class_exists('PDO'));
//		var_dump(DB::table('SOAA.SOAA.dbo.vw_bigdata_counsel')->first());
//		$db = DB::connection();

//		ini_set('mssql.charset', 'UTF-8');

		$link = mssql_connect("HostMSSQL", 'IRID', 'qwer1234');
		if (!$link)
			echo('Unable to connect!');
		$result = mssql_query("SET ANSI_NULLS ON;");
		$result = mssql_query("SET ANSI_WARNINGS ON;"); 
		
		date_default_timezone_set('Asia/Taipei');
		$Year = date("Y") - 1911;
		$Month = date("m");
		$Day = date("d");
		
		if ($Month == 1){
			$term = 1;
			$Year = $Year - 1;
		}
		else if ($Month >= 2 && $Month <= 9){
			$term = 2;
			$Year = $Year - 1;
		}
		else{
			$term = 1;
		}
		
		/*total student number*/				
		$std_result = mssql_query("SELECT count(trm_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_term] left join [SOAA].[SoAA].[dbo].[vw_bigdata_student]	on std_stdno = trm_stdno where trm_year = $Year and trm_term = $term and trm_studystatus <= 3 and substring(std_stdcode, 1, 1) like '[0-9]'");
		$row = mssql_fetch_array($std_result);
		$num = $row['num'];	

		
		/*student number by sex*/
		$std_result_s = mssql_query("SELECT std_sex ,count(std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_term] left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] on trm_stdno = std_stdno where trm_year = $Year and trm_term = $term and trm_studystatus <= 3 and substring(std_stdcode, 1, 1) like '[0-9]' group by std_sex");		
		while ($row_s = mssql_fetch_array($std_result_s)) {
			if ($row_s['std_sex'] == 1){
				$male = $row_s['num'];
			}
			else if ($row_s['std_sex'] == 2){
				$female = $row_s['num'];
			}
			else if ($row_s['std_sex'] == NULL){
				$unknown = $row_s['num'];
			}
		}
		
		
		/*student number by degree*/
		$std_result_d = mssql_query("SELECT std_degree ,count(std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_term] left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] on trm_stdno = std_stdno where trm_year = $Year and trm_term = $term and trm_studystatus <= 3 and substring(std_stdcode, 1, 1) like '[0-9]' group by std_degree");		
		while ($row_d = mssql_fetch_array($std_result_d)) {
			if ($row_d['std_degree'] == 1){
				$phD = $row_d['num'];
			}
			else if ($row_d['std_degree'] == 2){
				$master = $row_d['num'];
			}
			else if ($row_d['std_degree'] == 3){
				$ung = $row_d['num'];
			}
		}
		
		// /*student number by academy*/
		// $std_result_a = mssql_query("SELECT [trm_academyno], [trm_academyname] ,count([trm_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_term] left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] on std_stdno = trm_stdno where trm_year = $Year and trm_term = $term and trm_degree = 3 and trm_studystatus <= 3 group by [trm_academyno],[trm_academyname] order by [trm_academyno],[trm_academyname]");		
		// while ($row_a = mssql_fetch_array($std_result_a)) {
			// if ($row_a['trm_academyno'] == '*'){
				// $phD = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == '4'){
				// $master = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'A'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'B'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'C'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'E'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'I'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'K'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'M'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'S'){
				// $ung = $row_d['num'];
			// }
			// else if ($row_a['trm_academyno'] == 'Y'){
				// $ung = $row_d['num'];
			// }
		// }
		
		/*professor*/
		$teacher = mssql_query("SELECT EPT, count(EPT) as num FROM [人事共同資料庫].[personnelcommon].[dbo].[vi_bigdatacenter_webhr_jobdata] where 實際離職日 = ' ' and (EPT like '%教授%' or EPT like '%講師%') group by EPT");
		while ($row_t = mssql_fetch_array($teacher)) {
			if ($row_t['EPT'] == '教授'){
				$pro = $row_t['num'];
			}
			else if ($row_t['EPT'] == '副教授'){
				$asso_pro = $row_t['num'];
			}
			else if ($row_t['EPT'] == '助理教授'){
				$assi_pro = $row_t['num'];
			}
			else if ($row_t['EPT'] == '講師'){
				$lecturer = $row_t['num'];
			}
		}
		
		return view('home', compact('num', 'male', 'female', 'unknown', 'phD', 'master', 'ung', 'pro', 'asso_pro', 'assi_pro', 'lecturer', 'Year', 'term'));
		
    }
	
	public function mssql()
	{
	
	}
}
