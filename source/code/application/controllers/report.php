<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Report extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', "-1");
		$this->load->library(array('ion_auth', 'form_validation', 'session', 'uuid', 'excel'));
		$this->load->helper(array('url', 'date', 'file'));
	}
	
	function survey_status()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','survey_model'));
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			$this->load->view('templates/header',$data);
			$this->load->view('report/status',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	
	function survey_export()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','survey_model'));
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			$this->load->view('templates/header',$data);
			$this->load->view('report/export',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	
	function export_quick_summary()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','faculty_model','student_model','infor_model','survey_question_model','survey_answer_template_model', 'survey_answer_model'));
			
			$columns = array('A');
			$current = 'A';
			while ($current != 'ZZ')
			{
				$columns[] = ++$current;
			}
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('bao_cao_nhanh');
			//set cell A1 content with some text
			$this->excel->getActiveSheet()->setCellValue('A3', 'Ngành đào tạo');
			//change the font size
/* 			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20); */
			//make the font become bold
/* 			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); */
			//merge cell A1 until D1
/* 			$this->excel->getActiveSheet()->mergeCells('A1:D1'); */
			//set aligment to center for that merged cell (A1 to D1)
/* 			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */
			
			//merge column
			$this->excel->getActiveSheet()->mergeCells('A3:A5');
			$this->excel->getActiveSheet()->mergeCells('B3:B5');
			$this->excel->getActiveSheet()->mergeCells('C3:D4');
			$this->excel->getActiveSheet()->mergeCells('E3:F4');
			$this->excel->getActiveSheet()->mergeCells('G3:H4');
			
			//set value to cell
			$this->excel->getActiveSheet()->setCellValue('B3','Số SV cần khảo sát');
			$this->excel->getActiveSheet()->setCellValue('C3','Số SV khảo sát được');
			$this->excel->getActiveSheet()->setCellValue('E3','Số SV chưa khảo sát được');
			$this->excel->getActiveSheet()->setCellValue('C5','Số lượng');
			$this->excel->getActiveSheet()->setCellValue('D5','Tỷ lệ %');
			$this->excel->getActiveSheet()->setCellValue('E5','Số lượng');
			$this->excel->getActiveSheet()->setCellValue('F5','Tỷ lệ %');
			$this->excel->getActiveSheet()->setCellValue('G3','Số SV có việc làm');
			$this->excel->getActiveSheet()->setCellValue('G5','Số lượng');
			$this->excel->getActiveSheet()->setCellValue('H5','Tỷ lệ %');
			
			//set column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			
			//set wrap text
			$this->excel->getActiveSheet()->getStyle('B3:B5')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getStyle('C3:D4')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getStyle('E3:F4')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getStyle('G3:H5')->getAlignment()->setWrapText(true);
			
			//Set cell style
			$this->excel->getActiveSheet()->getStyle('G3:H5')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
			
			$survey_type_sel = $this->input->post('survey_type');
			$survey_sel = $this->input->post('survey');
			$faculty_sel = $this->input->post('faculty');
			$questions_sel = $this->input->post('question');
			
			if (!empty($faculty_sel))
			{
				$start_row = 6;
				foreach($faculty_sel as $faculty_item)
				{
					$faculty_data = $this->faculty_model->get($faculty_item);
					$this->excel->getActiveSheet()->setCellValue('A'.$start_row, $faculty_data['faculty_name']);
					
					// Tong so sinh vien can khao sat
					$student_survey = $this->student_model->count_student_survey($survey_sel, $faculty_item);
					$this->excel->getActiveSheet()->setCellValue('B'.$start_row, $student_survey['sum_student']);
					
					// So sinh vien khao sat duoc
					$student_surveyed = $this->infor_model->gets_of_faculty($faculty_item,$survey_sel);
					$this->excel->getActiveSheet()->setCellValue('C'.$start_row, count($student_surveyed));
					
					if ($student_survey['sum_student']>0)
					{
						$this->excel->getActiveSheet()->setCellValue('D'.$start_row, '=C'.$start_row.'*100/B'.$start_row);
					}
					
					// So sinh vien chua khao sat duoc
					if ($student_survey['sum_student']>0)
					{
						// So luong
						$this->excel->getActiveSheet()->setCellValue('E'.$start_row, '=B'.$start_row.'-C'.$start_row);
						// Phan tram
						$this->excel->getActiveSheet()->setCellValue('F'.$start_row, '=100-D'.$start_row);
					}
					
					$start_row += 1;
				}
			}
			
			if (!empty($questions_sel))
			{
				// start In tieu de bao cao
				$start_column = 8;
				foreach($questions_sel as $question_item)
				{
					$question = $this->survey_question_model->get_question($question_item);
					$answer_template = $this->survey_answer_template_model->get($question['question_id']);
					
					// merge column
					$end_column = $question['max_option'] * 2;
					$this->excel->getActiveSheet()->mergeCells(''.$columns[$start_column].'3:'.$columns[$end_column+$start_column].'3');
					$this->excel->getActiveSheet()->mergeCells(''.$columns[$start_column].'4:'.$columns[$start_column].'5');
					// answer template
					$count_answer = 0;
					for ($i=$start_column+1,$j=$start_column+$end_column+1; $i<$j; $i=$i+2)
					{
						$this->excel->getActiveSheet()->mergeCells(''.$columns[$i].'4:'.$columns[$i+1].'4');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'4', $answer_template[$count_answer]['label']);
						
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'5', 'Số lượng');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i+1].'5', 'Tỉ lệ %');
						
						$count_answer += 1;
					}
					// set value to cell
					$this->excel->getActiveSheet()->setCellValue(''.$columns[$start_column].'3', $question['content']);
					$this->excel->getActiveSheet()->setCellValue(''.$columns[$start_column].'4', 'Tổng số SV trả lời');
					
					$start_column = $start_column+$end_column+1;
				}
				// end In tieu de bao cao
				
				// start In data bao cao
				
				if (!empty($faculty_sel))
				{
					$start_row_answer = 6;
					foreach ($faculty_sel as $faculty_item)
					{
						$start_column_answer = 8;
						
						$faculty_data     	 = $this->faculty_model->get($faculty_item);
						
						foreach($questions_sel as $question_item)
						{
							$question                    = $this->survey_question_model->get_question($question_item);
							$answer_template             = $this->survey_answer_template_model->get($question['question_id']);
							$count_student_of_question   = $this->survey_answer_model->count_fsurvey_of_question($faculty_data['faculty_id'], $question['question_id']);
							
							$end_column_answer           = $question['max_option'] * 2;
							
							$count_answer_template       = 0;
							
							$this->excel->getActiveSheet()->setCellValue($columns[$start_column_answer].$start_row_answer, $count_student_of_question['sum_student']);
							
							for ($i=$start_column_answer+1, $j=$start_column_answer+$end_column_answer; $i<=$j; $i=$i+2)
							{
								// lay danh sach sinh vien da khao sat dap ung voi mau cau tra loi
								$student_answer = $this->survey_answer_model->get_student_of_answer($faculty_data['faculty_id'], $question['question_id'], $answer_template[$count_answer_template]['answer_template_id']);
								
								$this->excel->getActiveSheet()->setCellValue($columns[$i].$start_row_answer, count($student_answer));
								
								if ($count_student_of_question['sum_student']>0)
									$this->excel->getActiveSheet()->setCellvalue($columns[$i+1].$start_row_answer, '='.$columns[$i].$start_row_answer.'*100/'.$columns[$start_column_answer].$start_row_answer);
								
								$count_answer_template+=1;
							}
							
							$start_column_answer += $end_column_answer+1;
						}
						$start_row_answer += 1;
					}
				}
				
				// end In data bao cao
				
				$filename='bao_cao_nhanh_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache

				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			}
		}
		else
		{
			redirect ('auth');
		}
	}
	
	function export_kind_survey()
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('type_model','infor_model','faculty_model'));
			
			// Lay thong tin POST
			$survey_type_sel = $this->input->post('kind_survey_type');
			$survey_sel = $this->input->post('kind_survey');
			$faculty_sel = $this->input->post('kind_faculty');
			
			$columns = array('A');
			$current = 'A';
			while ($current != 'ZZ')
			{
				$columns[] = ++$current;
			}
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('hinh_thuc_khao_sat');
			
			// TIEU DE BAO CAO //
			
			//change the font size
 			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
			//make the font become bold 			
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells("A1:G1");
			$this->excel->getActiveSheet()->setCellValue("A1", "TỶ LỆ TRẢ LỜI THEO HÌNH THỨC KHẢO SÁT");
			
			// head of table
			// STT
			$this->excel->getActiveSheet()->mergeCells("A3:A4");
			$this->excel->getActiveSheet()->setCellValue("A3", "STT");
			
			// Nganh dao tao
			$this->excel->getActiveSheet()->mergeCells("B3:B4");
			$this->excel->getActiveSheet()->setCellValue("B3", "Ngành");
			
			// In So thu tu va ten nganh dao tao
			if (!empty($faculty_sel) && $survey_sel != "")
			{
				$start_rows = 5;
				$serial_num = 1;
				foreach ($faculty_sel as $faculty_item)
				{
					// dua so tu tu vao cot A
					$this->excel->getActiveSheet()->setCellValue("A".$start_rows, $serial_num);
					
					// dua ten nganh vao cot B
					$faculty_data = $this->faculty_model->get($faculty_item);
					$this->excel->getActiveSheet()->setCellValue("B".$start_rows, $faculty_data['faculty_name']);
					
					$start_rows = $start_rows + 1;
					$serial_num = $serial_num + 1;
				}
			}
			
			// Lay danh sach cac hinh thuc khao sat
			$type_survey = $this->type_model->gets();
			
			if (!empty($type_survey))
			{
				$start_columns = 2;
				foreach ($type_survey as $type_survey_item)
				{
					// Tieu de hinh thuc khao sat tren cot
					// 2 cot la mot tieu de tren hang thu 3
					$this->excel->getActiveSheet()->mergeCells($columns[$start_columns]."3:".$columns[$start_columns+1]."3");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_columns]."3", $type_survey_item['type_name']);
					
					// so luong va ti le o hang thu 4
					$this->excel->getActiveSheet()->setCellValue($columns[$start_columns]."4", "Số lượng");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_columns+1]."4", "Tỷ lệ");
					
					if (!empty($faculty_sel) && $survey_sel != "")
					{
						$start_rows = 5;
						foreach ($faculty_sel as $faculty_item)
						{
							// in so luong
							$quantum = $this->infor_model->count_with_type($survey_sel, $type_survey_item['type_id'],$faculty_item);
							$this->excel->getActiveSheet()->setCellValue($columns[$start_columns].$start_rows, $quantum["quantum"]);
							// in ty le
							
							$total = $this->infor_model->count_with_type($survey_sel, FALSE, $faculty_item);
							if ($total["total"]>0)
								$this->excel->getActiveSheet()->setCellValue($columns[$start_columns + 1].$start_rows, $quantum["quantum"] / $total["total"] * 100);
							else
								$this->excel->getActiveSheet()->setCellValue($columns[$start_columns + 1].$start_rows, 0);
							
							$start_rows = $start_rows + 1;
						}
						$this->excel->getActiveSheet()->getStyle("B".$start_rows)->getFont()->setBold(true);
						$this->excel->getActiveSheet()->setCellValue("B".$start_rows, "Cộng");
					}
					
					// Tang cot
					$start_columns = $start_columns + 2;
				}
				// in cot tong
				$this->excel->getActiveSheet()->mergeCells($columns[$start_columns]."3:".$columns[$start_columns]."4");
				$this->excel->getActiveSheet()->getStyle($columns[$start_columns]."3")->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue($columns[$start_columns]."3", "Tổng");
			}
			
			$filename='hinh_thuc_khao_sat_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}
		else
		{
			redirect("auth");
		}
	}
	
	// AJAX Function
	// ham lay cac phieu khao sat phan theo loai khao sat
	function gets_survey($survey_type_id) 
	{
		$this->load->model('survey_model');
		$data['surveys'] = $this->survey_model->get($survey_type_id);
		
		echo json_encode($data);
	}
	
	// ham lay cac khoa tham gia phieu khao sat
	function gets_survey_faculty($survey_id)
	{
		$this->load->model('survey_faculty_model');
		$data['survey_faculties'] = $this->survey_faculty_model->get($survey_id, FALSE);
		
		echo json_encode($data);
	}
	
	// ham lay cac cau hoi co cau tra loi khong phai dang text
	function gets_question_answer_no_text($survey_id)
	{
		$this->load->model('survey_question_model');
		$data['questions'] = $this->survey_question_model->get_question_answer_no_text($survey_id);
		
		echo json_encode($data);
	}
	
	// ham lay cac cau hoi co cau tra loi khong phai dang text va chi co 2 lua chon
	function gets_question_answer_work($survey_id)
	{
		$this->load->model('survey_question_model');
		$data['question'] = $this->survey_question_model->get_question_answer_work($survey_id);
		
		echo json_encode($data);
	}
	
	// ham lay mau cau tra loi
	function gets_answer_template($question_id)
	{
		$this->load->model('survey_answer_template_model');
		$data['answer_template'] = $this->survey_answer_template_model->get($question_id);
		
		echo json_encode($data);
	}
	
	// ham lay tong so sinh vien can khao sat theo phieu khao sat
	function get_sum_student_survey ($survey_id)
	{
		$this->load->model('student_model');
		$data['sum_student_survey'] = $this->student_model->count_student_survey($survey_id, FALSE);
		$data['sum_student_surveyed'] = $this->student_model->count_student_surveyed($survey_id, FALSE);
		
		echo json_encode($data);
	}
}