<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ApplyReq;
use App\Report;
use App\Form_column;
use App\Apply;
use Log;
use PHPExcel;
use PHPExcel_Writer_Excel5;
use PHPExcel_Writer_HTML;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;

class ApplyController extends Controller
{
    //
	public function myApply()
	{
//                $user = User::findOrFail(Auth::id());
//                $form = Apply::where(function ( $query ) use ($user){
//                       $query->where('user_id', '=', $user->id);
//				})->paginate(15);
				$apply = Apply::all();

                return view('apply.myApply', compact('apply'));
	}
	public function create()
	{
			$form2_block1_sub1 = Form_column::where('form', '=', '2')->where('block', '=', '1')->where('sub_block', '=', '1')->orderBy('index')->get();
			$form2_block2_sub1 = Form_column::where('form', '=', '2')->where('block', '=', '2')->where('sub_block', '=', '1')->orderBy('index')->get();
			$form2_block2_sub2 = Form_column::where('form', '=', '2')->where('block', '=', '2')->where('sub_block', '=', '2')->orderBy('index')->get();
			$form2_block2_sub3 = Form_column::where('form', '=', '2')->where('block', '=', '2')->where('sub_block', '=', '3')->orderBy('index')->get();
			
			$form3_block2_sub1 = Form_column::where('form', '=', '3')->where('block', '=', '2')->where('sub_block', '=', '1')->orderBy('index')->get();
			$form3_block3_sub1 = Form_column::where('form', '=', '3')->where('block', '=', '3')->where('sub_block', '=', '1')->orderBy('index')->get();
			$form3_block1_sub1 = Form_column::where('form', '=', '3')->where('block', '=', '1')->where('sub_block', '=', '1')->orderBy('index')->get();
			$form3_block1_sub2[] = array();
			for($i=0; $i<14; $i++)
				$form3_block1_sub2[$i] = Form_column::where('form', '=', '3')->where('block', '=', '1')->where('sub_block', '=', $i+12)->orderBy('index')->get();
			
			return view('apply.create', compact('apply', 'form2_block1_sub1', 'form2_block2_sub1', 'form2_block2_sub2', 'form2_block2_sub3',
																'form3_block2_sub1', 'form3_block3_sub1', 'form3_block1_sub1', 'form3_block1_sub2'))->with('CtorEd', 'create');
	}
	public function store(ApplyReq $request)
	{
			if($request->type == '0'){
				$apply = Apply::create(array('user_id' => '', 'type' => $request->type, 'department' => $request->department, 'apply_date' => $request->apply_date, 'name' => $request->name,  'phone' => $request->phone,
				'email' => $request->email, 'purpose' => $request->purpose, 'form1_need' => $request->form1_need, 'way' => $request->way, 'ip' => $request->ip, 'account' => $request->account,
				'password' => $request->password, 'location' => $request->location,
				'form2_need' => '-1', 'form2_need_other' => '', 'form2_filter_enter' => '-1', 'form2_filter_id' => '-1', 'form2_filter_status' => '-1',
				'form3_need' => '-1', 'form3_sub_0' =>' -1', 'form3_sub_1' =>' -1', 'form3_sub_2' =>' -1', 'form3_sub_3' =>' -1', 'form3_sub_4' =>' -1', 'form3_sub_5' =>' -1',
				'form3_sub_6' =>' -1', 'form3_sub_7' =>' -1', 'form3_sub_8' =>' -1', 'form3_sub_9' =>' -1', 'form3_sub_10' =>' -1', 'form3_sub_11' =>' -1', 'form3_sub_12' =>' -1', 'form3_sub_13' =>' -1',
				'form3_filter_no' => '-1', 'form3_filter_department' => '', 'form3_filter_title' => '', 'form3_filter_start' => '', 'form3_filter_end' => '', 'form3_filter_program' => '', 'form3_filter_financial' => '', 'form3_personal' => '-1'));
				
				$apply -> save();
			}
			else if($request->type == '1'){
				$apply = Apply::create(array('user_id' => '', 'type' => $request->type, 'department' => $request->department, 'apply_date' => $request->apply_date, 'name' => $request->name,  'phone' => $request->phone,
				'email' => $request->email, 'purpose' => $request->purpose, 'form1_need' => $request->form1_need, 'way' => '0', 'ip' => $request->ip, 'account' => $request->account,
				'password' => $request->password, 'location' => $request->location,
				'form2_need_other' => $request->form2_need_other, 'form2_filter_enter' => $request->form2_filter_enter, 'form2_filter_id' => $request->form2_filter_id, 'form2_filter_status' => $request->form2_filter_status,
				'form3_need' => '-1', 'form3_sub_0' =>' -1', 'form3_sub_1' =>' -1', 'form3_sub_2' =>' -1', 'form3_sub_3' =>' -1', 'form3_sub_4' =>' -1', 'form3_sub_5' =>' -1',
				'form3_sub_6' =>' -1', 'form3_sub_7' =>' -1', 'form3_sub_8' =>' -1', 'form3_sub_9' =>' -1', 'form3_sub_10' =>' -1', 'form3_sub_11' =>' -1', 'form3_sub_12' =>' -1', 'form3_sub_13' =>' -1',
				'form3_filter_no' => '-1', 'form3_filter_department' => '', 'form3_filter_title' => '', 'form3_filter_start' => '', 'form3_filter_end' => '', 'form3_filter_program' => '', 'form3_filter_financial' => '', 'form3_personal' => '-1'));
				
				$apply->form2_need = $this->checkbox_count($request->form2_need);
				$apply -> save();
			}
			else{
				$apply = Apply::create(array('user_id' => '', 'type' => $request->type, 'department' => $request->department, 'apply_date' => $request->apply_date, 'name' => $request->name,  'phone' => $request->phone,
				'email' => $request->email, 'purpose' => $request->purpose, 'form1_need' => $request->form1_need, 'way' => '0', 'ip' => $request->ip, 'account' => $request->account,
				'password' => $request->password, 'location' => $request->location,
				'form2_need' => '-1', 'form2_need_other' => '', 'form2_filter_enter' => '-1', 'form2_filter_id' => '-1', 'form2_filter_status' => '-1',
				'form3_filter_no' => $request->form3_filter_no, 'form3_filter_department' => $request->form3_filter_department, 'form3_filter_title' => $request->form3_filter_title, 'form3_filter_start' => $request->form3_filter_start,
				'form3_filter_end' => $request->form3_filter_end, 'form3_filter_program' => $request->form3_filter_program, 'form3_filter_financial' => $request->form3_filter_financial));
				
				$apply->form3_need = $this->checkbox_count($request->form3_need);
				$apply->form3_sub_0 = $this->checkbox_count($request->form3_sub_0);
				$apply->form3_sub_1 = $this->checkbox_count($request->form3_sub_1);
				$apply->form3_sub_2 = $this->checkbox_count($request->form3_sub_2);
				$apply->form3_sub_3 = $this->checkbox_count($request->form3_sub_3);
				$apply->form3_sub_4 = $this->checkbox_count($request->form3_sub_4);
				$apply->form3_sub_5 = $this->checkbox_count($request->form3_sub_5);
				$apply->form3_sub_6 = $this->checkbox_count($request->form3_sub_6);
				$apply->form3_sub_7 = $this->checkbox_count($request->form3_sub_7);
				$apply->form3_sub_8 = $this->checkbox_count($request->form3_sub_8);
				$apply->form3_sub_9 = $this->checkbox_count($request->form3_sub_9);
				$apply->form3_sub_10 = $this->checkbox_count($request->form3_sub_10);
				$apply->form3_sub_11 = $this->checkbox_count($request->form3_sub_11);
				$apply->form3_sub_12 = $this->checkbox_count($request->form3_sub_12);
				$apply->form3_sub_13 = $this->checkbox_count($request->form3_sub_13);
				$apply->form3_personal = $this->checkbox_count($request->form3_personal);
				$apply -> save();
			}
		
			 return redirect('myApply');
	}
	public function show($id)
	{
		$apply = Apply :: findOrFail($id);
		
//		$date = substr($form->created_at, 0, 10);
		
		$objExcel = new PHPExcel();
		
		$objExcel->getProperties()
//				 ->setCreator("Thouhedul islam")
//			     ->setLastModifiedBy("Thouhedul islam")
			     ->setTitle("國立交通大學資訊公開專區")
//			     ->setSubject("新進教師鐘點減免核對表")
//		   	     ->setDescription("This is the tutorial for PHP Excel from tisuchi.com")
//			     ->setKeywords("office PHPExcel php")
		      	 ->setCategory("Tutorial Result");
					 
		$objExcel->getActiveSheet()->getStyle('B4:S39')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objExcel->getActiveSheet()->getStyle('B4:S39')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$objExcel->getActiveSheet()->getStyle('E12:S26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objExcel->getActiveSheet()->getStyle('E12:S26')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
		$objExcel->setActiveSheetIndex(0)
			->mergeCells('F4:O6')			//title
			->mergeCells('Q7:S7')			//date
			
			->mergeCells('B9:D10')		//申請單位
			->mergeCells('E9:G10')
			
			->mergeCells('H9:K10')		//主管簽章
			->mergeCells('L9:N10')
			
			->mergeCells('O9:P9')			//申請人
			->mergeCells('Q9:S9')
			
			->mergeCells('O10:P10')		//連絡電話
			->mergeCells('Q10:S10')
			
			->mergeCells('B11:D11')		//說明
			->mergeCells('E11:S11')
			
			->mergeCells('B12:D16')		//用途
			->mergeCells('E12:S16')
			
			->mergeCells('B17:D26')		//所需項目
			->mergeCells('E17:S26')
			
			->mergeCells('B27:D30')		//方法
			->mergeCells('E27:I30')
			
			->mergeCells('J27:M27')
			->mergeCells('J28:M28')
			->mergeCells('J29:M29')
			->mergeCells('J30:M30')
			->mergeCells('N27:S27')
			->mergeCells('N28:S28')
			->mergeCells('N29:S29')
			->mergeCells('N30:S30')
			
			->mergeCells('B31:C33')		//簽章
			->mergeCells('D31:E33')
			->mergeCells('F31:G33')
			->mergeCells('H31:I33')
			->mergeCells('J31:K33')
			->mergeCells('L31:M33')
			->mergeCells('N31:O33')
			->mergeCells('P31:Q33')
			->mergeCells('R31:R33')
			->mergeCells('S31:S33')
			
			->mergeCells('B34:D39')
			->mergeCells('E34:S39');
			
		for($i=7; $i<40; $i++)
			$objExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(20);

		$objExcel->setActiveSheetIndex(0)
			->getStyle('F4:O6')->getFont()->setSize(22);
		$objExcel->setActiveSheetIndex(0)
			->setCellValue('F4', '校務系統資料使用申請表');
		$objExcel->setActiveSheetIndex(0)
			->setCellValue('B9', '申請單位')
			->setCellValue('H9', '申請單位主管簽章')
			->setCellValue('O9', '申請人')
			->setCellValue('O10', '連絡電話')
			->setCellValue('B11', '說明')
			->setCellValue('E11', '基本資料受個人資料保護法保障，請謹慎使用和保管，勿外洩而觸法。')
			->setCellValue('B12', '用途')
			->setCellValue('B17', '所需項目')
			->setCellValue('B27', '方法')
			->setCellValue('J27', 'IP')
			->setCellValue('J28', '帳號')
			->setCellValue('J29', '密碼')
			->setCellValue('J30', '存放位置')
			->setCellValue('B31', '審核人員')
			->setCellValue('F31', '審核單位主管')
			->setCellValue('J31', '資訊中心承辦人收件日')
			->setCellValue('N31', '資訊中心主管')
			->setCellValue('R31', '完成日期')
			->setCellValue('B34', '審核說明');
		
		$objExcel->setActiveSheetIndex(0)
			->setCellValue('Q7', $apply->apply_date)
			->setCellValue('E9', $apply->department)
			->setCellValue('Q9', $apply->name)
			->setCellValue('Q10', $apply->phone)
			->setCellValue('E12', $apply->purpose)
			->setCellValue('E17', $apply->form1_need)
			->setCellValue('N27', $apply->ip)
			->setCellValue('N28', $apply->account)
			->setCellValue('N29', $apply->password)
			->setCellValue('N30', $apply->location);

		if($apply->way == '0'){
			$objExcel->setActiveSheetIndex(0)	
				->setCellValue('E27', '方法一：提供資料庫檢視表');
		}
		else{
			$objExcel->setActiveSheetIndex(0)	
				->setCellValue('E27', '方法二：提供檔案下載');
		}
			
		$objExcel->setActiveSheetIndex(0)->getStyle('A1:A39')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		$objExcel->setActiveSheetIndex(0)->getStyle('B1:S8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		$objExcel->setActiveSheetIndex(0)->getStyle('B9:S39')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

		
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);
		$objWriteHTML = new PHPExcel_Writer_HTML($objExcel);

		$objWriter2 = PHPExcel_IOFactory::createWriter($objExcel, "Excel2007"); 
//		$objWriter2->save("test.xls");
	
		return view('apply.show', compact('apply', 'objWriteHTML'));
	}
	public function edit($id)
	{
//			$form = Teacher :: findOrFail($id);
//			return view('newteachers.edit', compact('form'))->with('CtorEd', 'edit');
	}
	public function update($id, TeacherReq $request)
	{
	
	}
	public function destroy($id)
	{
			$apply = Apply :: findOrFail($id);
			$apply->delete();

			return redirect('myApply');
	}
	public function checkbox_count($check)
	{
			$sum=0;
			if(is_array($check)){
				foreach($check as $value){	
					$sum += pow(2, $value);
				}
			}
			return $sum;
	}
}
