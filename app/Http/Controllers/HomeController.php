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
        return view('home');
    }
	public function mssql()
	{
		var_dump(class_exists('PDO'));
//		var_dump(DB::table('SOAA.SOAA.dbo.vw_bigdata_counsel')->first());
//		$db = DB::connection();
		$link = mssql_connect("HostMSSQL", 'IRID', 'qwer1234');
		if (!$link)
			echo('Unable to connect!');
		$result = mssql_query("SET ANSI_NULLS ON;");
		$result = mssql_query("SET ANSI_WARNINGS ON;"); 
//if (!mssql_select_db('[SOAA].[SOAA].[dbo].[vw_bigdata_counsel]', $link))
 //   echo('Unable to select database!');

		$result = mssql_query('SELECT * FROM SOAA.SOAA.dbo.vw_bigdata_counsel');

		while ($row = mssql_fetch_array($result)) {
			var_dump($row);
		}

//		$tables = DB::select('select * from SOAA.SOAA.dbo.vw_bigdata_counsel');
//		$query = DB::table('SOAA.SOAA.dbo.vw_bigdata_counsel')->where('name', 'LIKE', "a")->get();
//		$query = Counsel::all();
/*		Log::info("qq");
		foreach($query as $q)
			Log :: info($q->name);
*/
	}
}
