<?php

namespace App\Http\Controllers;

include('../public/Dalbase_v2.php');
use Dalbase;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Departments;
use Input;
use Response;
use Log;
use Carbon\Carbon;
use sqlsrv_connect;

class AnalysisStatusController extends Controller
{
    //
	
	public function get_departments()
	{
		$academe=Input::get('academe');
		$degree=Input::get('degree');
		$departments=Departments::where('aca_no', '=', $academe)->where('degree', '=', $degree)->get();
		
		$name=array();
		$no=array();
		foreach($departments as $dep){
			array_push($name, $dep->dep_name);
			array_push($no, $dep->dep_no);
		}		
		return Response::json(array('name'=>$name, 'no'=>$no));
	}
	
	public function get_enrolltype()
	{
		$degree=Input::get('degree');
		$enrolltypes=Enrolltypes::where('degree', '=', $degree)->get();
		
		$name=array();
		$no=array();
		foreach($enrolltypes as $type){
			array_push($name, $type->enrolltype_name);
			array_push($no, $type->enrolltype);
		}		
		return Response::json(array('name'=>$name, 'no'=>$no));
	}
	
	public function get_enrolltype_c($enrolltype)
	{
		$enrolltype_c = '入學方式';
		if ($enrolltype == 1){
			return $enrolltype_c = '考試入學-一般生';
		}
		if ($enrolltype == 2){
			return $enrolltype_c = '考試入學-在職生';
		}
		if ($enrolltype == 4){
			return $enrolltype_c = '甄試入學-一般生';
		}
		if ($enrolltype == 5){
			return $enrolltype_c = '甄試入學-在職生';
		}
		if ($enrolltype == 6){
			return $enrolltype_c = '僑生';
		}
		if ($enrolltype == 7){
			return $enrolltype_c = '外籍生';
		}
		if ($enrolltype == 8){
			return $enrolltype_c = '大學逕博';
		}
		if ($enrolltype == 9){
			return $enrolltype_c = '碩士逕博';
		}
		if ($enrolltype == 17){
			return $enrolltype_c = '陸生';
		}		
	}
	
