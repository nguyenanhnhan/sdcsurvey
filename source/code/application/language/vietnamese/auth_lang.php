<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Nội dung đưa ra không đáp ứng sự bảo mật của chúng tôi.';

// Login
$lang['login_heading']         = 'Đăng nhập';
$lang['login_subheading']      = 'Hãy đăng nhập với Email của bạn hoặc Tên đăng nhập và mật khẩu dưới đây.';
$lang['login_identity_label']  = 'Email / Tên đăng nhập';
$lang['login_password_label']  = 'Mật khẩu';
$lang['login_remember_label']  = 'Ghi nhớ cho lần đăng nhập sau';
$lang['login_submit_btn']      = 'Đăng nhập';
$lang['login_forgot_password'] = 'Bạn quên mật khẩu?';

// Index
$lang['index_heading']           = 'Người dùng';
$lang['index_subheading']        = 'Danh sách người dùng.';
$lang['index_fname_th']          = 'Họ';
$lang['index_lname_th']          = 'Tên';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Nhóm';
$lang['index_status_th']         = 'Trạng thái';
$lang['index_action_th']         = 'Tác dụng';
$lang['index_active_link']       = 'Có hiệu lực';
$lang['index_inactive_link']     = 'Không hiệu lực';
$lang['index_create_user_link']  = 'Tạo người dùng mới';
$lang['index_create_group_link'] = 'Tạo nhóm mới';

// Deactivate User
$lang['deactivate_heading']                  = 'Vô hiệu hoá người dùng';
$lang['deactivate_subheading']               = 'Bạn có đồng ý vô hiệu hoá người dùng \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Đồng ý:';
$lang['deactivate_confirm_n_label']          = 'Không đồng ý:';
$lang['deactivate_submit_btn']               = 'Chấp nhận';
$lang['deactivate_validation_confirm_label'] = 'Xác nhận';
$lang['deactivate_validation_user_id_label'] = 'Mã người dùng';

// Create User
$lang['create_user_heading']                           = 'Tạo người dùng';
$lang['create_user_subheading']                        = 'Vui lòng nhập các thông tin của người dùng dưới đây.';
$lang['create_user_fname_label']                       = 'Họ và tên đệm:';
$lang['create_user_lname_label']                       = 'Tên:';
$lang['create_user_company_label']                     = 'Tên công ty:';
$lang['create_user_email_label']                       = 'Địa chỉ Email:';
$lang['create_user_phone_label']                       = 'Điện thoại:';
$lang['create_user_password_label']                    = 'Mật khẩu:';
$lang['create_user_password_confirm_label']            = 'Xác nhận lại Mật khẩu:';
$lang['create_user_submit_btn']                        = 'Tạo người dùng';
$lang['create_user_validation_fname_label']            = 'Họ và tên đệm';
$lang['create_user_validation_lname_label']            = 'Tên';
$lang['create_user_validation_email_label']            = 'Địa chỉ Email';
$lang['create_user_validation_phone1_label']           = 'First Part of Phone';
$lang['create_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['create_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['create_user_validation_company_label']          = 'Tên công ty';
$lang['create_user_validation_password_label']         = 'Mật khẩu';
$lang['create_user_validation_password_confirm_label'] = 'Xác nhận lại Mật khẩu';

// Edit User
$lang['edit_user_heading']                           = 'Thay đổi thông tin người dùng';
$lang['edit_user_subheading']                        = 'Vui lòng nhập các thông tin của người dùng dưới đây.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone1_label']           = 'First Part of Phone';
$lang['edit_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['edit_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'Email';


// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Activation Email
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';

