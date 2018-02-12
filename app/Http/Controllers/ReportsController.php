<?php
namespace App\Http\Controllers;

include('../public/Dalbase_v2.php');
use Dalbase;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Report;
use Log;
use Cookie;
use View;
use Config;
use Session;



class ReportsController extends Controller
{
	public function index($year)
    {
		$year = $year + 1911;
		$organize = Report::where('year', '=', $year)->where('topic', '=', '1')->where('open', '=', '1')->orderBy('index')->get();
		$teacher = Report::where('year', '=', $year)->where('topic', '=', '2')->where('open', '=', '1')->orderBy('index')->get();
		$student = Report::where('year', '=', $year)->where('topic', '=', '3')->where('open', '=', '1')->orderBy('index')->get();
		$research = Report::where('year', '=', $year)->where('topic', '=', '4')->where('open', '=', '1')->orderBy('index')->get();
		$financial = Report::where('year', '=', $year)->where('topic', '=', '5')->where('open', '=', '1')->orderBy('index')->get();
		$staff = Report::where('year', '=', $year)->where('topic', '=', '6')->where('open', '=', '1')->orderBy('index')->get();

		$year = $year - 1911;
		$dir = 'reports.' . $year . '.index';
		$category = '';
		
        return view($dir, compact('organize', 'teacher', 'student', 'research', 'financial', 'staff', 'category'));
    }
	