	public function get_new($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數 */
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_enrolltype != 3 and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$new = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($new, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$new[$i] = $row['num'];
				}				
			}
		}
		return $new;
	}
	
	
	/*------------------------全校博士班-------------------------*/	
	/*                每學年入學博士班新生人數                   */
	public function get_NCTU_new_p($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$NCTU_new_p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_new_p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_new_p[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_new_p;
	}
	/*                每學年入學博士班學生最終修業狀態--在學                 */
	public function get_NCTU_p1($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$NCTU_p1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_p1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_p1[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_p1;
	}
	/*                每學年入學博士班學生最終修業狀態--休學                 */
	public function get_NCTU_p4($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$NCTU_p4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_p4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_p4[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_p4;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期中退學                 */
	public function get_NCTU_p5($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$NCTU_p5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_p5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_p5[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_p5;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期末退學                 */
	public function get_NCTU_p6($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$NCTU_p6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_p6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_p6[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_p6;
	}
	
	/*                每學年入學博士班學生最終修業狀態--其它                 */
	public function get_NCTU_po($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus <= 9 and std_studingstatus >= 7) group by std_enrollyear order by std_enrollyear");
		$NCTU_po = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_po, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_po[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_po;
	}
	
	/*                每學年入學博士班學生最終修業狀態--畢業                 */
	public function get_NCTU_p11($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$NCTU_p11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_p11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_p11[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_p11;
	}
	
	/*------------------------全校碩士班-------------------------*/	
	/*                每學年入學碩士班新生人數                   */
	public function get_NCTU_new_m($start_year, $end_year)
	{
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$NCTU_new_m = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_new_m, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_new_m[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_new_m;
	}
	/*                每學年入學碩士班學生最終修業狀態--在學                 */
	public function get_NCTU_m1($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$NCTU_m1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_m1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_m1[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_m1;
	}
	/*                每學年入學碩士班學生最終修業狀態--休學                 */
	public function get_NCTU_m4($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$NCTU_m4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_m4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_m4[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_m4;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期中退學                 */
	public function get_NCTU_m5($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$NCTU_m5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_m5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_m5[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_m5;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期末退學                 */
	public function get_NCTU_m6($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$NCTU_m6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_m6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_m6[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_m6;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--其它                 */
	public function get_NCTU_mo($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus >= 7 and std_studingstatus <= 9) group by std_enrollyear order by std_enrollyear");
		$NCTU_mo = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_mo, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_mo[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_mo;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--畢業                 */
	public function get_NCTU_m11($start_year, $end_year)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$NCTU_m11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($NCTU_m11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$NCTU_m11[$i] = $row['num'];
				}				
			}
		}
		return $NCTU_m11;
	}
	

	
	/*-----------------------各學院博士班------------------------*/	
	/*                每學年入學博士班新生人數                   */
	public function get_ACA_new_p($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$ACA_new_p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_new_p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_new_p[$i] = $row['num'];
				}				
			}
		}
		return $ACA_new_p;
	}
	/*                每學年入學博士班學生最終修業狀態--在學                 */
	public function get_ACA_p1($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$ACA_p1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_p1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_p1[$i] = $row['num'];
				}				
			}
		}
		return $ACA_p1;
	}
	/*                每學年入學博士班學生最終修業狀態--休學                 */
	public function get_ACA_p4($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$ACA_p4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_p4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_p4[$i] = $row['num'];
				}				
			}
		}
		return $ACA_p4;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期中退學                 */
	public function get_ACA_p5($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$ACA_p5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_p5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_p5[$i] = $row['num'];
				}				
			}
		}
		return $ACA_p5;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期末退學                 */
	public function get_ACA_p6($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$ACA_p6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_p6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_p6[$i] = $row['num'];
				}				
			}
		}
		return $ACA_p6;
	}
	
	/*                每學年入學博士班學生最終修業狀態--其它                 */
	public function get_ACA_po($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus <= 9 and std_studingstatus >= 7) group by std_enrollyear order by std_enrollyear");
		$ACA_po = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_po, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_po[$i] = $row['num'];
				}				
			}
		}
		return $ACA_po;
	}
	
	/*                每學年入學博士班學生最終修業狀態--畢業                 */
	public function get_ACA_p11($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$ACA_p11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_p11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_p11[$i] = $row['num'];
				}				
			}
		}
		return $ACA_p11;
	}
	
	/*-----------------------各學院碩士班------------------------*/	
	/*                每學年入學碩士班新生人數                   */
	public function get_ACA_new_m($start_year, $end_year, $academe)
	{
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$ACA_new_m = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_new_m, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_new_m[$i] = $row['num'];
				}				
			}
		}
		return $ACA_new_m;
	}
	/*                每學年入學碩士班學生最終修業狀態--在學                 */
	public function get_ACA_m1($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$ACA_m1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_m1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_m1[$i] = $row['num'];
				}				
			}
		}
		return $ACA_m1;
	}
	/*                每學年入學碩士班學生最終修業狀態--休學                 */
	public function get_ACA_m4($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$ACA_m4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_m4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_m4[$i] = $row['num'];
				}				
			}
		}
		return $ACA_m4;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期中退學                 */
	public function get_ACA_m5($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$ACA_m5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_m5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_m5[$i] = $row['num'];
				}				
			}
		}
		return $ACA_m5;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期末退學                 */
	public function get_ACA_m6($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$ACA_m6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_m6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_m6[$i] = $row['num'];
				}				
			}
		}
		return $ACA_m6;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--其它                 */
	public function get_ACA_mo($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus >= 7 and std_studingstatus <= 9) group by std_enrollyear order by std_enrollyear");
		$ACA_mo = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_mo, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_mo[$i] = $row['num'];
				}				
			}
		}
		return $ACA_mo;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--畢業                 */
	public function get_ACA_m11($start_year, $end_year, $academe)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$ACA_m11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($ACA_m11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$ACA_m11[$i] = $row['num'];
				}				
			}
		}
		return $ACA_m11;
	}
	

	/*-----------------------各系所博士班------------------------*/	
	/*                每學年入學博士班新生人數                   */
	public function get_DEP_new_p($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$DEP_new_p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_new_p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_new_p[$i] = $row['num'];
				}				
			}
		}
		return $DEP_new_p;
	}
	/*                每學年入學博士班學生最終修業狀態--在學                 */
	public function get_DEP_p1($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$DEP_p1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_p1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_p1[$i] = $row['num'];
				}				
			}
		}
		return $DEP_p1;
	}
	/*                每學年入學博士班學生最終修業狀態--休學                 */
	public function get_DEP_p4($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$DEP_p4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_p4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_p4[$i] = $row['num'];
				}				
			}
		}
		return $DEP_p4;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期中退學                 */
	public function get_DEP_p5($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$DEP_p5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_p5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_p5[$i] = $row['num'];
				}				
			}
		}
		return $DEP_p5;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期末退學                 */
	public function get_DEP_p6($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$DEP_p6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_p6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_p6[$i] = $row['num'];
				}				
			}
		}
		return $DEP_p6;
	}
	
	/*                每學年入學博士班學生最終修業狀態--其它                 */
	public function get_DEP_po($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus <= 9 and std_studingstatus >= 7) group by std_enrollyear order by std_enrollyear");
		$DEP_po = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_po, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_po[$i] = $row['num'];
				}				
			}
		}
		return $DEP_po;
	}
	
	/*                每學年入學博士班學生最終修業狀態--畢業                 */
	public function get_DEP_p11($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$DEP_p11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_p11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_p11[$i] = $row['num'];
				}				
			}
		}
		return $DEP_p11;
	}
	
	/*-----------------------各系所碩士班------------------------*/	
	/*                每學年入學碩士班新生人數                   */
	public function get_DEP_new_m($start_year, $end_year, $academe, $dep_no)
	{
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$DEP_new_m = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_new_m, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_new_m[$i] = $row['num'];
				}				
			}
		}
		return $DEP_new_m;
	}
	/*                每學年入學碩士班學生最終修業狀態--在學                 */
	public function get_DEP_m1($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$DEP_m1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_m1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_m1[$i] = $row['num'];
				}				
			}
		}
		return $DEP_m1;
	}
	/*                每學年入學碩士班學生最終修業狀態--休學                 */
	public function get_DEP_m4($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$DEP_m4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_m4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_m4[$i] = $row['num'];
				}				
			}
		}
		return $DEP_m4;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期中退學                 */
	public function get_DEP_m5($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$DEP_m5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_m5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_m5[$i] = $row['num'];
				}				
			}
		}
		return $DEP_m5;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期末退學                 */
	public function get_DEP_m6($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$DEP_m6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_m6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_m6[$i] = $row['num'];
				}				
			}
		}
		return $DEP_m6;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--其它                 */
	public function get_DEP_mo($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus >= 7 and std_studingstatus <= 9) group by std_enrollyear order by std_enrollyear");
		$DEP_mo = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_mo, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_mo[$i] = $row['num'];
				}				
			}
		}
		return $DEP_mo;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--畢業                 */
	public function get_DEP_m11($start_year, $end_year, $academe, $dep_no)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$DEP_m11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEP_m11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEP_m11[$i] = $row['num'];
				}				
			}
		}
		return $DEP_m11;
	}
	

	/*--------------------各系所博士班加上入學管道--------------------*/	
	/*                每學年入學博士班新生人數                   */
	public function get_DEPtype_new_p($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$DEPtype_new_p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_new_p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_new_p[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_new_p;
	}
	/*                每學年入學博士班學生最終修業狀態--在學                 */
	public function get_DEPtype_p1($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$DEPtype_p1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_p1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_p1[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_p1;
	}
	/*                每學年入學博士班學生最終修業狀態--休學                 */
	public function get_DEPtype_p4($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$DEPtype_p4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_p4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_p4[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_p4;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期中退學                 */
	public function get_DEPtype_p5($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$DEPtype_p5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_p5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_p5[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_p5;
	}
	
	/*                每學年入學博士班學生最終修業狀態--期末退學                 */
	public function get_DEPtype_p6($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$DEPtype_p6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_p6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_p6[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_p6;
	}
	
	/*                每學年入學博士班學生最終修業狀態--其它                 */
	public function get_DEPtype_po($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus <= 9 and std_studingstatus >= 7) group by std_enrollyear order by std_enrollyear");
		$DEPtype_po = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_po, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_po[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_po;
	}
	
	/*                每學年入學博士班學生最終修業狀態--畢業                 */
	public function get_DEPtype_p11($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 1 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$DEPtype_p11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_p11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_p11[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_p11;
	}
	
	/*----------------各系所碩士班加上入學管道-------------------*/	
	/*                每學年入學碩士班新生人數                   */
	public function get_DEPtype_new_m($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus != 10 group by std_enrollyear order by std_enrollyear");
		$DEPtype_new_m = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_new_m, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_new_m[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_new_m;
	}
	/*                每學年入學碩士班學生最終修業狀態--在學                 */
	public function get_DEPtype_m1($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus <= 3 group by std_enrollyear order by std_enrollyear");
		$DEPtype_m1 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_m1, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_m1[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_m1;
	}
	/*                每學年入學碩士班學生最終修業狀態--休學                 */
	public function get_DEPtype_m4($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 4 group by std_enrollyear order by std_enrollyear");
		$DEPtype_m4 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_m4, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_m4[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_m4;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期中退學                 */
	public function get_DEPtype_m5($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 5 group by std_enrollyear order by std_enrollyear");
		$DEPtype_m5 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_m5, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_m5[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_m5;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--期末退學                 */
	public function get_DEPtype_m6($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 6 group by std_enrollyear order by std_enrollyear");
		$DEPtype_m6 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_m6, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_m6[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_m6;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--其它                 */
	public function get_DEPtype_mo($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and (std_studingstatus >= 7 and std_studingstatus <= 9) group by std_enrollyear order by std_enrollyear");
		$DEPtype_mo = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_mo, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_mo[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_mo;
	}
	
	/*                每學年入學碩士班學生最終修業狀態--畢業                 */
	public function get_DEPtype_m11($start_year, $end_year, $academe, $dep_no, $enrolltype)
	{		
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_academyno like '$academe' and std_enrolltype like '$enrolltype' and std_depno like '$dep_no' and std_enrollyear >= $start_year and std_enrollyear <= $end_year and std_degree = 2 and std_enrolltype != 3 and (std_schoolid <= 2) and std_studingstatus = 11 group by std_enrollyear order by std_enrollyear");
		$DEPtype_m11 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($DEPtype_m11, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$DEPtype_m11[$i] = $row['num'];
				}				
			}
		}
		return $DEPtype_m11;
	}
	
	
	public function analysis_status()
	{
		$academe = Input::get('academe');
		$degree = Input::get('degree');
		$dep_no = Input::get('department');
		$enrolltype = Input::get('enrolltype');
		$enrolltype_c = $this->get_enrolltype_c($enrolltype);
		$dep_name = '';
		$related_no = 0;
		$related_name = '';
		 
		 if(isset($dep_no) && $dep_no != 0){
			$department = Departments::where('dep_no', '=', $dep_no)->first();
			$dep_name = $department->dep_name;
			$related_no = $department->related_no;
			$related_name = $department->related_name;
		}
		 
		 //$academe 學院代碼
		 //$degree 博士1 碩士2
		 //$dep_no 系所代碼
		 //$related_no 相關大學代碼 or 0
		 
		// 學年度與入學年月
		$dt = Carbon::now();
		$semesters = array();
		
		$start_year = $dt->year - 1911 - 5;
		$end_year = $dt->year - 1911;
		for ($i = $start_year ; $i <= $end_year ; $i++){
			array_push($semesters, $i);
		}
	
		
		//mssql data
		$values = array();
		$link = mssql_connect("HostMSSQL", 'IRID', 'qwer1234');
		if (!$link)
			echo('Unable to connect!');
		$result = mssql_query("SET ANSI_NULLS ON;");
		$result = mssql_query("SET ANSI_WARNINGS ON;"); 
		
		
		/* 每學年入學新生人數 */
		$new = $this->get_new($start_year, $end_year, $dep_no);
		
		if ($academe == 1){
			/*************************全  校**************************/
			/*------------------------博士班-------------------------*/
			$NCTU_new_p = $this->get_NCTU_new_p($start_year, $end_year);
			$NCTU_p1    = $this->get_NCTU_p1($start_year, $end_year);
			$NCTU_p4    = $this->get_NCTU_p4($start_year, $end_year);
			$NCTU_p5    = $this->get_NCTU_p5($start_year, $end_year);
			$NCTU_p6    = $this->get_NCTU_p6($start_year, $end_year);
			$NCTU_p11   = $this->get_NCTU_p11($start_year, $end_year);
			$NCTU_po    = $this->get_NCTU_po($start_year, $end_year);
			
			/*------------------------碩士班-------------------------*/
			$NCTU_new_m = $this->get_NCTU_new_m($start_year, $end_year);
			$NCTU_m1    = $this->get_NCTU_m1($start_year, $end_year);
			$NCTU_m4    = $this->get_NCTU_m4($start_year, $end_year);
			$NCTU_m5    = $this->get_NCTU_m5($start_year, $end_year);
			$NCTU_m6    = $this->get_NCTU_m6($start_year, $end_year);
			$NCTU_m11   = $this->get_NCTU_m11($start_year, $end_year);
			$NCTU_mo    = $this->get_NCTU_mo($start_year, $end_year);			
		}
		
		if ($degree == 3){
			/*************************各學院**************************/
			/*------------------------博士班-------------------------*/
			$ACA_new_p = $this->get_ACA_new_p($start_year, $end_year, $academe);
			$ACA_p1    = $this->get_ACA_p1($start_year, $end_year, $academe);
			$ACA_p4    = $this->get_ACA_p4($start_year, $end_year, $academe);
			$ACA_p5    = $this->get_ACA_p5($start_year, $end_year, $academe);
			$ACA_p6    = $this->get_ACA_p6($start_year, $end_year, $academe);
			$ACA_p11   = $this->get_ACA_p11($start_year, $end_year, $academe);
			$ACA_po    = $this->get_ACA_po($start_year, $end_year, $academe);
			
			/*------------------------碩士班-------------------------*/
			$ACA_new_m = $this->get_ACA_new_m($start_year, $end_year, $academe);
			$ACA_m1    = $this->get_ACA_m1($start_year, $end_year, $academe);
			$ACA_m4    = $this->get_ACA_m4($start_year, $end_year, $academe);
			$ACA_m5    = $this->get_ACA_m5($start_year, $end_year, $academe);
			$ACA_m6    = $this->get_ACA_m6($start_year, $end_year, $academe);
			$ACA_m11   = $this->get_ACA_m11($start_year, $end_year, $academe);
			$ACA_mo    = $this->get_ACA_mo($start_year, $end_year, $academe);
			
			$ACA_p1_R = array();
			$ACA_p4_R = array();
			$ACA_p5_R = array();
			$ACA_p6_R = array();
			$ACA_p11_R = array();
			$ACA_po_R = array();
			$ACA_m1_R = array();
			$ACA_m4_R = array();
			$ACA_m5_R = array();
			$ACA_m6_R = array();
			$ACA_m11_R = array();
			$ACA_mo_R = array();
			
			// 博班各種修業狀況比例
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($ACA_new_p[$i] == 0){
					array_push($ACA_p1_R, 0);
					array_push($ACA_p4_R, 0);
					array_push($ACA_p5_R, 0);
					array_push($ACA_p6_R, 0);
					array_push($ACA_p11_R, 0);
					array_push($ACA_po_R, 0);
				}
				else {
					array_push($ACA_p1_R, round($ACA_p1[$i]/$ACA_new_p[$i], 4)*100);
					array_push($ACA_p4_R, round($ACA_p4[$i]/$ACA_new_p[$i], 4)*100);
					array_push($ACA_p5_R, round($ACA_p5[$i]/$ACA_new_p[$i], 4)*100);
					array_push($ACA_p6_R, round($ACA_p6[$i]/$ACA_new_p[$i], 4)*100);
					array_push($ACA_p11_R, round($ACA_p11[$i]/$ACA_new_p[$i], 4)*100);
					array_push($ACA_po_R, round($ACA_po[$i]/$ACA_new_p[$i], 4)*100);
				}				
			}
			// 碩班各種修業狀況比例
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($ACA_new_m[$i] == 0){
					array_push($ACA_m1_R, 0);
					array_push($ACA_m4_R, 0);
					array_push($ACA_m5_R, 0);
					array_push($ACA_m6_R, 0);
					array_push($ACA_m11_R, 0);
					array_push($ACA_mo_R, 0);
				}
				else {
					array_push($ACA_m1_R, round($ACA_m1[$i]/$ACA_new_m[$i], 4)*100);
					array_push($ACA_m4_R, round($ACA_m4[$i]/$ACA_new_m[$i], 4)*100);
					array_push($ACA_m5_R, round($ACA_m5[$i]/$ACA_new_m[$i], 4)*100);
					array_push($ACA_m6_R, round($ACA_m6[$i]/$ACA_new_m[$i], 4)*100);
					array_push($ACA_m11_R, round($ACA_m11[$i]/$ACA_new_m[$i], 4)*100);
					array_push($ACA_mo_R, round($ACA_mo[$i]/$ACA_new_m[$i], 4)*100);
				}				
			}
			
		}
	
		if ($degree == 1){
			/*************************系  所**************************/
			/*------------------------博士班-------------------------*/
			$DEP_new_p = $this->get_DEP_new_p($start_year, $end_year, $academe, $dep_no);
			$DEP_p1    = $this->get_DEP_p1($start_year, $end_year, $academe, $dep_no);
			$DEP_p4    = $this->get_DEP_p4($start_year, $end_year, $academe, $dep_no);
			$DEP_p5    = $this->get_DEP_p5($start_year, $end_year, $academe, $dep_no);
			$DEP_p6    = $this->get_DEP_p6($start_year, $end_year, $academe, $dep_no);
			$DEP_p11   = $this->get_DEP_p11($start_year, $end_year, $academe, $dep_no);
			$DEP_po    = $this->get_DEP_po($start_year, $end_year, $academe, $dep_no);
			
			$DEP_p1_R = array();
			$DEP_p4_R = array();
			$DEP_p5_R = array();
			$DEP_p6_R = array();
			$DEP_p11_R = array();
			$DEP_po_R = array();
		
			// 博班各種修業狀況比例
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($DEP_new_p[$i] == 0){
					array_push($DEP_p1_R, 0);
					array_push($DEP_p4_R, 0);
					array_push($DEP_p5_R, 0);
					array_push($DEP_p6_R, 0);
					array_push($DEP_p11_R, 0);
					array_push($DEP_po_R, 0);
				}
				else {
					array_push($DEP_p1_R, round($DEP_p1[$i]/$DEP_new_p[$i], 4)*100);
					array_push($DEP_p4_R, round($DEP_p4[$i]/$DEP_new_p[$i], 4)*100);
					array_push($DEP_p5_R, round($DEP_p5[$i]/$DEP_new_p[$i], 4)*100);
					array_push($DEP_p6_R, round($DEP_p6[$i]/$DEP_new_p[$i], 4)*100);
					array_push($DEP_p11_R, round($DEP_p11[$i]/$DEP_new_p[$i], 4)*100);
					array_push($DEP_po_R, round($DEP_po[$i]/$DEP_new_p[$i], 4)*100);
				}				
			}
			
			/*******************系  所加上入學管道********************/
			/*------------------------博士班-------------------------*/
			$DEPtype_new_p = $this->get_DEPtype_new_p($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_p1    = $this->get_DEPtype_p1($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_p4    = $this->get_DEPtype_p4($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_p5    = $this->get_DEPtype_p5($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_p6    = $this->get_DEPtype_p6($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_p11   = $this->get_DEPtype_p11($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_po    = $this->get_DEPtype_po($start_year, $end_year, $academe, $dep_no, $enrolltype);
			
			$DEPtype_p1_R = array();
			$DEPtype_p4_R = array();
			$DEPtype_p5_R = array();
			$DEPtype_p6_R = array();
			$DEPtype_p11_R = array();
			$DEPtype_po_R = array();
			
			// 博班各種修業狀況比例--加上入學管道
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($DEPtype_new_p[$i] == 0){
					array_push($DEPtype_p1_R, 0);
					array_push($DEPtype_p4_R, 0);
					array_push($DEPtype_p5_R, 0);
					array_push($DEPtype_p6_R, 0);
					array_push($DEPtype_p11_R, 0);
					array_push($DEPtype_po_R, 0);
				}
				else {
					array_push($DEPtype_p1_R, round($DEPtype_p1[$i]/$DEPtype_new_p[$i], 4)*100);
					array_push($DEPtype_p4_R, round($DEPtype_p4[$i]/$DEPtype_new_p[$i], 4)*100);
					array_push($DEPtype_p5_R, round($DEPtype_p5[$i]/$DEPtype_new_p[$i], 4)*100);
					array_push($DEPtype_p6_R, round($DEPtype_p6[$i]/$DEPtype_new_p[$i], 4)*100);
					array_push($DEPtype_p11_R, round($DEPtype_p11[$i]/$DEPtype_new_p[$i], 4)*100);
					array_push($DEPtype_po_R, round($DEPtype_po[$i]/$DEPtype_new_p[$i], 4)*100);
				}				
			}
		}
		
		if ($degree == 2){
			/*************************系  所**************************/			
			/*------------------------碩士班-------------------------*/
			$DEP_new_m = $this->get_DEP_new_m($start_year, $end_year, $academe, $dep_no);
			$DEP_m1    = $this->get_DEP_m1($start_year, $end_year, $academe, $dep_no);
			$DEP_m4    = $this->get_DEP_m4($start_year, $end_year, $academe, $dep_no);
			$DEP_m5    = $this->get_DEP_m5($start_year, $end_year, $academe, $dep_no);
			$DEP_m6    = $this->get_DEP_m6($start_year, $end_year, $academe, $dep_no);
			$DEP_m11   = $this->get_DEP_m11($start_year, $end_year, $academe, $dep_no);
			$DEP_mo    = $this->get_DEP_mo($start_year, $end_year, $academe, $dep_no);
			
			$DEP_m1_R = array();
			$DEP_m4_R = array();
			$DEP_m5_R = array();
			$DEP_m6_R = array();
			$DEP_m11_R = array();
			$DEP_mo_R = array();
						
			// 碩班各種修業狀況比例
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($DEP_new_m[$i] == 0){
					array_push($DEP_m1_R, 0);
					array_push($DEP_m4_R, 0);
					array_push($DEP_m5_R, 0);
					array_push($DEP_m6_R, 0);
					array_push($DEP_m11_R, 0);
					array_push($DEP_mo_R, 0);
				}
				else {
					array_push($DEP_m1_R, round($DEP_m1[$i]/$DEP_new_m[$i], 4)*100);
					array_push($DEP_m4_R, round($DEP_m4[$i]/$DEP_new_m[$i], 4)*100);
					array_push($DEP_m5_R, round($DEP_m5[$i]/$DEP_new_m[$i], 4)*100);
					array_push($DEP_m6_R, round($DEP_m6[$i]/$DEP_new_m[$i], 4)*100);
					array_push($DEP_m11_R, round($DEP_m11[$i]/$DEP_new_m[$i], 4)*100);
					array_push($DEP_mo_R, round($DEP_mo[$i]/$DEP_new_m[$i], 4)*100);
				}				
			}
			
			/*******************系  所加上入學管道********************/			
			/*------------------------碩士班-------------------------*/
			$DEPtype_new_m = $this->get_DEPtype_new_m($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_m1    = $this->get_DEPtype_m1($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_m4    = $this->get_DEPtype_m4($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_m5    = $this->get_DEPtype_m5($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_m6    = $this->get_DEPtype_m6($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_m11   = $this->get_DEPtype_m11($start_year, $end_year, $academe, $dep_no, $enrolltype);
			$DEPtype_mo    = $this->get_DEPtype_mo($start_year, $end_year, $academe, $dep_no, $enrolltype);
						
			$DEPtype_m1_R = array();
			$DEPtype_m4_R = array();
			$DEPtype_m5_R = array();
			$DEPtype_m6_R = array();
			$DEPtype_m11_R = array();
			$DEPtype_mo_R = array();
						
			// 碩班各種修業狀況比例--加上入學管道
			for ($i = 0 ; $i <= $end_year - $start_year ; $i++){
				if ($DEPtype_new_m[$i] == 0){
					array_push($DEPtype_m1_R, 0);
					array_push($DEPtype_m4_R, 0);
					array_push($DEPtype_m5_R, 0);
					array_push($DEPtype_m6_R, 0);
					array_push($DEPtype_m11_R, 0);
					array_push($DEPtype_mo_R, 0);
				}
				else {
					array_push($DEPtype_m1_R, round($DEPtype_m1[$i]/$DEPtype_new_m[$i], 4)*100);
					array_push($DEPtype_m4_R, round($DEPtype_m4[$i]/$DEPtype_new_m[$i], 4)*100);
					array_push($DEPtype_m5_R, round($DEPtype_m5[$i]/$DEPtype_new_m[$i], 4)*100);
					array_push($DEPtype_m6_R, round($DEPtype_m6[$i]/$DEPtype_new_m[$i], 4)*100);
					array_push($DEPtype_m11_R, round($DEPtype_m11[$i]/$DEPtype_new_m[$i], 4)*100);
					array_push($DEPtype_mo_R, round($DEPtype_mo[$i]/$DEPtype_new_m[$i], 4)*100);
				}				
			}
		}
		
		return view('analysis._status', 
			compact('academe', 'degree', 'dep_no',  'semesters', 'values', 'new', 'dep_name', 'related_name', 'related_no', 
			'enrolltype', 'enrolltype_c',
			'NCTU_new_p', 'NCTU_p1', 'NCTU_p4', 'NCTU_p5', 'NCTU_p6', 'NCTU_po', 'NCTU_p11',
			'NCTU_new_m', 'NCTU_m1', 'NCTU_m4', 'NCTU_m5', 'NCTU_m6', 'NCTU_mo', 'NCTU_m11',
			'ACA_new_m', 'ACA_m1', 'ACA_m4', 'ACA_m5', 'ACA_m6', 'ACA_mo', 'ACA_m11', 'ACA_m1_R', 'ACA_m4_R', 'ACA_m5_R', 'ACA_m6_R', 'ACA_mo_R', 'ACA_m11_R', 
			'ACA_new_p', 'ACA_p1', 'ACA_p4', 'ACA_p5', 'ACA_p6', 'ACA_po', 'ACA_p11', 'ACA_p1_R', 'ACA_p4_R', 'ACA_p5_R', 'ACA_p6_R', 'ACA_po_R', 'ACA_p11_R',
			'DEP_new_m', 'DEP_m1', 'DEP_m4', 'DEP_m5', 'DEP_m6', 'DEP_mo', 'DEP_m11', 'DEP_m1_R', 'DEP_m4_R', 'DEP_m5_R', 'DEP_m6_R', 'DEP_mo_R', 'DEP_m11_R', 
			'DEP_new_p', 'DEP_p1', 'DEP_p4', 'DEP_p5', 'DEP_p6', 'DEP_po', 'DEP_p11', 'DEP_p1_R', 'DEP_p4_R', 'DEP_p5_R', 'DEP_p6_R', 'DEP_po_R', 'DEP_p11_R',
			'DEPtype_new_m', 'DEPtype_m1', 'DEPtype_m4', 'DEPtype_m5', 'DEPtype_m6', 'DEPtype_mo', 'DEPtype_m11', 'DEPtype_m1_R', 'DEPtype_m4_R', 'DEPtype_m5_R', 'DEPtype_m6_R', 'DEPtype_mo_R', 'DEPtype_m11_R', 
			'DEPtype_new_p', 'DEPtype_p1', 'DEPtype_p4', 'DEPtype_p5', 'DEPtype_p6', 'DEPtype_po', 'DEPtype_p11', 'DEPtype_p1_R', 'DEPtype_p4_R', 'DEPtype_p5_R', 'DEPtype_p6_R', 'DEPtype_po_R', 'DEPtype_p11_R'
			));
		
	}
}
