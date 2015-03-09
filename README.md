SDCSurvey
=========

Ứng dụng Khảo sát sinh viên dành riêng cho Trường ĐH Văn Lang
[![Build Status](https://travis-ci.org/nguyenanhnhan/sdcsurvey.svg)](https://travis-ci.org/nguyenanhnhan/sdcsurvey)
Phiên bản 4.2.6
---------------
* Xoá thư viện Pace (bị lỗi không mở web Socket)
* Cập nhật file:
	- *application/views/***login.php**
	- *assets/css/***style.css**
	- *application/models/***student_model.php**
		+ get_student_of_faculty function
	- *application/controllers/***do_survey.php**
	- *application/models/***survey_faculty_model.php**
	- *application/views/survey_result/***index.php**
	- *application/models/***student_model.php**
		+ gets_students_infor_missing_infor_of_faculty
	- *application/views/admin***export_student.php**
	- *application/controllers/***admin.php**
	- *application/views/do_survey/***index.php**
	- *application/controllers/***do_survey.php**
* Thêm font Open Sans vào thư mục font
* Thêm field **template_link_lock** trong table **sur_design_template**
* Thêm *assets/template/design_template/***lock_graduated_student.html**

Phiên bản 4.2.5
---------------
* Thay dấu **[+]** thành chữ "Thêm phiếu khảo sát"
* Cập nhật hiển thị sai khoá học 16-20 (18-22 Sai)
* Cập nhật lại lỗi không hoạt động của các trạng thái **Đã tốt nghiệp** và **Đang khảo sát**
* Cập nhật **Lọc các dữ liệu sinh viên còn thiếu** không hoạt động

Phiên bản 4.2.4
---------------
* Cập nhật Flat UI 2.2
	+ Updated Flat UI 2.2
	+ Fixed Form button bug
	+ Fixed Tiles hover overlay bug
	+ Fixed IE9 Login screen bug
	+ Fixed IE search-input bug
	+ Fixed icon position in buttons
	+ Fixed icon position in tabs
	+ Fixed Task Modal bug
	+ Fixed label bugs
	+ Fixed easy-pie plugin bugs
	+ Fixed sparklines bug
	+ Fixed error page bugs
	+ Fixed login screen "remember me" vertical positioning
	+ Updated jQuery
	+ Updated jQuery-UI
	+ Updated PLUpload to v2
	+ Updated dataTables to new Version
	+ Updated fontAwesome
	+ Updated iCheck plugin
	+ Updated Chosen plugin
	+ Updated CKEditor plugin
	+ Updated jQuery Validation plugin
	+ Updated Colorbox plugin
	+ Updated Complexify plugin
	+ Updated Daterange plugin
	+ Updated easy-pie-charts plugin
	+ Updated fullcalendar plugin
	+ Updated imagesloaded plugin
	+ Updated masonry plugin
	+ Updated multi-select plugin
	+ Updated select2 plugin
	+ Updated changes in documentation
	+ Changed input form color to match with textarea/select
* Xoá plugin Pace
* Sửa lỗi Edit Step 2 (Calendar)
* Sửa lỗi Edit Question (UI)
* Sửa lỗi Survey Summary


Phiên bản 4.2.3
------------------
* Chặn các trình duyệt IE 8 trở xuống sử dụng
* Cập nhật quyền kết xuất dữ liệu
* Cập nhật giao diện Nhóm người dùng
* Cập nhật giao diện Phân quyền Nhóm người dùng
* Cập nhật giao diện Quản lý Nhóm người dùng
* Cập nhật giao diện Tài khoản người dùng (Thêm, Sửa)


Phiên bản 4.2.2
------------------
* Bắt lỗi nhập đúng dạng chuẩn của email
* Sửa lỗi không hiện modal popup trong phần create summary  của phiếu khảo sát
* Cập nhật hiển thị sai icon trong danh sách các phiếu khảo sát (Phiếu khảo sát đang được sử dụng)
* Cập nhật alert trong import student


Phiên bản 4.2.1
---------------
* Cập nhật CodeIgniter Framework 2.2.0 (16/6/2014)
* Cập nhật  lại các thư viện JQuery 2.x, Bootrap, Highchart 3.0.10, và một số thư viện khác
* Cập nhật lại giao diện (UI) các trang:
	+ Login
	+ Dashboard
	+ Import Student
	+ Export Student
	+ Survey type (list, edit)
	+ Survey (list, create step1, edit step 1, edit step 2, edit step 3, edit step 4 …)
		- List, create step 1, edit step 1, edit step 2
		- Edit step 3 (16/6/2014)
		- Edit step 4 (20/6/2014)
		- Edit effect (20/6/2014)
	+ Thông báo
	+ Sort questions
	+ Sort answer
* Cập nhật DateTime runtime
* Thêm plugin Pace ( trạng thái loading )


Phiên bản 4.1.0.x
-----------------
* Thêm tính năng xác định câu hỏi có việc làm / chưa có việc làm trong phần thêm câu hỏi
* Thêm tính năng cập nhật có việc làm / chưa có việc làm trong phần cập nhật câu hỏi
* Cập nhật thư viện jquery 1.11.0
* Sửa lỗi #1
