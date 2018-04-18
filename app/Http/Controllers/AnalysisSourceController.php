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

class AnalysisSourceController extends Controller
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
		$enrolltype=Input::get('enrolltype');
		$degree=Input::get('degree');
		switch ($enrolltype){
			case 1:
				$enrolltype_c = '考試入學-一般生';
			case 2:
				$enrolltype_c = '考試入學-在職生';
			case 4:
				$enrolltype_c = '甄試入學-一般生';
			case 5:
				$enrolltype_c = '甄試入學-在職生';
			case 6:
				$enrolltype_c = '僑生';
			case 7:
				$enrolltype_c = '外籍生';
			case 8:
				$enrolltype_c = '大學逕博';
			case 9:
				$enrolltype_c = '碩士逕博';
			case 17:
				$enrolltype_c = '陸生';
		}
	
		return Response::json(array('enrolltype'=>$enrolltype, 'enrolltype_c'=>$enrolltype_c));
	}
	
	public function get_new($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數 */
		$newstd_result = mssql_query("SELECT std_enrollyear, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");
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
	
	/*------------------------博士班-------------------------*/	
	public function get_p_new_exam($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-考試入學 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$p_new_exam = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_exam, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
					$p_new_exam[$i] = $p_new_exam[$i] + $row['num'];
				}				
			}
		}
		return $p_new_exam;
	}
	public function get_p_new_reco($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-甄試入學 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10  and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$p_new_reco = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_reco, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
					$p_new_reco[$i] = $p_new_reco[$i] + $row['num'];
				}				
			}
		}
		return $p_new_reco;
	}
	public function get_p_new_m2p($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-碩士逕博 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10  and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$p_new_m2p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_m2p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && $row['std_enrolltype'] == 9){
					$p_new_m2p[$i] = $p_new_m2p[$i] + $row['num'];
				}				
			}
		}
		return $p_new_m2p;
	}
	public function get_p_new_u2p($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-學士逕博 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$p_new_u2p = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_u2p, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && $row['std_enrolltype'] == 8){
					$p_new_u2p[$i] = $p_new_u2p[$i] + $row['num'];
				}				
			}
		}
		return $p_new_u2p;
	}
	public function get_p_new_nctuM2P($start_year, $end_year, $dep_no)
	{
		/* 交大碩士生繼續博士人數 */
		$newstd_result = mssql_query("SELECT A.[std_enrollyear],count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_depno like '$dep_no' and A.std_enrollyear >= $start_year and A.std_schoolid <= 2 and B.std_degree = 2 and A.std_studingstatus != 10 and (B.std_gyear = A.std_enrollyear or B.std_gyear = (A.std_enrollyear - 1)) group by A.std_enrollyear order by A.std_enrollyear");
		$p_new_nctuM2P = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_nctuM2P, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$p_new_nctuM2P[$i] = $p_new_nctuM2P[$i] + $row['num'];
				}				
			}
		}
		return $p_new_nctuM2P;
	}
	public function get_p_new_4U($start_year, $end_year, $dep_no)
	{
		/* 前一學歷為台成清交學生 */
		$newstd_result = mssql_query("SELECT std_enrollyear ,count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= 101 and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10 and (std_highestschname like '國立交通大學' or std_highestschname like '交通大學' or std_highestschname like '國立清華大學' or std_highestschname like '國立成功大學' or std_highestschname like '國立臺灣大學' or std_highestschname like '清華大學') and std_enrolltype != 8 and std_enrolltype != 9 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");
		$p_new_4U = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_4U, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$p_new_4U[$i] = $p_new_4U[$i] + $row['num'];
				}				
			}
		}
		return $p_new_4U;
	}
	public function get_p_new_nctuU($start_year, $end_year, $dep_no)
	{
		/* 大學為交大學生(科系不拘) */
		$newstd_result = mssql_query("SELECT A.std_enrollyear ,count(distinct(A.[std_stdno])) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= 101 and A.std_depno like '$dep_no' and A.std_sex is not null and A.std_studingstatus != 10 and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear order by A.std_enrollyear");
		$p_new_nctuU = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_nctuU, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$p_new_nctuU[$i] = $p_new_nctuU[$i] + $row['num'];
				}				
			}
		}
		return $p_new_nctuU;
	}
	public function get_p_new_nctuU20($start_year, $end_year, $dep_no)
	{
		/* 大學為交大且畢業總成績為全系前20% */
		$newstd_result = mssql_query("SELECT A.std_enrollyear,A.[std_stdno],B.[std_depplacingrate] FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= 101 and A.std_depno like '$dep_no' and A.std_sex is not null and A.std_studingstatus != 10 and B.std_degree = 3 and B.std_gyear is not null and B.std_depplacingrate is not null group by A.std_enrollyear,A.[std_stdno],B.[std_depplacingrate] order by A.std_enrollyear, B.[std_depplacingrate]");
		$p_new_nctuU20 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($p_new_nctuU20, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_depplacingrate'] <= 20)){
					$p_new_nctuU20[$i] = $p_new_nctuU20[$i] + 1;
				}				
			}
		}
		return $p_new_nctuU20;
	}
	/*------------------------博士班end-------------------------*/
	
	/*-------------------------碩士班----------------------------*/		
	public function get_m_new_exam($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-考試入學 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$m_new_exam = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_exam, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
					$m_new_exam[$i] = $m_new_exam[$i] + $row['num'];
				}				
			}
		}
		return $m_new_exam;
	}
	public function get_m_new_reco($start_year, $end_year, $dep_no)
	{
		/* 每學年入學新生人數-甄試入學 */
		$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype, count([std_stdno]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_depno like '$dep_no' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear");
		$m_new_reco = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_reco, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
					$m_new_reco[$i] = $m_new_reco[$i] + $row['num'];
				}				
			}
		}
		return $m_new_reco;
	}
	public function get_m_new_exam_UfromNCTU($start_year, $end_year, $dep_no)
	{
		/* 考試入學-大學自交大畢業 */
		$newstd_result = mssql_query("SELECT A.std_enrollyear ,A.std_enrolltype ,count(distinct(A.[std_stdno])) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_depno like '$dep_no' and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype order by A.std_enrollyear, A.std_enrolltype");
		$m_new_exam_UfromNCTU = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_exam_UfromNCTU, 0);
		}
		
		while($row = mssql_fetch_array($newstd_result)){
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i){
					$m_new_exam_UfromNCTU[$i] = $m_new_exam_UfromNCTU[$i] + $row['num'];
				}				
			}
		}
		return $m_new_exam_UfromNCTU;
	}
	public function get_m_new_exam_UfromNCTU_R($start_year, $end_year, $dep_no, $related_no)
	{
		/* 考試入學-大學自交大相關科系畢業 */
		$m_new_exam_UfromNCTU_R = array();
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_exam_UfromNCTU_R, 0);
		}
		if ($related_no != 0){
			$newstd_result = mssql_query("SELECT A.std_enrollyear ,A.std_enrolltype ,count(distinct(A.[std_stdno])) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_depno like '$dep_no' and B.std_depno like '$related_no' and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype order by A.std_enrollyear, A.std_enrolltype");
			
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$m_new_exam_UfromNCTU_R[$i] = $m_new_exam_UfromNCTU_R[$i] + $row['num'];
					}				
				}
			}
		}
		return $m_new_exam_UfromNCTU_R;
	}
	public function get_m_new_u2p($start_year, $end_year, $dep_no, $related_no)
	{
		/* 優秀學生--大學逕博 */
		$m_new_u2p = array();
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_u2p, 0);
		}
		if ($related_no != 0){
			$newstd_result = mssql_query("SELECT B.[std_enrollyear] ,count(distinct(A.[std_stdcode])) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_depno like '$related_no' and B.std_enrollyear >= $start_year and B.std_sex is not null and B.std_degree = 1 and B.std_enrolltype = 8 and B.std_studingstatus != 10 and A.std_degree = 3 group by B.std_enrollyear order by B.std_enrollyear");		
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$m_new_u2p[$i] = $row['num'];
					}				
				}
			}
		}
		return $m_new_u2p;
	}
	/*------------------------碩士班end-------------------------*/
	
	public function analysis_source()
	{
		$academe = Input::get('academe');
		$degree = Input::get('degree');
		$dep_no = Input::get('department');
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
		$month = $dt->month;
		if ($month <= 9){
			$semesters = array();
			array_push($semesters, $dt->year - 1911-5);
			array_push($semesters, $dt->year - 1911-4);
			array_push($semesters, $dt->year - 1911-3);
			array_push($semesters, $dt->year - 1911-2);
			array_push($semesters, $dt->year - 1911-1);
			
			$terms = array();
			array_push($terms, $dt->year -5 . "/09");
			array_push($terms, $dt->year -4 . "/09");
			array_push($terms, $dt->year -3 . "/09");
			array_push($terms, $dt->year -2 . "/09");
			array_push($terms, $dt->year -1 . "/09");
		}
		else {
			$semesters = array();
			array_push($semesters, $dt->year - 1911-5);
			array_push($semesters, $dt->year - 1911-4);
			array_push($semesters, $dt->year - 1911-3);
			array_push($semesters, $dt->year - 1911-2);
			array_push($semesters, $dt->year - 1911-1);
			array_push($semesters, $dt->year - 1911);
			
			$terms = array();
			array_push($terms, $dt->year -5 . "/09");
			array_push($terms, $dt->year -4 . "/09");
			array_push($terms, $dt->year -3 . "/09");
			array_push($terms, $dt->year -2 . "/09");
			array_push($terms, $dt->year -1 . "/09");
			array_push($terms, $dt->year . "/09");			
		}				
		
		
		//mssql data
		$values = array();
		$link = mssql_connect("HostMSSQL", 'IRID', 'qwer1234');
		if (!$link)
			echo('Unable to connect!');
		$result = mssql_query("SET ANSI_NULLS ON;");
		$result = mssql_query("SET ANSI_WARNINGS ON;"); 
		
		if ($month <= 9){
			$start_year = $dt->year - 1911 - 5;
			$end_year = $dt->year - 1911 - 1;
		}
		else{
			$start_year = $dt->year - 1911 - 5;
			$end_year = $dt->year - 1911;
		}
		
		/* 每學年入學新生人數 */
		$new = $this->get_new($start_year, $end_year, $dep_no);
		
		/*------------------------博士班-------------------------*/				
		/* 每學年入學新生人數-考試入學 */
		$p_new_exam = $this->get_p_new_exam($start_year, $end_year, $dep_no);
		/* 每學年入學新生人數-甄試入學 */
		$p_new_reco = $this->get_p_new_reco($start_year, $end_year, $dep_no);
		/* 每學年入學新生人數-碩士逕博 */
		$p_new_m2p = $this->get_p_new_m2p($start_year, $end_year, $dep_no);
		/* 每學年入學新生人數-學士逕博 */
		$p_new_u2p = $this->get_p_new_u2p($start_year, $end_year, $dep_no);
		/* 交大碩士生繼續博士人數 */
		$p_new_nctuM2P = $this->get_p_new_nctuM2P($start_year, $end_year, $dep_no);
		/* 前一學歷為台成清交學生 */
		$p_new_4U = $this->get_p_new_4U($start_year, $end_year, $dep_no);
		/* 大學為交大學生(科系不拘) */
		$p_new_nctuU = $this->get_p_new_nctuU($start_year, $end_year, $dep_no);
		/* 大學為交大且畢業總成績為全系前20% */
		$p_new_nctuU20 = $this->get_p_new_nctuU20($start_year, $end_year, $dep_no);
		
		/*-----------------------碩士班-------------------------*/		
		/* 每學年入學新生人數-考試入學 */
		$m_new_exam = $this->get_m_new_exam($start_year, $end_year, $dep_no, $related_no);
		/* 每學年入學新生人數-甄試入學 */
		$m_new_reco = $this->get_m_new_reco($start_year, $end_year, $dep_no, $related_no);
		/* 考試入學-大學自交大畢業 */
		$m_new_exam_UfromNCTU = $this->get_m_new_exam_UfromNCTU($start_year, $end_year, $dep_no, $related_no);
		/* 考試入學-大學自交大相關科系畢業 */
		$m_new_exam_UfromNCTU_R = $this->get_m_new_exam_UfromNCTU_R($start_year, $end_year, $dep_no, $related_no);

		/* 甄試入學碩士新生大學畢業自交大資工系之畢業總成績 */
		//限定第一學期入學學生
		//$newstd_result = mssql_query("SELECT A.std_enrollyear, A.std_stdno, B.[std_gplacingrate] FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_studingstatus != 10 and A.std_depno like '$dep_no' and B.std_depno like '$related_no' and A.std_enrollterm = 1 and (A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_stdno, B.std_gplacingrate order by A.std_enrollyear, B.std_gplacingrate");
		//不限定第一學期入學學生
		$newstd_result = mssql_query("SELECT A.std_enrollyear, A.std_stdno, B.[std_gplacingrate] FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_studingstatus != 10 and A.std_depno like '$dep_no' and B.std_depno like '$related_no' and (A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_stdno, B.std_gplacingrate order by A.std_enrollyear, B.std_gplacingrate");
		
		$m_new_reco_10 = array();
		$m_new_reco_1120 = array();
		$m_new_reco_2150 = array();
		$m_new_reco_51 = array();
		
		for ($y = $start_year ; $y <= $end_year ; $y++){
			array_push($m_new_reco_10, 0);
			array_push($m_new_reco_1120, 0);
			array_push($m_new_reco_2150, 0);
			array_push($m_new_reco_51, 0);
		}
		$m_new_reco_tmp = array();
		while($row = mssql_fetch_array($newstd_result)){
			array_push($m_new_reco_tmp, $row['std_gplacingrate']);
			for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
				if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_gplacingrate'] <= 10)){
					$m_new_reco_10[$i] = $m_new_reco_10[$i] + 1;
				}				
				else if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_gplacingrate'] <= 20 && $row['std_gplacingrate'] > 10)){					
					$m_new_reco_1120[$i] = $m_new_reco_1120[$i] + 1;
				}
				else if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_gplacingrate'] <= 50 && $row['std_gplacingrate'] > 20)){
					$m_new_reco_2150[$i] = $m_new_reco_2150[$i] + 1;
				}
				else if (($row['std_enrollyear'] - $start_year) == $i && ($row['std_gplacingrate'] > 50)){
					$m_new_reco_51[$i] = $m_new_reco_51[$i] + 1;
				}
			}
		}
		
		/* 優秀學生--大學逕博 */
		$m_new_u2p = $this->get_m_new_u2p($start_year, $end_year, $dep_no, $related_no);
		
		/* 計算 */
		$excellent_study20 = array();	//前20%+逕博佔當年度甄試錄取新生比率
		$excellent20 = array();	        //前20%+逕博佔當年度新生比率
		$excellent_study50 = array();	//前50%+逕博佔當年度甄試錄取新生比率
		$excellent50 = array();	        //前50%+逕博佔當年度新生比率		
		$behind_study = array(); 	    //後50%佔當年度甄試錄取新生比率
		$graduate = array();	        //畢業生留校攻讀相關科系碩士班佔當年度碩士新生比率
		
		for($i = 0 ; $i < 6 ; $i++){
				if ($m_new_reco[$i] == 0){
					$excellent_study20[$i] = 0;
					$excellent_study50[$i] = 0;
					$behind_study[$i] = 0;
				}
				else{
					$excellent_study20[$i] = round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_u2p[$i])/$m_new_reco[$i],4)*100;
					$excellent_study50[$i] = round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_u2p[$i])/$m_new_reco[$i],4)*100;
					$behind_study[$i] = round($m_new_reco_51[$i]/$m_new_reco[$i],4)*100;
				}
				if($new[$i] == 0){
					$excellent20[$i] = 0;
					$excellent50[$i] = 0;
					$graduate[$i] = 0;
				}
				else{
					$excellent20[$i] = round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_u2p[$i])/$new[$i],4)*100;
					$excellent50[$i] = round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_u2p[$i])/$new[$i],4)*100;
					$graduate[$i] = round(($m_new_exam_UfromNCTU_R[$i] + $m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_reco_51[$i] + $m_new_u2p[$i])/$new[$i],4)*100;
				}
		}
		
		/* ------------------全校----------------- */
		if($academe == 1){
			$NCTU_new_m = array();
			$NCTU_new_m_exam = array(); //碩士--考試入學
			$NCTU_new_m_reco = array(); //碩士--甄試入學
			$NCTU_new_m_exam_fromN = array(); //碩士--考試入學且交大畢業
			$NCTU_new_m_reco_fromN = array(); //碩士--甄試入學且交大畢業
			$NCTU_new_m_exam_from3 = array(); //碩士--考試入學--台成清
			$NCTU_new_m_reco_from3 = array(); //碩士--甄試入學--台成清
			$NCTU_new_m_fromN_pre50 = array(); //碩士--交大畢業且畢業成績前50%
			
			$NCTU_new_p = array();
			$NCTU_new_p_exam = array(); //博士--考試入學
			$NCTU_new_p_reco = array(); //博士--甄試入學
			$NCTU_new_p_u2p = array();  //博士--學士逕博
			$NCTU_new_p_m2p = array();  //博士--碩士逕博
			$NCTU_new_p_exam_fromN = array(); //博士--考試入學且交大畢業
			$NCTU_new_p_reco_fromN = array(); //博士--甄試入學且交大畢業
			$NCTU_new_p_exam_from3 = array(); //博士--考試入學--台成清
			$NCTU_new_p_reco_from3 = array(); //博士--甄試入學--台成清
			$NCTU_new_p_fromN_pre50 = array(); //博士--交大畢業且畢業成績前50%
			
			
			for ($y = $start_year ; $y <= $end_year ; $y++){
				array_push($NCTU_new_m, 0);
				array_push($NCTU_new_m_exam, 0);
				array_push($NCTU_new_m_reco, 0);
				array_push($NCTU_new_m_exam_fromN, 0);
				array_push($NCTU_new_m_reco_fromN, 0);
				array_push($NCTU_new_m_exam_from3, 0);
				array_push($NCTU_new_m_reco_from3, 0);
				array_push($NCTU_new_m_fromN_pre50, 0);
				
				array_push($NCTU_new_p, 0);
				array_push($NCTU_new_p_exam, 0);
				array_push($NCTU_new_p_reco, 0);
				array_push($NCTU_new_p_m2p, 0);
				array_push($NCTU_new_p_u2p, 0);
				array_push($NCTU_new_p_exam_fromN, 0);
				array_push($NCTU_new_p_reco_fromN, 0);
				array_push($NCTU_new_p_exam_from3, 0);
				array_push($NCTU_new_p_reco_from3, 0);
				array_push($NCTU_new_p_fromN_pre50, 0);
			}
			
			/* 碩士 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$NCTU_new_m[$i] = $row['num'];
					}				
				}
			}
			
			/* 碩士--入學管道 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,[std_enrolltype] ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_m_exam[$i] = $NCTU_new_m_exam[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_m_reco[$i] = $NCTU_new_m_reco[$i] + $row['num'];
					}
				}
			}
			
			/* 碩士--畢業學校--交大 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear, A.[std_enrolltype], count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_degree = 2 and A.std_studingstatus != 10 and A.std_sex is not null and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype order by A.std_enrollyear, A.std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_m_exam_fromN[$i] = $NCTU_new_m_exam_fromN[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_m_reco_fromN[$i] = $NCTU_new_m_reco_fromN[$i] + $row['num'];
					}					
				}
			}
			
			/* 碩士--畢業學校--台成清 */
			$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_sex is not null and std_studingstatus != 10 and (std_enrolltype = 1 or std_enrolltype = 2 or std_enrolltype = 4 or std_enrolltype = 5) and (std_highestschname like '%清華%' or std_highestschname like '%成功大學%' or std_highestschname like '%臺灣大學%' or std_highestschname like '%台灣大學%') group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_m_exam_from3[$i] = $NCTU_new_m_exam_from3[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_m_reco_from3[$i] = $NCTU_new_m_reco_from3[$i] + $row['num'];
					}					
				}
			}
			
			/* 碩士--畢業學校--交大--畢業成績前50% */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_degree = 2 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null and B.std_gplacingrate <= 50 group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$NCTU_new_m_fromN_pre50[$i] = $row['num'];
					}										
				}
			}
			
			
			/* 博士 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");		
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$NCTU_new_p[$i] = $row['num'];
					}				
				}
			}
			
			/* 博士--入學管道 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,[std_enrolltype] ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_p_exam[$i] = $NCTU_new_p_exam[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_p_reco[$i] = $NCTU_new_p_reco[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && $row['std_enrolltype'] == 8){
						$NCTU_new_p_u2p[$i] = $NCTU_new_p_u2p[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && $row['std_enrolltype'] == 9){
						$NCTU_new_p_m2p[$i] = $NCTU_new_p_m2p[$i] + $row['num'];
					}
				}
			}
			
			/* 博士--畢業學校--交大 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear, A.[std_enrolltype], count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_degree = 1 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 2 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype order by A.std_enrollyear, A.std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_p_exam_fromN[$i] = $NCTU_new_p_exam_fromN[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_p_reco_fromN[$i] = $NCTU_new_p_reco_fromN[$i] + $row['num'];
					}					
				}
			}
			
			/* 博士--畢業學校--台成清 */
			$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_sex is not null and std_studingstatus != 10 and (std_enrolltype = 1 or std_enrolltype = 2 or std_enrolltype = 4 or std_enrolltype = 5) and (std_highestschname like '%清華%' or std_highestschname like '%成功大學%' or std_highestschname like '%臺灣大學%' or std_highestschname like '%台灣大學%') group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$NCTU_new_p_exam_from3[$i] = $NCTU_new_p_exam_from3[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$NCTU_new_p_reco_from3[$i] = $NCTU_new_p_reco_from3[$i] + $row['num'];
					}					
				}
			}
			
			/* 博士--畢業學校--交大--畢業成績前50% */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_degree = 1 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 2 and B.std_gyear is not null and B.std_gplacingrate <= 50 group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$NCTU_new_p_fromN_pre50[$i] = $row['num'];
					}										
				}
			}
		}	
			
			/* ------------------各學院----------------- */
		if($degree == 3){
			$ACA_new_m = array();
			$ACA_new_m_exam = array(); //碩士--考試入學
			$ACA_new_m_reco = array(); //碩士--甄試入學
			$ACA_new_m_exam_fromS = array(); //碩士--考試入學且交大相同學院畢業
			$ACA_new_m_exam_fromD = array(); //碩士--考試入學且交大不同學院畢業
			$ACA_new_m_exam_from3 = array(); //碩士--考試入學--台成清
			$ACA_new_m_reco_fromS = array(); //碩士--甄試入學且交大相同學院畢業
			$ACA_new_m_reco_fromD = array(); //碩士--甄試入學且交大不同學院畢業
			$ACA_new_m_reco_from3 = array(); //碩士--甄試入學--台成清
			$ACA_new_m_fromS_pre50 = array(); //碩士--交大畢業且畢業成績前50%
			$ACA_U2Dm = array();
			
			$ACA_new_p = array();
			$ACA_new_p_exam = array(); //博士--考試入學
			$ACA_new_p_reco = array(); //博士--甄試入學
			$ACA_new_p_u2p = array();  //博士--學士逕博
			$ACA_new_p_m2p = array();  //博士--碩士逕博
			$ACA_new_p_exam_fromS = array(); //博士--考試入學且交大相同學院畢業
			$ACA_new_p_exam_fromD = array(); //博士--考試入學且交大不同學院畢業
			$ACA_new_p_exam_from3 = array(); //博士--考試入學--台成清
			$ACA_new_p_reco_fromS = array(); //博士--甄試入學且交大相同學院畢業
			$ACA_new_p_reco_fromD = array(); //博士--甄試入學且交大不同學院畢業
			$ACA_new_p_reco_from3 = array(); //博士--甄試入學--台成清
			$ACA_new_p_fromS_pre50 = array(); //博士--交大畢業且畢業成績前50%
			$ACA_M2Dp = array();
			
			
			for ($y = $start_year ; $y <= $end_year ; $y++){
				array_push($ACA_new_m, 0);
				array_push($ACA_new_m_exam, 0);
				array_push($ACA_new_m_reco, 0);
				array_push($ACA_new_m_exam_fromS, 0);
				array_push($ACA_new_m_exam_fromD, 0);
				array_push($ACA_new_m_reco_fromS, 0);
				array_push($ACA_new_m_reco_fromD, 0);
				array_push($ACA_new_m_exam_from3, 0);
				array_push($ACA_new_m_reco_from3, 0);
				array_push($ACA_new_m_fromS_pre50, 0);
				array_push($ACA_U2Dm, 0);
				
				array_push($ACA_new_p, 0);
				array_push($ACA_new_p_exam, 0);
				array_push($ACA_new_p_reco, 0);
				array_push($ACA_new_p_m2p, 0);
				array_push($ACA_new_p_u2p, 0);
				array_push($ACA_new_p_exam_fromS, 0);
				array_push($ACA_new_p_exam_fromD, 0);
				array_push($ACA_new_p_exam_from3, 0);
				array_push($ACA_new_p_reco_fromS, 0);
				array_push($ACA_new_p_reco_fromD, 0);
				array_push($ACA_new_p_reco_from3, 0);
				array_push($ACA_new_p_fromS_pre50, 0);
				array_push($ACA_M2Dp, 0);
			}
			
			/* 碩士 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_new_m[$i] = $row['num'];
					}				
				}
			}
			
			/* 碩士--入學管道 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,[std_enrolltype] ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$ACA_new_m_exam[$i] = $ACA_new_m_exam[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$ACA_new_m_reco[$i] = $ACA_new_m_reco[$i] + $row['num'];
					}
				}
			}
			
			/* 碩士--畢業學校--交大 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear, A.[std_enrolltype], B.[std_academyno], count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno like '$academe' and A.std_degree = 2 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype, B.[std_academyno] order by A.std_enrollyear, A.std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						if ($row['std_academyno'] == $academe){
							$ACA_new_m_exam_fromS[$i] = $ACA_new_m_exam_fromS[$i] + $row['num'];
						}
						else{
							$ACA_new_m_exam_fromD[$i] = $ACA_new_m_exam_fromD[$i] + $row['num'];
						}
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						if ($row['std_academyno'] == $academe){
							$ACA_new_m_reco_fromS[$i] = $ACA_new_m_reco_fromS[$i] + $row['num'];
						}
						else{
							$ACA_new_m_reco_fromD[$i] = $ACA_new_m_reco_fromD[$i] + $row['num'];
						}
					}					
				}
			}
			
			/* 碩士--畢業學校--台成清 */
			$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 2 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and (std_enrolltype = 1 or std_enrolltype = 2 or std_enrolltype = 4 or std_enrolltype = 5) and (std_highestschname like '%清華%' or std_highestschname like '%成功大學%' or std_highestschname like '%臺灣大學%' or std_highestschname like '%台灣大學%') group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$ACA_new_m_exam_from3[$i] = $ACA_new_m_exam_from3[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$ACA_new_m_reco_from3[$i] = $ACA_new_m_reco_from3[$i] + $row['num'];
					}					
				}
			}
			
			/* 碩士--畢業學校--交大--畢業成績前50% */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno like '$academe' and A.std_degree = 2 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null and B.std_academyno like '$academe' and B.std_gplacingrate <= 50 group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_new_m_fromS_pre50[$i] = $row['num'];
					}										
				}
			}
			
			/* 碩士--畢業學校--交大--畢業後改讀其他學院碩士 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno not like '$academe' and A.std_degree = 2 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 3 and B.std_gyear is not null and B.std_academyno like '$academe' group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_U2Dm[$i] = $row['num'];
					}										
				}
			}
			
			
			/* 博士 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear order by std_enrollyear");		
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_new_p[$i] = $row['num'];
					}				
				}
			}
			
			/* 博士--入學管道 */
			$newstd_result = mssql_query("SELECT std_enrollyear ,[std_enrolltype] ,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and std_enrolltype != 3 group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$ACA_new_p_exam[$i] = $ACA_new_p_exam[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$ACA_new_p_reco[$i] = $ACA_new_p_reco[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && $row['std_enrolltype'] == 8){
						$ACA_new_p_u2p[$i] = $ACA_new_p_u2p[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && $row['std_enrolltype'] == 9){
						$ACA_new_p_m2p[$i] = $ACA_new_p_m2p[$i] + $row['num'];
					}
				}
			}
			
			/* 博士--畢業學校--交大 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear, A.[std_enrolltype], B.[std_academyno], count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno like '$academe' and A.std_degree = 1 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 2 and B.std_gyear is not null group by A.std_enrollyear, A.std_enrolltype, B.[std_academyno] order by A.std_enrollyear, A.std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						if ($row['std_academyno'] == $academe){
							$ACA_new_p_exam_fromS[$i] = $ACA_new_p_exam_fromS[$i] + $row['num'];
						}
						else{
							$ACA_new_p_exam_fromD[$i] = $ACA_new_p_exam_fromD[$i] + $row['num'];
						}
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						if ($row['std_academyno'] == $academe){
							$ACA_new_p_reco_fromS[$i] = $ACA_new_p_reco_fromS[$i] + $row['num'];
						}
						else{
							$ACA_new_p_reco_fromD[$i] = $ACA_new_p_reco_fromD[$i] + $row['num'];
						}
					}					
				}
			}
			
			/* 博士--畢業學校--台成清 */
			$newstd_result = mssql_query("SELECT std_enrollyear, std_enrolltype,count([std_stdcode]) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] where std_enrollyear >= $start_year and std_degree = 1 and std_academyno like '$academe' and std_sex is not null and std_studingstatus != 10 and (std_enrolltype = 1 or std_enrolltype = 2 or std_enrolltype = 4 or std_enrolltype = 5) and (std_highestschname like '%清華%' or std_highestschname like '%成功大學%' or std_highestschname like '%臺灣大學%' or std_highestschname like '%台灣大學%') group by std_enrollyear, std_enrolltype order by std_enrollyear, std_enrolltype");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 1 || $row['std_enrolltype'] == 2)){
						$ACA_new_p_exam_from3[$i] = $ACA_new_p_exam_from3[$i] + $row['num'];
					}
					elseif ((($row['std_enrollyear'] - $start_year) == $i) && ($row['std_enrolltype'] == 4 || $row['std_enrolltype'] == 5)){
						$ACA_new_p_reco_from3[$i] = $ACA_new_p_reco_from3[$i] + $row['num'];
					}					
				}
			}
			
			/* 博士--畢業學校--交大--畢業成績前50% */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno like '$academe' and A.std_degree = 1 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 2 and B.std_academyno like '$academe' and B.std_gyear is not null and B.std_gplacingrate <= 50 group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_new_p_fromS_pre50[$i] = $row['num'];
					}										
				}
			}
			
			/* 博士--畢業學校--交大--畢業後改讀其他學院博士 */
			$newstd_result = mssql_query("SELECT A.std_enrollyear,count(A.std_stdno) as num FROM [SOAA].[SoAA].[dbo].[vw_bigdata_student] A left join [SOAA].[SoAA].[dbo].[vw_bigdata_student] B on A.pid3 = B.pid3 where A.std_enrollyear >= $start_year and A.std_academyno not like '$academe' and A.std_degree = 1 and A.std_sex is not null and A.std_studingstatus != 10 and (A.std_enrolltype = 1 or A.std_enrolltype = 2 or A.std_enrolltype = 4 or A.std_enrolltype = 5) and B.std_degree = 2 and B.std_gyear is not null and B.std_academyno like '$academe' group by A.std_enrollyear order by A.std_enrollyear");
			while($row = mssql_fetch_array($newstd_result)){
				for ($i = 0 ; $i <= ($end_year - $start_year + 1) ; $i++){
					if (($row['std_enrollyear'] - $start_year) == $i){
						$ACA_M2Dp[$i] = $row['num'];
					}										
				}
			}
			
		}
		
		return view('analysis._source', 
		compact('academe', 'degree', 'dep_no',  'semesters', 'terms', 'values', 'new', 'dep_name', 'related_name', 'related_no',
		'NCTU_new_m', 'NCTU_new_p', 'NCTU_new_m_exam', 'NCTU_new_m_reco', 'NCTU_new_p_exam', 'NCTU_new_p_reco', 'NCTU_new_p_u2p', 'NCTU_new_p_m2p',
		'NCTU_new_p_reco_fromN', 'NCTU_new_p_exam_fromN', 'NCTU_new_p_reco_from3', 'NCTU_new_p_exam_from3', 'NCTU_new_p_fromN_pre50',
		'NCTU_new_m_reco_fromN', 'NCTU_new_m_exam_fromN', 'NCTU_new_m_reco_from3', 'NCTU_new_m_exam_from3', 'NCTU_new_m_fromN_pre50',
		'ACA_new_m', 'ACA_new_p', 'ACA_new_m_exam', 'ACA_new_m_reco', 'ACA_new_p_exam', 'ACA_new_p_reco', 'ACA_new_p_u2p', 'ACA_new_p_m2p', 'ACA_M2Dp', 'ACA_U2Dm',
		'ACA_new_p_reco_fromS', 'ACA_new_p_reco_fromD', 'ACA_new_p_reco_from3', 'ACA_new_p_exam_fromS', 'ACA_new_p_exam_fromD', 'ACA_new_p_exam_from3', 'ACA_new_p_fromS_pre50',
		'ACA_new_m_reco_fromS', 'ACA_new_m_reco_fromD', 'ACA_new_m_reco_from3', 'ACA_new_m_exam_fromS', 'ACA_new_m_exam_fromD', 'ACA_new_m_exam_from3', 'ACA_new_m_fromS_pre50',
		'p_new_exam', 'p_new_reco', 'p_new_m2p', 'p_new_u2p', 'p_new_nctuM2P', 'p_new_4U' ,'p_new_nctuU', 'p_new_nctuU20',
		'm_new_exam', 'm_new_reco', 'm_new_exam_UfromNCTU', 'm_new_exam_UfromNCTU_R', 'm_new_reco_10', 'm_new_reco_1120', 'm_new_reco_2150', 'm_new_reco_51', 'm_new_u2p', 'm_new_reco_tmp',
		'excellent_study20', 'excellent20','excellent_study50', 'excellent50', 'behind_study', 'graduate'));
		
	}
}
