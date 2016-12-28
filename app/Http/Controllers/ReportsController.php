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
		
        return view($dir, compact('organize', 'teacher', 'student', 'research', 'financial', 'staff'));
    }
	public function portal_post()
    {

		$config = array(
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
    }
}