	public function dashboard($year, $category, $no)
    {
		if ($no < 10){
			$no = '0'.$no;
		}
		$dir = 'reports.' . $year . '.' . $category . '.' . $no;
		
        return view($dir);
    }
	
	
    //post token to JWT SERVER
	public function httpPost($url, $data)  //自訂的httpPost Function $url:JWT Server, $data:JWT字串
	{
		$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_POST, true);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    	$response = curl_exec($curl);
    	curl_close($curl);
    	return (json_decode($response, true));
	}
	public function portal_post()
    {

/*		$config = array(
		'userId' => 'nctubigdata',
		'apiKey' => '78916D21AF194A159037A9333603460DF51B333DB3804EC890E3C0FEBD00D9C3'
		);
		//初始化API
		$cd = new Dalbase($config);
		$result = $cd->api('/employee/'.$_POST['txtId'], 'GET', array('type'=>'employee'));
		$result2 = $cd->api('/employee', 'GET', array('type'=>'depcode'));
		$error = $cd->errno;
		$info = $cd->curlInfo;
		Log::info($_POST['txtId']);
		Log::info($result);

		if($result['result']){
			foreach($result['result'] as $i => $arr){
				$name = $arr['Name'];
			}
		}
		if($_POST['txtId'][0] == 'A'){
			$permission =  config('GV.supervisor');
		}
		else if($result['result']){
			foreach($result['result'] as $i => $arr)
			{
				if($arr['higherup'] == "000" && $arr['Name'] == $arr['director_name'])
				{
					Log::info("supervisor");
					$permission =  config('GV.supervisor');
				}
				else{
					Log::info("staff");
					$permission =  config('GV.staff');
				}
			}
		}
		else{
			Log::info("others");
			$permission =  config('GV.user');
			$name = $_POST['txtId'];
		}
		
		Session::put('permission', $permission);
		Session::put('ID', $_POST['txtId']);
		Session::put('NAME', $name);
		
		return view('home2', compact('result', 'result2', 'error', 'info'));
*/
		
		/* ----  portal 人事API ---- */
		
		session_start();
		$url = 'https://portal.nctu.edu.tw/jwt/portal'; //jwt server url
		$data = array('token' => $_POST['jwt']); //接收jwt字串後存到array
		$jwt_result = $this->httpPost($url, $data);

		//echo "JWT SERVER回傳結果<br>";
		//print_r ($result);
	
		// 驗證成功
   		if ($jwt_result['status']==='true') { //執行登入成功後的流程
			//人事代號or學號
			$txtID = $jwt_result['data']['txtID']; 
			//姓名
			$txtName = $jwt_result['data']['txtName']; 
//			echo '登入成功：'.$txtID.' '.$txtName;
    	}
    	else { 
			// 驗證失敗 執行登入失敗後的流程
        	echo '登入失敗：'.$jwt_result['message']; 
    	}
//	   	Log::info($jwt_result);


	   	$config = array(
		'userId' => 'nctubigdata',
		'apiKey' => '78916D21AF194A159037A9333603460DF51B333DB3804EC890E3C0FEBD00D9C3'
		);
		//初始化API
		$cd = new Dalbase($config);
		$result = $cd->api('/employee/'.$txtID, 'GET', array('type'=>'employee'));
		$result2 = $cd->api('/employee', 'GET', array('type'=>'depcode'));
		$error = $cd->errno;
		$info = $cd->curlInfo;
//		Log::info($txtID);
//		Log::info($result);
//		Log::info($result2);

		// 育君改寫後；1.修改博後判斷式 2.增加系主任、學院院長等職級
		if($result['result']){
			foreach($result['result'] as $i => $arr){
				$name = $arr['Name'];
			}
		}
		
		if(is_int($txtID[0])){
			$permission = config('GV.student');
		}
		else if($result['result']){
			foreach($result['result'] as $i => $arr)
			{
				if(substr($arr['code_name'], 0, 3) == "博士後"){
					$permission =  config('GV.supervisor');
				}
				else if($arr['higherup'] == "000" && $arr['Name'] == $arr['director_name'])
				{
					//學院院長，依序理(COS)、電機(ECE)、資訊(CCS)、工(COE)、管理(COM)、人社(CHS)、生科(CBT)、客家(CHK)、光電(COP)、半導體(ICC)、科法(CTL)
					if($arr['DepCode'] == "COS" || $arr['DepCode'] == "ECE" || $arr['DepCode'] == "CCS" || $arr['DepCode'] == "COE" || $arr['DepCode'] == "COM" || $arr['DepCode'] == "CHS" || $arr['DepCode'] == "CBT" || $arr['DepCode'] == "CHK" || $arr['DepCode'] == "COP" || $arr['DepCode'] == "ICC" || $arr['DepCode'] == "CTL"){
						$permission =  config('GV.dean');
					}
					else{
						$permission =  config('GV.supervisor');
					}					
				}
				else if(substr($arr['DepCode'], 0, 3) == "660"){ //設定網頁管理者的權限
					$permission =  config('GV.staff');
				}
				else{
					$permission =  config('GV.user');
				}
				$DepCode = $arr['DepCode'];
				$DepName = $arr['DepName'];
			}
		}
		else{
			$permission =  config('GV.user');
			$name = $txtID;
		}
		Session::put('permission', $permission);
		Session::put('ID', $txtID);
		Session::put('NAME', $txtName);
		Session::put('DepNo', $DepCode);
		Session::put('DepName', $DepName);

/*鈺玲的原始寫法
		if($result['result']){
			foreach($result['result'] as $i => $arr){
				$name = $arr['Name'];
			}
		}
		if($txtID[0] == 'A'){
			$permission =  config('GV.supervisor');
		}
		else if (is_int($txtID[0])){
			$permission = config('GV.student');
		}
		else if($result['result']){
			foreach($result['result'] as $i => $arr)
			{
				if($arr['higherup'] == "000" && $arr['Name'] == $arr['director_name'])
				{
//					Log::info("supervisor");
					$permission =  config('GV.supervisor');
				}
				else{
//					Log::info("staff");
					$permission =  config('GV.staff');
				}
			}
		}
		else{
//			Log::info("others");
			$permission =  config('GV.user');
			$name = $txtID;
		}
*/		



//		以下複製HomeController index()內容
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
		else if ($Month >= 2 && ($Month <= 9 && $Day <= 13)){
			$term = 2;
			$Year = $Year - 1;
		}
		if ($Month <= 12){
			$term = 1;
		}
		
		/*total student number*/				
		$std_result = mssql_query("SELECT count(trm_stdno) as num FROM SOAA.SOAA.dbo.vw_bigdata_term left join [SOAA].[SoAA].[dbo].[vw_bigdata_student]	on std_stdno = trm_stdno where trm_year = $Year and trm_term = $term and trm_studystatus <= 3 and substring(std_stdcode, 1, 1) like '[0-9]'");
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
		
		return view('home', compact('num', 'male', 'female', 'unknown', 'phD', 'master', 'ung', 'pro', 'asso_pro', 'assi_pro', 'lecturer'));
    }
}
