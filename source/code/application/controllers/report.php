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
			
			$survey_type_sel     = $this->input->post('survey_type');
			$survey_sel      = $this->input->post('survey');
			$faculty_sel     = $this->input->post('faculty');
			$questions_sel   = $this->input->post('question');
			
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
			$survey_sel      = $this->input->post('kind_survey');
			$faculty_sel     = $this->input->post('kind_faculty');
			
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
	
	function export_sum_survey()
	{
		if ($this->ion_auth->logged_in())
		{
		
			$this->load->model(array('survey_model','faculty_model','student_model','infor_model','survey_question_model','survey_answer_template_model', 'survey_answer_model'));
			
			// lay du lieu tren form
			$survey_type_sel                 = $this->input->post("sum_survey_type");
			$survey_sel                      = $this->input->post("sum_survey");
			$question_work_sel               = $this->input->post("q_sum_work");
			$answer_working_template_sel     = $this->input->post("a_sum_working");
			$answer_underwork_template_sel   = $this->input->post("a_sum_underwork");
			$questions_report_sel            = $this->input->post("sum_question");
			$faculty_report_sel              = $this->input->post("sum_faculty");
			
			$columns = array('A');
			$current = 'A';
			while ($current != 'ZZ')
			{
				$columns[] = ++$current;
			}
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('TK_tong_hop');
			
			// TIEU DE BAO CAO //
			
			//change the font size
 			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
			//make the font become bold 			
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells("A1:G1");
			$this->excel->getActiveSheet()->setCellValue("A1", "KẾT QUẢ KHẢO SÁT VIỆC LÀM SAU MỘT NĂM TỐT NGHIỆP");
			
			// head of table
			// nganh dao tao
			$this->excel->getActiveSheet()->mergeCells("A3:A5");
			$this->excel->getActiveSheet()->setCellValue("A3", "Ngành đào tạo");
			
			// so sinh vien can khao sat
			$this->excel->getActiveSheet()->mergeCells("B3:B5");
			$this->excel->getActiveSheet()->setCellValue("B3", "Số SV cần khảo sát");
			
			// so sinh vien da khao sat
			$this->excel->getActiveSheet()->mergeCells("C3:D3");
			$this->excel->getActiveSheet()->setCellValue("C3","Số SV đã khảo sát");
			$this->excel->getActiveSheet()->mergeCells("C4:C5");
			$this->excel->getActiveSheet()->setCellValue("C4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("D4:D5");
			$this->excel->getActiveSheet()->setCellValue("D4","Tỷ lệ");
			
			// co viec lam
			$this->excel->getActiveSheet()->mergeCells("E3:F3");
			$this->excel->getActiveSheet()->setCellValue("E3","Có việc làm");
			$this->excel->getActiveSheet()->mergeCells("E4:E5");
			$this->excel->getActiveSheet()->setCellValue("E4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("F4:F5");
			$this->excel->getActiveSheet()->setCellValue("F4","Tỷ lệ");

			// chua co viec lam
			$this->excel->getActiveSheet()->mergeCells("G3:H3");
			$this->excel->getActiveSheet()->setCellValue("G3","Chưa có việc làm");
			$this->excel->getActiveSheet()->mergeCells("G4:G5");
			$this->excel->getActiveSheet()->setCellValue("G4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("H4:H5");
			$this->excel->getActiveSheet()->setCellValue("H4","Tỷ lệ");
			
			// cac cau hoi da lua chon ket xuat data
			if (!empty($questions_report_sel))
			{
				// start In tieu de bao cao
				$start_column = 8;
				foreach($questions_report_sel as $question_item)
				{
					$question = $this->survey_question_model->get_question($question_item);
					$answer_template = $this->survey_answer_template_model->get($question['question_id']);
					
					// noi dung cau hoi
					$end_column = $question['max_option'] * 2;
					$this->excel->getActiveSheet()->mergeCells(''.$columns[$start_column].'3:'.$columns[$end_column+$start_column+1].'3');
					$this->excel->getActiveSheet()->setCellValue(''.$columns[$start_column].'3', $question['content']);
					
					// so sinh vien tra loi
					$this->excel->getActiveSheet()->mergeCells($columns[$start_column]."4:".$columns[$start_column+1]."4");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column]."4","Số SV trả lời");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column]."5","Số lượng");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column+1]."5","Tỷ lệ");
					
					// answer template
					$count_answer = 0;
					for ($i=$start_column+2,$j=$start_column+$end_column+2; $i<$j; $i=$i+2)
					{
						$this->excel->getActiveSheet()->mergeCells(''.$columns[$i].'4:'.$columns[$i+1].'4');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'4', $answer_template[$count_answer]['label']);
						
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'5', 'Số lượng');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i+1].'5', 'Tỉ lệ %');
						
						$count_answer += 1;
					}
					$start_column = $start_column+$end_column+2;
				}
				// end In tieu de bao cao
			}
			
			// Dua lieu [Nganh dao tao], [So SV can KS], [Co viec lam], [Chua co viec lam]
			if (!empty($faculty_report_sel))
			{
				$start_rows = 6;
				foreach ($faculty_report_sel as $faculty_item)
				{	
					// dua ten nganh vao cot A
					$faculty_data = $this->faculty_model->get($faculty_item);
					$this->excel->getActiveSheet()->setCellValue("A".$start_rows, $faculty_data['faculty_name']);
					
					// Tong so sinh vien can khao sat
					$student_survey = $this->student_model->count_student_survey($survey_sel, $faculty_item);
					$this->excel->getActiveSheet()->setCellValue('B'.$start_rows, $student_survey['sum_student']);
					
					// So sinh vien khao sat duoc
					$student_surveyed = $this->infor_model->gets_of_faculty($faculty_item,$survey_sel);
					$this->excel->getActiveSheet()->setCellValue('C'.$start_rows, count($student_surveyed));
					
					if ($student_survey['sum_student']>0)
					{
						$this->excel->getActiveSheet()->setCellValue('D'.$start_rows, '=C'.$start_rows.'*100/B'.$start_rows);
					}
					else
					{
						$this->excel->getActiveSheet()->setCellValue("D".$start_rows, 0);
					}
					
					// Co viec lam
					$working = $this->survey_answer_model->get_student_of_answer($faculty_item, $question_work_sel, $answer_working_template_sel);
					$this->excel->getActiveSheet()->setCellValue("E".$start_rows, count($working));
					if (count($student_surveyed)>0)
					{
						$this->excel->getActiveSheet()->setCellValue("F".$start_rows,"=E".$start_rows."*100/C".$start_rows);
					}
					else
					{
						$this->excel->getActiveSheet()->setCellValue("F".$start_rows,0);
					}
					
					// Chua co viec lam
					$underwork = $this->survey_answer_model->get_student_of_answer($faculty_item, $question_work_sel, $answer_underwork_template_sel);
					$this->excel->getActiveSheet()->setCellValue("G".$start_rows, count($underwork));
					if (count($student_surveyed)>0)
					{
						$this->excel->getActiveSheet()->setCellValue("H".$start_rows,"=G".$start_rows."*100/C".$start_rows);
					}
					else
					{
						$this->excel->getActiveSheet()->setCellValue("H".$start_rows,0);
					}
					
					// du lieu cua cau hoi
					$start_columns = 8;
					foreach($questions_report_sel as $question_item)
					{
						$question = $this->survey_question_model->get_question($question_item);
						$answer_template = $this->survey_answer_template_model->get($question['question_id']);
					
						// noi dung cau hoi
						$end_columns = $question['max_option'] * 2;
						
						// so sinh vien tra loi
						$sum_student = $this->survey_answer_model->count_fsurvey_of_question($faculty_item, $question_item);
						$this->excel->getActiveSheet()->setCellValue($columns[$start_columns].$start_rows,$sum_student["sum_student"]);
						if ($question["flag_working"] == TRUE && count($working)>0) // Neu co viec lam thi chia cho cot E
							$this->excel->getActiveSheet()->setCellValue($columns[$start_columns+1].$start_rows,"=".$columns[$start_columns].$start_rows."/E".$start_rows."*100");
						elseif ($question["flag_underwork"] == TRUE && count($underwork)>0) // Neu chua co viec lam thi chi cho cot G
							$this->excel->getActiveSheet()->setCellValue($columns[$start_columns+1].$start_rows,"=".$columns[$start_columns].$start_rows."/G".$start_rows."*100");
						
						$start_columns_answ = $start_columns+2;
						foreach($answer_template as $answer_template_item)
						{
							$student_answer = $this->survey_answer_model->get_student_of_answer($faculty_item, $question_item, $answer_template_item['answer_template_id']);
							$this->excel->getActiveSheet()->setCellValue($columns[$start_columns_answ].$start_rows, count($student_answer));
							if ($question["flag_working"] == TRUE && count($working)>0) 
								$this->excel->getActiveSheet()->setCellValue($columns[$start_columns_answ+1].$start_rows,"=".$columns[$start_columns_answ].$start_rows."/".$columns[$start_columns].$start_rows."*100");
							elseif ($question["flag_underwork"] == TRUE && count($underwork)>0)
								$this->excel->getActiveSheet()->setCellValue($columns[$start_columns_answ+1].$start_rows,"=".$columns[$start_columns_answ].$start_rows."/".$columns[$start_columns].$start_rows."*100");
							elseif(count($working)>0)
								$this->excel->getActiveSheet()->setCellValue($columns[$start_columns_answ+1].$start_rows,"=".$columns[$start_columns_answ].$start_rows."/E".$start_rows."*100");
							$start_columns_answ = $start_columns_answ + 2;
						}
						
						$start_columns = $start_columns + $end_columns + 2;
					} 
					
					$start_rows = $start_rows + 1;
				}
			}
			
			// ghi ra file
			$filename='tong_ket_tong_hop_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
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
	
	function export_evaluation_survey()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','faculty_model','student_model','infor_model','survey_question_model','survey_answer_template_model', 'survey_answer_model', 'survey_evaluation_model'));
			// lay du lieu tren form
			$survey_type_sel             = $this->input->post("eval_survey_type");
			$survey_sel                  = $this->input->post("eval_survey");
			$question_work_sel           = $this->input->post("q_eval_work");
			$answer_working_template_sel = $this->input->post("a_eval_working");
			$faculty_sel                 = $this->input->post("eval_faculty");
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('TK_muc_do_phu_hop');
			
			// TIEU DE BAO CAO //
			
			//change the font size
 			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
			//make the font become bold 			
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells("A1:R1");
			$this->excel->getActiveSheet()->setCellValue("A1", "MỨC ĐỘ PHÙ HỢP GIỮA CÔNG VIỆC ĐANG LÀM VỚI LĨNH VỰC ĐƯỢC ĐÀO TẠO");
			
			// head of table
			// nganh dao tao
			$this->excel->getActiveSheet()->mergeCells("A3:A5");
			$this->excel->getActiveSheet()->setCellValue("A3", "Ngành đào tạo");
			
			// so sinh vien can khao sat
			$this->excel->getActiveSheet()->mergeCells("B3:B5");
			$this->excel->getActiveSheet()->setCellValue("B3", "Số SV cần khảo sát");
			
			// so sinh vien da khao sat
			$this->excel->getActiveSheet()->mergeCells("C3:D3");
			$this->excel->getActiveSheet()->setCellValue("C3","Số SV đã khảo sát");
			$this->excel->getActiveSheet()->mergeCells("C4:C5");
			$this->excel->getActiveSheet()->setCellValue("C4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("D4:D5");
			$this->excel->getActiveSheet()->setCellValue("D4","Tỷ lệ");
			
			// co viec lam
			$this->excel->getActiveSheet()->mergeCells("E3:F3");
			$this->excel->getActiveSheet()->setCellValue("E3","Có việc làm");
			$this->excel->getActiveSheet()->mergeCells("E4:E5");
			$this->excel->getActiveSheet()->setCellValue("E4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("F4:F5");
			$this->excel->getActiveSheet()->setCellValue("F4","Tỷ lệ");

			// So sinh vien duoc danh gia
			$this->excel->getActiveSheet()->mergeCells("G3:H3");
			$this->excel->getActiveSheet()->setCellValue("G3","Số SV được đánh giá");
			$this->excel->getActiveSheet()->mergeCells("G4:G5");
			$this->excel->getActiveSheet()->setCellValue("G4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("H4:H5");
			$this->excel->getActiveSheet()->setCellValue("H4","Tỷ lệ");
			
			// Muc do phu hop giua cong viec dang lam voi.....
			$this->excel->getActiveSheet()->mergeCells("I3:R3");
			$this->excel->getActiveSheet()->setCellValue("I3","Mức độ phù hợp giữa công việc đang làm với lĩnh vực được đào tạo");
			$this->excel->getActiveSheet()->mergeCells("I4:J4");
			$this->excel->getActiveSheet()->setCellValue("I4","Mức 1");
			$this->excel->getActiveSheet()->setCellValue("I5","Số lượng");
			$this->excel->getActiveSheet()->setCellValue("J5","Tỷ lệ");
			
			$this->excel->getActiveSheet()->mergeCells("K4:L4");
			$this->excel->getActiveSheet()->setCellValue("K4","Mức 2");
			$this->excel->getActiveSheet()->setCellValue("K5","Số lượng");
			$this->excel->getActiveSheet()->setCellValue("L5","Tỷ lệ");
			
			$this->excel->getActiveSheet()->mergeCells("M4:N4");
			$this->excel->getActiveSheet()->setCellValue("M4","Mức 3");
			$this->excel->getActiveSheet()->setCellValue("M5","Số lượng");
			$this->excel->getActiveSheet()->setCellValue("N5","Tỷ lệ");

			$this->excel->getActiveSheet()->mergeCells("O4:P4");
			$this->excel->getActiveSheet()->setCellValue("O4","Mức 4");
			$this->excel->getActiveSheet()->setCellValue("O5","Số lượng");
			$this->excel->getActiveSheet()->setCellValue("G5","Tỷ lệ");

			$this->excel->getActiveSheet()->mergeCells("Q4:R4");
			$this->excel->getActiveSheet()->setCellValue("Q4","Mức 5");
			$this->excel->getActiveSheet()->setCellValue("Q5","Số lượng");
			$this->excel->getActiveSheet()->setCellValue("R5","Tỷ lệ");
			
			if (!empty($faculty_sel))
			{
				$start_rows = 6;
				foreach($faculty_sel as $faculty_item)
				{
					// dua ten nganh vao cot A
					$faculty_data = $this->faculty_model->get($faculty_item);
					$this->excel->getActiveSheet()->setCellValue("A".$start_rows, $faculty_data['faculty_name']);
					
					// Tong so sinh vien can khao sat
					$student_survey = $this->student_model->count_student_survey($survey_sel, $faculty_item);
					$this->excel->getActiveSheet()->setCellValue('B'.$start_rows, $student_survey['sum_student']);
					
					// So sinh vien khao sat duoc
					$student_surveyed = $this->infor_model->gets_of_faculty($faculty_item,$survey_sel);
					$this->excel->getActiveSheet()->setCellValue('C'.$start_rows, count($student_surveyed));
					if ($student_survey["sum_student"]>0)
						$this->excel->getActiveSheet()->setCellValue("D".$start_rows, "=C".$start_rows."/B".$start_rows."*100");
					
					// Co viec lam
					$working = $this->survey_answer_model->get_student_of_answer($faculty_item, $question_work_sel, $answer_working_template_sel);
					$this->excel->getActiveSheet()->setCellValue("E".$start_rows, count($working));
					if (count($student_surveyed)>0)
					{
						$this->excel->getActiveSheet()->setCellValue("F".$start_rows,"=E".$start_rows."*100/C".$start_rows);
					}
					
					$quantum_evaluated = $this->survey_evaluation_model->student_evaluated($survey_sel, $faculty_item);
					$this->excel->getActiveSheet()->setCellValue("G".$start_rows, $quantum_evaluated["quantum_evaluated"]);
					if (count($working)>0)
						$this->excel->getActiveSheet()->setCellValue("H".$start_rows, "=G".$start_rows."*100/E".$start_rows);
					
					// Muc 1
					$quantum_evaluated_score_1 = $this->survey_evaluation_model->student_evaluated_rate_score($survey_sel, $faculty_item, 1);
					$this->excel->getActiveSheet()->setCellValue("I".$start_rows, $quantum_evaluated_score_1["quantum_evaluated_rate_score"]); 
					// Muc 2	
					$quantum_evaluated_score_2 = $this->survey_evaluation_model->student_evaluated_rate_score($survey_sel, $faculty_item, 2);
					$this->excel->getActiveSheet()->setCellValue("K".$start_rows, $quantum_evaluated_score_2["quantum_evaluated_rate_score"]);
					// Muc 3
					$quantum_evaluated_score_3 = $this->survey_evaluation_model->student_evaluated_rate_score($survey_sel, $faculty_item, 3);
					$this->excel->getActiveSheet()->setCellValue("M".$start_rows, $quantum_evaluated_score_3["quantum_evaluated_rate_score"]);
					// Muc 4
					$quantum_evaluated_score_4 = $this->survey_evaluation_model->student_evaluated_rate_score($survey_sel, $faculty_item, 4);
					$this->excel->getActiveSheet()->setCellValue("O".$start_rows, $quantum_evaluated_score_4["quantum_evaluated_rate_score"]);
					// Muc 5
					$quantum_evaluated_score_5 = $this->survey_evaluation_model->student_evaluated_rate_score($survey_sel, $faculty_item, 5);
					$this->excel->getActiveSheet()->setCellValue("Q".$start_rows, $quantum_evaluated_score_5["quantum_evaluated_rate_score"]);
					
					if ($quantum_evaluated["quantum_evaluated"]>0)
					{
						$this->excel->getActiveSheet()->setCellValue("J".$start_rows, "=I".$start_rows."*100/G".$start_rows);
						$this->excel->getActiveSheet()->setCellValue("L".$start_rows, "=K".$start_rows."*100/G".$start_rows);
						$this->excel->getActiveSheet()->setCellValue("N".$start_rows, "=M".$start_rows."*100/G".$start_rows);
						$this->excel->getActiveSheet()->setCellValue("P".$start_rows, "=O".$start_rows."*100/G".$start_rows);
						$this->excel->getActiveSheet()->setCellValue("R".$start_rows, "=Q".$start_rows."*100/G".$start_rows);
					}
					
					$start_rows = $start_rows + 1;
				}
			}
			
			// ghi ra file
			$filename='tong_ket_muc_do_phu_hop_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
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
	
	function survey_summary()
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
			$this->load->view('report/summary',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect("auth");
		}
	}
	
	function export_summary()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','faculty_model','student_model','infor_model','survey_question_model','survey_answer_template_model', 'survey_answer_model'));
			
			// Lay thong tin tren input
			$survey_type_sel                 = $this->input->post("survey_type");
			$survey_sel                      = $this->input->post("survey");
			$question_work_sel               = $this->input->post("q_sum_work");
			$answer_working_template_sel     = $this->input->post("a_sum_working");
			$answer_underwork_template_sel   = $this->input->post("a_sum_underwork");
			$questions_report_sel            = $this->input->post("sum_question");
			$time_active_sel                 = $this->input->post("time_active"); // Thoi diem tong ket, co chua survey_id
			
			$columns = array('A');
			$current = 'A';
			while ($current != 'ZZ')
			{
				$columns[] = ++$current;
			}
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('TK_tong_hop_cac_nam');
			
			// TIEU DE BAO CAO //
			
			//change the font size
 			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
			//make the font become bold 			
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells("A1:G1");
			$this->excel->getActiveSheet()->setCellValue("A1", "");
			
			// head of table
			// STT
			$this->excel->getActiveSheet()->mergeCells("A3:A5");
			$this->excel->getActiveSheet()->setCellValue("A3","STT");
			
			// Thoi diem thuc hien
			$this->excel->getActiveSheet()->mergeCells("B3:B5");
			$this->excel->getActiveSheet()->setCellValue("B3", "Thời điểm thực hiện");
			
			// so sinh vien can khao sat
			$this->excel->getActiveSheet()->mergeCells("C3:C5");
			$this->excel->getActiveSheet()->setCellValue("C3", "Số SV cần khảo sát");
			
			// so sinh vien da khao sat
			$this->excel->getActiveSheet()->mergeCells("D3:E3");
			$this->excel->getActiveSheet()->setCellValue("D3","Số SV đã khảo sát");
			$this->excel->getActiveSheet()->mergeCells("D4:D5");
			$this->excel->getActiveSheet()->setCellValue("D4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("E4:E5");
			$this->excel->getActiveSheet()->setCellValue("E4","Tỷ lệ");
			
			// co viec lam
			$this->excel->getActiveSheet()->mergeCells("F3:G3");
			$this->excel->getActiveSheet()->setCellValue("F3","Có việc làm");
			$this->excel->getActiveSheet()->mergeCells("F4:F5");
			$this->excel->getActiveSheet()->setCellValue("F4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("G4:G5");
			$this->excel->getActiveSheet()->setCellValue("G4","Tỷ lệ");

			// chua co viec lam
			$this->excel->getActiveSheet()->mergeCells("H3:I3");
			$this->excel->getActiveSheet()->setCellValue("H3","Chưa có việc làm");
			$this->excel->getActiveSheet()->mergeCells("H4:H5");
			$this->excel->getActiveSheet()->setCellValue("H4","Số lượng");
			$this->excel->getActiveSheet()->mergeCells("I4:I5");
			$this->excel->getActiveSheet()->setCellValue("I4","Tỷ lệ");
			
			if (!empty($questions_report_sel))
			{
				// start In tieu de bao cao
				$start_column = 9;
				foreach($questions_report_sel as $question_item)
				{
					$question = $this->survey_question_model->get_question($question_item);
					$answer_template = $this->survey_answer_template_model->get($question['question_id']);
					
					// noi dung cau hoi
					$end_column = $question['max_option'] * 2;
					$this->excel->getActiveSheet()->mergeCells(''.$columns[$start_column].'3:'.$columns[$end_column+$start_column+1].'3');
					$this->excel->getActiveSheet()->setCellValue(''.$columns[$start_column].'3', $question['content']);
					
					// so sinh vien tra loi
					$this->excel->getActiveSheet()->mergeCells($columns[$start_column]."4:".$columns[$start_column+1]."4");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column]."4","Số SV trả lời");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column]."5","Số lượng");
					$this->excel->getActiveSheet()->setCellValue($columns[$start_column+1]."5","Tỷ lệ");
					
					// answer template
					$count_answer = 0;
					for ($i=$start_column+2,$j=$start_column+$end_column+2; $i<$j; $i=$i+2)
					{
						$this->excel->getActiveSheet()->mergeCells(''.$columns[$i].'4:'.$columns[$i+1].'4');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'4', $answer_template[$count_answer]['label']);
						
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i].'5', 'Số lượng');
						$this->excel->getActiveSheet()->setCellValue(''.$columns[$i+1].'5', 'Tỉ lệ %');
						
						$count_answer += 1;
					}
					$start_column = $start_column+$end_column+2;
				}
				// end In tieu de bao cao
			}
			
			// Dua du lieu vao bang excel
			if (!empty($time_active_sel))
			{
				$start_row = 6;
				$start_column = 9;
				$serial_num = 1;
				foreach ($time_active_sel as $time_active)
				{
					// Ghi so thu tu ra excel
					$this->excel->getActiveSheet()->setCellValue("A".$start_row, $serial_num);
					
					$data_time_active = $this->survey_model->get_date_of_survey($time_active);
					$name_of_time_active = "T".$data_time_active["created_on_month"]."/".$data_time_active["created_on_year"]."(K".$data_time_active["course"].")";
					// Ghi ten phieu khao sat vao excel
					$this->excel->getActiveSheet()->setCellValue("B".$start_row,$name_of_time_active);
					
					// So sinh vien can khao sat cua phieu
					$data_count_student = $this->student_model->count_student_survey($time_active,FALSE);
					$this->excel->getActiveSheet()->setCellValue("C".$start_row,$data_count_student["sum_student"]);
					
					// So sinh vien da khao sat cua phieu
					$data_count_student_surveyed = $this->student_model->count_student_surveyed($time_active,FALSE);
					$this->excel->getActiveSheet()->setCellValue("D".$start_row,$data_count_student_surveyed["sum_student_surveyed"]);
					$this->excel->getActiveSheet()->setCellValue("E".$start_row,"=D".$start_row."*100/C".$start_row);
					
					// Lay cau hoi tuong ung cau hoi co viec lam mau
					$data_question_work = $this->survey_model->get_like_question($survey_type_sel, $time_active, $question_work_sel);
					$working = 0;
					$underwork = 0;
					if (!empty($data_question_work))
					{
						// Lay cau tra loi cung loai voi cau tra loi Co
						$data_answer_working_template = $this->survey_model->get_like_answer($data_question_work["question_id"],$answer_working_template_sel);
						// Lay cau tra loi cung loai voi cau tra loi Khong
						$data_answer_underwork_template = $this->survey_model->get_like_answer($data_question_work["question_id"],$answer_underwork_template_sel);
						
						// Dem so sinh vien tra loi Co
						$count_answer_working = $this->survey_answer_model->count_student_answer($data_answer_working_template["answer_template_id"]);
						$this->excel->getActiveSheet()->setCellValue("F".$start_row,$count_answer_working["sum_answer"]);
						// Tinh ty le %
						$this->excel->getActiveSheet()->setCellValue("G".$start_row,"=F".$start_row."*100/D".$start_row);
						
						// Dem so sinh vien tra loi Khong
						$count_answer_underwork = $this->survey_answer_model->count_student_answer($data_answer_underwork_template["answer_template_id"]);
						$this->excel->getActiveSheet()->setCellValue("H".$start_row,$count_answer_underwork["sum_answer"]);
						// Tinh ty le %
						$this->excel->getActiveSheet()->setCellValue("I".$start_row,"=H".$start_row."*100/D".$start_row);
						
						$working = $count_answer_working["sum_answer"];
						$underwork = $count_answer_underwork["sum_answer"];
					}
					
					if (!empty($questions_report_sel))
					{
						foreach ($questions_report_sel as $question_item)
						{
							// Lay cau hoi tuong ung cau hoi can ket xuat du lieu mau
							$data_question_template = $this->survey_model->get_like_question($survey_type_sel, $time_active, $question_item);
							$data_answer_template = $this->survey_answer_template_model->get($data_question_template['question_id']);
							
							//Cot ket thuc
							$end_column = $data_question_template['max_option'] * 2;
							if (!empty($data_question_template))
							{
								// Lay so nguoi tra loi cau hoi
								$count_answer_question = $this->survey_answer_model->count_student_question($data_question_template["question_id"]);
								$this->excel->getActiveSheet()->setCellValue($columns[$start_column].$start_row, $count_answer_question["sum_student"]);
								// Tinh ty le
								if ($data_question_template["flag_working"] == TRUE && $working > 0)
								{
									$this->excel->getActiveSheet()->setCellValue($columns[$start_column+1].$start_row, "=".$columns[$start_column].$start_row."*100/F".$start_row);
								}
								elseif($data_question_template["flag_underwork"] == TRUE && $underwork > 0)
								{
									$this->excel->getActiveSheet()->setCellValue($columns[$start_column+1].$start_row, "=".$columns[$start_column].$start_row."*100/H".$start_row);
								}
								
								$start_column_answer_template = $start_column + 2;
								foreach ($data_answer_template as $data_answer_template_item)
								{
									$data_like_answer_template = $this->survey_model->get_like_answer($data_question_template["question_id"],$data_answer_template_item["answer_template_id"]);
									$count_answer = $this->survey_answer_model->count_student_answer($data_like_answer_template["answer_template_id"]);
									// So luong sinh vien
									$this->excel->getActiveSheet()->setCellValue($columns[$start_column_answer_template].$start_row,$count_answer["sum_answer"]);
									// Tinh ty le
									$this->excel->getActiveSheet()->setCellValue($columns[$start_column_answer_template+1].$start_row,"=".$columns[$start_column_answer_template].$start_row."*100/".$columns[$start_column].$start_row);
									
									$start_column_answer_template = $start_column_answer_template + 2;
								}
							}
							$start_column = $start_column + $end_column + 2;
						}
					}
					
					// Tang so thu tu
					$serial_num = $serial_num + 1;
					$start_row = $start_row + 1;
				}
			}
			
			// ghi ra file
			$filename='tong_ket_tong_hop_theo_nam_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
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
	
	// ham tra ve tong so sinh vien can khao sat theo phieu khao sat
	function get_sum_student_survey ($survey_id)
	{
		$this->load->model('student_model');
		$data['sum_student_survey']   = $this->student_model->count_student_survey($survey_id, FALSE);
		$data['sum_student_surveyed'] = $this->student_model->count_student_surveyed($survey_id, FALSE);
		
		echo json_encode($data);
	}
	
	// ham tra ve sinh vien da khao sat, chua khao sat theo khoa
	function get_sum_student_faculty_survey()
	{
		$this->load->model(array('survey_model','student_model','infor_model','faculty_model','survey_faculty_model'));
		
		$survey_id = $_REQUEST["survey_id"];
		
		// danh sach cac khoa them gia phieu khao sat
		$faculties = $this->survey_faculty_model->get($survey_id);
		
		$data["faculties"] = array();
		$data["not_yet_survey"] = array();
		$data["surveyed"] = array();
		if (!empty($faculties))
		{
			foreach ($faculties as $faculty)
			{
				array_push($data["faculties"], $faculty["faculty_name"]);
				
				$surveyed = $this->student_model->count_student_surveyed($survey_id, $faculty["faculty_id"]);
				array_push($data["surveyed"], $surveyed["sum_student_surveyed"]);
				
				$student_survey = $this->student_model->count_student_survey($survey_id, $faculty["faculty_id"]);
				array_push($data["not_yet_survey"], $student_survey["sum_student"] - $surveyed["sum_student_surveyed"]);
			}
		}
		
		echo json_encode($data);
	}
	
	// ham tra ve danh sach cac phieu khao sat co nam nho hon hoac bang phieu khao sat lay 
	function get_survey_of_year()
	{
		$this->load->model('survey_model');
		
		$survey_id = $_REQUEST["survey_id"];
		
		$survey_date = $this->survey_model->get_date_of_survey($survey_id);
		$data["year_summary"] = $this->survey_model->get_survey_less_than_year($survey_date["created_on_year"]);
		
		echo json_encode($data);
	}
}