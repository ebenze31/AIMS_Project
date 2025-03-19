<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_data_check_user_from/{name_partner}', 'PartnerController@get_data_check_user_from');

// Test api 1669
Route::post('/send_data_sos_api', 'Sos_mapController@send_data_sos_api');
Route::get('/send_data_sos_api_to_line/{user_id}/{full_name}/{case_id}', 'Sos_mapController@send_data_sos_api_to_line');


Route::post('/create_data_car/excel', 'Middle_price_carController@create_data_car');
Route::post('/lineapi', 'API\LineApiController@store');
Route::post('/facebookapi', 'API\facebook_messenger_api@facebook');
Route::get('/sos_helper_Charlie/{id_sos}/{id_user}', 'API\LineApiController@sos_helper_Charlie');
Route::get('/Charlie_help_complete/{id_sos}/{id_user}', 'API\LineApiController@Charlie_help_complete');

Route::post('/lineapi/condo', 'API\Condo_LineApiController@store');

Route::post('/juristic', 'API\JuristicController@juristic');
Route::post('/edit_data_organization', 'API\JuristicController@edit_data_organization');
Route::get('/selest_organization/{selest_organization}', 'API\JuristicController@selest_organization');
Route::get('/all_partners', 'API\JuristicController@all_partners');

Route::get('/car_brand','API\CarbrandController@getBrand');
Route::get('/car_brand/{car_brand}/car_model','API\CarbrandController@getModel');

Route::get('/motor_brand','API\CarbrandController@getMotorBrand');
Route::get('/motor_brand/{motor_brand}/motor_model','API\CarbrandController@getMotorModel');

Route::get('/check_register_car/{registration_number}/{province}/check_register_car','API\CarbrandController@check_register_car');

Route::get('/add_reg_id/{registration}/{province}','API\CarbrandController@add_reg_id');

Route::get('/phone_insurance/{name_insurance}/name_insurance','API\CarbrandController@phone_insurance');

Route::get('/check_registration/{registration}','API\CarbrandController@check_registration');
Route::get('/check_registration/{registration}/province','API\CarbrandController@check_province');
Route::get('/check_time/{registration}/{county}/{user_id}','API\CarbrandController@check_time');

Route::get('/carbrand','API\SellcarController@CarBrand');
Route::get('/carbrand/{brand}/carmodel','API\SellcarController@CarModel');

Route::get('/location/{lat}/{lng}/province','API\LocationController@search_location');
Route::get('/location/{lat}/{lng}/check_news','API\LocationController@check_news');

Route::get('/location/show_location_P','API\LocationController@show_location_P');
Route::get('/location/{location_P}/show_location_A','API\LocationController@show_location_A');
Route::get('/location/{location_P}/{location_A}/show_location_T','API\LocationController@show_location_T');
Route::get('/zoom_map/{province}/{amphoe}/{district}','API\LocationController@zoom_map');

Route::get('/change_country/{user_id}','API\LocationController@change_country');
Route::get('/user_language/{language}/{user_id}','API\LocationController@user_language');

Route::get('/check_sos_country/{user_id}','API\LocationController@check_sos_country');

Route::get('/show_sos_area/{countryCode}','API\LocationController@show_sos_area');

Route::get('/check_user/{id_user}','API\PartnersController@check_user');
Route::get('/put_email/{put_email}/{id_user}/{put_username}','API\PartnersController@put_email');
Route::get('/check_username/{put_username}/{id_user}','API\PartnersController@check_username');
Route::get('/check_email/{put_email}','API\PartnersController@check_email');
Route::get('/check_data_partner/{user_organization}','API\PartnersController@check_data_partner');
Route::get('/check_data_partner_premium/{user_organization}','API\PartnersController@check_data_partner_premium');
Route::get('/all_group_line/{user_organization}','API\PartnersController@all_group_line');
Route::get('/check_data_line_group/{group_line_id}','API\PartnersController@check_data_line_group');

Route::get('/explode_name/{name_user}', 'ProfileController@explode_name');


Route::get('/check_add_line/{id_user}','API\LineApiController@check_add_line');
Route::get('/update_add_line/{id_user}','API\LineApiController@update_add_line');

Route::get('/select_car_brand_user','API\CarbrandController@select_car_brand_user');
Route::get('/select_car_brand_user/{car_brand}/model','API\CarbrandController@select_car_model_user');

Route::get('/select_motor_brand_user','API\CarbrandController@select_motor_brand_user');
Route::get('/select_motor_brand_user/{motor_brand}/model','API\CarbrandController@select_motor_model_user');

//////////////////////
//////BROADCAST//////
/////////////////////
Route::get('/check_content','API\CarbrandController@check_content');
// car
Route::post('/search_data_broadcast_by_car','API\CarbrandController@search_data_broadcast_by_car');
Route::get('/search_data_selected_car/{car_id}','API\CarbrandController@search_data_selected_car');
Route::post('/send_content_BC_by_car','API\CarbrandController@send_content_BC_by_car');
// check in
Route::post('/search_data_broadcast_by_check_in','API\API_Broadcast@search_data_broadcast_by_check_in');
Route::post('/send_content_BC_by_check_in','API\API_Broadcast@send_content_BC_by_check_in');
// user
Route::post('/search_data_broadcast_by_user','API\Broadcast_userController@search_data_broadcast_by_user');
Route::post('/send_content_BC_by_user','API\Broadcast_userController@send_content_BC_by_user');
//
Route::post('/search_data_broadcast_by_sos','API\Broadcast_sosController@search_data_broadcast_by_sos');
Route::post('/send_content_BC_by_sos','API\Broadcast_sosController@send_content_BC_by_sos');
///////////////////////////
////// END BROADCAST//////
//////////////////////////


// ยี่ห้อจากราคากลาง
Route::get('/brand_middle_price','API\Brand_middle_price_carsController@getBrand');
Route::get('/brand_middle_price/{car_brand}/model','API\Brand_middle_price_carsController@getModel');

Route::get('/motor_middle_price','API\Brand_middle_price_carsController@getMotorBrand');
Route::get('/motor_middle_price/{motor_brand}/model','API\Brand_middle_price_carsController@getMotorModel');

// OCR
Route::post('/search_reg_ocr','API\GoogleCloudVision@search_registration_ocr');
Route::post('/search_reg_ocr_motor','API\GoogleCloudVision@search_registration_ocr_motor');

// cancel_Profile
Route::get('/confirm_cancel','ProfileController@cancel_Profile');
// welcome_home
Route::get('/welcome_home/{status_id}/profile','ProfileController@welcome_home');


Route::post('/save_sos_insurance', 'API\Save_sos_insuranceController@Save_sos');
Route::get('/select_sos_insurance/{name_insurance}/select_insurance', 'API\Save_sos_insuranceController@select_sos_insurance');

Route::get('/insurance_select_line_group/{name_line_group}/{company}', 'API\API_line_group@save_line_group_insurance');
Route::get('/partner_viicheck_select_line_group/{name_line_group}/{name_partner}', 'API\API_line_group@save_line_group_partner_viicheck');

Route::get('/set_group_line/{group_id}/{language}/{time_zone}/{input_name_group_line}', 'API\API_line_group@set_group_line');

Route::get('/change_language/{language}/{user_id}', 'API\API_language@change_language');
Route::get('/change_language_fromline/{language}/{user_id}', 'API\API_language@change_language_fromline');

Route::get('/add_text_topic/{text_th}', 'API\API_language@add_text_topic');

Route::get('/send_sos_area/{area_arr}/{name_partner}/{name_area}', 'API\PartnersController@sos_area');
Route::get('/area_pending/{name_partner}/{name_area}', 'API\PartnersController@area_pending');
Route::get('/area_current/{name_partner}/{name_area}', 'API\PartnersController@area_current');
Route::get('/send_pass_area/{line_group}/{num_pass_area}', 'API\PartnersController@send_pass_area');
Route::get('/submit_group_line/{line_group}/{id_partner}', 'API\PartnersController@submit_group_line');
Route::get('/search_time_zone', 'API\PartnersController@search_time_zone');

Route::get('/province_search', 'API\LocationController@province_search');
Route::get('/show_amphoe/{province}', 'API\LocationController@amphoe_search');
Route::get('/show_district/{amphoe}', 'API\LocationController@district_search');
Route::get('/show_tambon/{province}/{amphoe}', 'API\LocationController@show_tambon');
Route::get('/zoom_district/{district}', 'API\LocationController@zoom_district');

Route::get('/view_marker/{name_partner}', 'API\LocationController@view_marker');

Route::get('/check_new_sos_area', 'API\PartnersController@check_new_sos_area');

Route::get('/approve_area/{input_new_area}/{id}', 'API\PartnersController@approve_area');
Route::get('/disapproved_area/{id}/{answer_reason}/{reason_other}', 'API\PartnersController@disapproved_area');
Route::get('/input_data_partner/{name_partner}', 'API\PartnersController@input_data_partner');

Route::get('/change_color_navbar/{color_navbar}/{name_partner}', 'API\PartnersController@change_color_navbar');
Route::get('/change_color_menu/{color_navbar}/{name_partner}/{class_color_menu}', 'API\PartnersController@change_color_menu');

Route::get('/input_pls_input_phone/{phone}/{user_id}','API\SosmapController@input_pls_input_phone');
Route::post('/sos_input_input_phone','API\SosmapController@sos_input_input_phone');
Route::get('/sos_map/all_area','API\SosmapController@all_area');
Route::get('/sos_map/area_condo_id/{condo_id}','API\SosmapController@area_condo_id');
Route::get('/submit_score/{sos_map_id}/{score_1}/{score_2}/{total_score}/{comment_help}', 'API\SosmapController@submit_score');
Route::post('/submit_add_photo', 'API\SosmapController@submit_add_photo');
Route::get('/search_title_sos/{name_partner}','API\SosmapController@search_title_sos');

Route::get('/service_area/area_other/{id_user}/{name_area}','API\PartnersController@area_other');
Route::get('/service_area/area_partner_other/{id_user}/{name_area}','API\PartnersController@area_partner_other');
Route::get('/service_area/check_area_other/{id_partnet}','API\PartnersController@check_area_other');
Route::get('/service_area/your_old_area/{id_user}/{name_area}','API\PartnersController@your_old_area');

Route::get('/cancel_membership/{user_id}','Manage_userController@cancel_membership');

Route::get('/all_sos_area','API\PartnersController@all_sos_area');
Route::get('/all_area_partner/{name_partner}','API\PartnersController@all_area_partner');
Route::get('/search_data_sos_js100/{name}/{phone}','API\PartnersController@search_data_sos_js100');
Route::get('/check_new_sos_js100_by_theme','API\PartnersController@check_new_sos_js100_by_theme');
Route::get('/check_new_sos_js100','API\PartnersController@check_new_sos_js100');
Route::get('/check_notified_js100','API\PartnersController@check_notified_js100');
Route::get('/update_new_sos_js100/{is_sos_map}','API\PartnersController@update_new_sos_js100');
Route::get('/admin_click/{all_or_id}','API\PartnersController@admin_click');

Route::post('/sos_map/update_location_user','Sos_mapController@update_location_user');
Route::post('/sos_map/update_location_officer','Sos_mapController@update_location_officer');
Route::post('/sos_map/update_status','Sos_mapController@update_status');
Route::post('/sos_map/help_complete','Sos_mapController@help_complete');
Route::get('/sos_map/loop_check_status_sos_map/{id_sos_map}','Sos_mapController@loop_check_status_sos_map');
Route::post('/sos_map/get_location_user_and_officer','Sos_mapController@get_location_user_and_officer');
Route::get('/sos_map/search_phone_niems/{cityName}','Sos_mapController@search_phone_niems');
Route::get('/sos_map/update_sos_1669_id/{sos_1669_id}/{sos_map_id}/{district_P}/{name_admin}','Sos_mapController@update_sos_1669_id');
Route::get('/sos_map/update_helper_id/{admin_id}/{sos_map_id}','Sos_mapController@update_helper_id');
Route::post('/sos_map/submit_remark_command','Sos_mapController@submit_remark_command');
Route::get('/sos_map/request_delete_case/{sos_map_id}/{officer_id}','Sos_mapController@request_delete_case');

Route::get('/check_sos_alarm/{check_name_partner}','API\PartnersController@check_sos_alarm');
Route::get('/check_sos_alarm/notify/{check_name_partner}','API\PartnersController@check_sos_alarm_notify');

Route::get('/search_std/{student_id_covid}/{check_in_at}/{name_area}','API\PartnersController@search_std');
Route::get('/search_name/{student_name_covid}/{check_in_at}/{name_area}','API\PartnersController@search_name');
Route::get('/show_group_risk/{id}/{check_in_at}/{name_area}/{name_disease}','API\PartnersController@show_group_risk');
Route::post('/send_risk_group', 'API\PartnersController@send_risk_group');


Route::post('/save_img_url', 'API\ImageController@save_img_url');
Route::post('/save_qr_code_add_officer', 'API\ImageController@save_qr_code_add_officer');
Route::post('/create_img_check_in', 'API\ImageController@create_img_check_in');
Route::post('/admin_create_img_check_in', 'API\ImageController@admin_create_img_check_in');

Route::get('/search_nationalitie', 'API\API_language@search_nationalitie');
Route::get('/search_data_time_zones', 'API\API_language@search_data_time_zones');
Route::get('/search_data_country', 'API\API_language@search_data_country');
Route::get('/update_user_nationalitie/{nationality}/{user_id}', 'API\API_language@update_user_nationalitie');

Route::get('/submit_show_homepage/{partner_id}/{input_show_homepage}', 'API\PartnersController@submit_show_homepage');

Route::get('/clear_area/{name_partner}/{name_area}', 'API\PartnersController@clear_area');
Route::get('/clear_area_new/{name_partner}/{name_area}', 'API\PartnersController@clear_area_new');
Route::get('/delete_area/{id}', 'API\PartnersController@delete_area');

Route::get('/show_logo_partner', 'API\PartnersController@show_logo_partner');
Route::get('/view_map_officer_all/{select_area}/draw_select_area', 'API\PartnersController@draw_select_area');
Route::get('/get_sos_help_center_success/{area}', 'API\PartnersController@get_sos_help_center_success');
Route::get('/get_polygon_all_amphoe', 'API\LocationController@get_polygon_all_amphoe');
Route::get('/get_data_officer_all/{area}', 'API\PartnersController@get_data_officer_all');
Route::get('/get_let_lng_district/{area}/{select_area_district}', 'API\LocationController@get_let_lng_district');



// API TU
Route::post('/api_data_tu_greats', 'API\API_TU_Greats@api_data_tu_greats');

// condo
Route::get('/select_appointment_time/{appointment_date}/{condo_id}', 'Notify_repairController@select_appointment_time');
Route::get('/send_pass_condo/{line_group}/{num_pass_area}', 'API\PartnersController@send_pass_condo');
Route::get('/update_data_groupline/{id_groupline}/{system}', 'API\PartnersController@update_data_groupline');
Route::get('/notify_repair_annotation/{id}/{annotation}', 'Notify_repairController@notify_repair_annotation');

// API User login line
Route::get('/register_api', 'Auth\LoginController@register_api');

// SOS HELP CENTER
Route::get('/data_help_center/','Sos_help_centerController@search_data_help_center');
Route::get('/update_code_for_officer/{id}/{input_code}','Sos_help_centerController@update_code_for_officer');
Route::get('/create_new_sos_help_center/{user_id}', 'Sos_help_centerController@create_new_sos_help_center');
Route::post('/create_new_sos_by_user', 'Sos_help_centerController@create_new_sos_by_user');
Route::post('/send_save_data/form_yellow', 'Sos_help_centerController@save_form_yellow');
Route::post('/save_data_change_form_yellow', 'Sos_help_centerController@save_data_change_form_yellow');
Route::get('/send_noti_ask_mores_to/{user_id}/{ask_mores_id}', 'Sos_help_centerController@send_noti_ask_mores_to');
Route::get('/check_update/form_yellow/{sos_id}', 'Sos_help_centerController@check_update_form_yellow');
Route::get('/get_location_operating_unit/{lat}/{lng}/{level}/{vehicle_type}/{forward_level}/{sub_organization}', 'Sos_help_centerController@get_location_operating_unit');

Route::get('/send_data_sos_to_operating_unit/{sos_id}/{operating_unit_id}/{user_id}/{distance}', 'Sos_help_centerController@send_data_sos_to_operating_unit');
Route::get('/check_status_wait_operating_unit/{sos_id}', 'Sos_help_centerController@check_status_wait_operating_unit');
Route::get('/get_current_officer_location/{sos_id}', 'Sos_help_centerController@get_current_officer_location');
Route::get('/update_location_officer/{sos_id}/{lat}/{lng}', 'Sos_help_centerController@update_location_officer');
Route::get('/update_status_officer/{status}/{sos_id}/{reason}', 'Sos_help_centerController@update_status_officer');
Route::get('/update_status_officer_Standby/{status}/{officer_id}/{lat}/{lng}', 'Sos_help_centerController@update_status_officer_Standby');
Route::get('/update_event_level_rc/{level}/{sos_id}/{rc_black_text}', 'Sos_help_centerController@update_event_level_rc');
Route::get('/update_officer_to_the_operating_base/{sos_id}', 'Sos_help_centerController@update_officer_to_the_operating_base');
Route::get('/update_data_form_yellows/{sos_id}/{column}/{data}', 'Sos_help_centerController@update_data_form_yellows');
Route::get('/update_mileage_officer/{sos_id}/{mileage}/{location}', 'Sos_help_centerController@update_mileage_officer');
Route::get('/draw_area_help_center/{type}', 'Sos_help_centerController@draw_area_help_center');
Route::get('/draw_area_select/{province_name}', 'Sos_help_centerController@draw_area_select');
Route::get('/marker_area_select/{province_name}', 'Sos_help_centerController@marker_area_select');
Route::post('/edit_data_officer_Standby', 'Sos_help_centerController@edit_data_officer_Standby');
Route::post('/update_code_sos_1669', 'Sos_help_centerController@update_code_sos_1669');
Route::get('/check_ask_for_help_1669/{sub_organization}/{user_id}', 'Sos_help_centerController@check_ask_for_help_1669');
Route::get('/update_last_check_ask_for_help_1669/{sos_id}', 'Sos_help_centerController@update_last_check_ask_for_help_1669');
Route::get('/get_lat_lng_area_sub_organization/{name_area}', 'Sos_help_centerController@get_lat_lng_area_sub_organization');
Route::get('/submit_score_1669/{sos_id}/{score_1}/{score_2}/{total_score}/{comment_help}', 'Sos_help_centerController@submit_score_1669');
Route::get('/send_flex_help_complete/{sos_id}', 'Sos_help_centerController@send_flex_help_complete');
Route::get('/search_all_name_user_partner', 'Sos_help_centerController@search_all_name_user_partner');
Route::get('/forward_operation/{sos_id}', 'Sos_help_centerController@forward_operation');
Route::get('/sos_1669_command_by/{sos_id}/{admin_id}', 'Sos_help_centerController@sos_1669_command_by');
Route::get('/get_forward_operation/{forward_id}', 'Sos_help_centerController@get_forward_operation');
Route::post('/update_number_officer/data_1669_officer_commands', 'Sos_help_centerController@update_number_officer');
Route::get('/search_officer_Standby/{admin_id}', 'Sos_help_centerController@search_officer_Standby');
Route::get('/Forward_notify/{officer_command_id}/{sos_id}', 'Sos_help_centerController@Forward_notify');
Route::get('/check_status_officer_1669/{officer_command_id}/{sub_organization}','Sos_help_centerController@check_status_officer_1669');
Route::get('/change_status_officer_to/{officer_command_id}/{sub_organization}/{change_to}', 'Sos_help_centerController@change_status_officer_to');
Route::get('/create_joint_sos_1669', 'Sos_help_centerController@create_joint_sos_1669');
Route::get('/create_ask_more_sos', 'Sos_help_centerController@create_ask_more_sos');
Route::get('/check_sos_joint_case', 'Sos_help_centerController@check_sos_joint_case');
Route::get('/send_data_new_select_officer', 'Sos_help_centerController@send_data_new_select_officer');
Route::get('/check_officer_command_in_call/{sos_id}', 'Sos_help_centerController@check_officer_command_in_call');
Route::get('/real_time_check_refuse_and_call', 'Sos_help_centerController@real_time_check_refuse_and_call');
Route::get('/delete_case', 'Sos_help_centerController@delete_case');
Route::get('/delete_case_all', 'Sos_help_centerController@delete_case_all');

Route::get('/check_data_form_yellow_show_case', 'Sos_help_centerController@check_data_form_yellow_show_case');
Route::post('/officerSaveFormYellow', 'Sos_help_centerController@officerSaveFormYellow');
Route::post('/officerAskMore', 'Sos_help_centerController@officerAskMore');
Route::get('/update_noti_ask_mores/{ask_mores_id}', 'Sos_help_centerController@update_noti_ask_mores');

Route::get('/check_old_officer/{user_id}', 'Sos_help_centerController@check_old_officer');
Route::get('/CF_Change_name_officer/{id_officer}/{new_name_officer}', 'Data_1669_operating_unitController@CF_Change_name_officer');
Route::get('/sos_help_center/show_average_time/{area}', 'Sos_help_centerController@show_average_time');

    // SOS HELP CENTER FORM USER
    Route::get('/check_unit_cf_sos_form_user/{sos_id}', 'Sos_help_centerController@check_unit_cf_sos_form_user');
    Route::get('/check_location_officer/{sos_id}', 'Sos_help_centerController@check_location_officer');
    Route::get('/check_status_officer/{sos_id}', 'Sos_help_centerController@check_status_officer');
    Route::get('case_officer', 'Sos_help_centerController@case_officer');
    // SOS HELP CENTER FORM officer
	Route::get('officer_edit_form/{sos_id}', 'Sos_help_centerController@officer_edit_form');
	Route::post('update_data_form_officer', 'Sos_help_centerController@update_data_form_officer');

// SOS nationalities
Route::get('/nationalities/send_pass_code_to_line/{language}/{id_guoup_line}', 'Nationalitie_group_linesController@send_pass_code_to_line');
Route::get('/nationalities/create_new_sos_group_line/{language}/{id_guoup_line}', 'Nationalitie_group_linesController@create_new_sos_group_line');

// show user
Route::get('/data_officer_go_to_help/{sos_id}', 'Sos_help_centerController@data_officer_go_to_help');

// Join case
Route::get('/get_data_all_joint_case/{joint_case}', 'Sos_help_centerController@get_data_all_joint_case');

// จัดการรูปภาพ
Route::get('/delete_uploaded_photos/{name_file}/{type_part}','API\PartnersController@delete_uploaded_photos');
Route::get('/resize_img/{name_file}/{type_part}','API\PartnersController@resize_img');
Route::get('/get_new_size_img/{name_file}/{type_part}','API\PartnersController@get_new_size_img');

//==========================//
//======= Agora Chat =======//
//==========================//
Route::get('/video_call_4', 'Agora_4_Controller@token');
Route::get('/join_room_4', 'Agora_4_Controller@join_room_4');
Route::get('/left_room_4', 'Agora_4_Controller@left_room_4');
Route::get('/check_user_in_room_4', 'Agora_4_Controller@check_user_in_room_4');
Route::get('/get_local_data_4', 'Agora_4_Controller@get_local_data_4');
Route::get('/get_remote_data_4', 'Agora_4_Controller@get_remote_data_4');
Route::get('/check_status_sos_video_call', 'Agora_4_Controller@check_status_sos_video_call');
Route::get('/check_status_room', 'Agora_4_Controller@check_status_room');
Route::get('/check_delete_member', 'Agora_4_Controller@check_delete_member');
Route::get('/check_user_for_operation_meet', 'Agora_4_Controller@check_user_for_operation_meet');

Route::get('/video_call', 'AgoraController@token');
Route::get('/join_room', 'AgoraController@join_room');
Route::get('/left_room', 'AgoraController@left_room');
Route::get('/check_user_in_room', 'AgoraController@check_user_in_room');
Route::get('/check_command_in_room', 'AgoraController@check_command_in_room');
Route::get('/get_data_command_adn_user', 'AgoraController@get_data_command_adn_user');
Route::get('/get_appId', 'AgoraController@get_appId');

Route::get('/check_user_in_room_2', 'Agora_4_Controller@check_user_in_room_2');


//========================//
//     DashBoard
//========================//

//==========  Dashboard old  ===============//
Route::get('/select_content_broadcast/{type}/{name_partner}', 'PartnerController@select_content_broadcast');

//========== User ==============//
Route::get('/filter_user', 'Partner_DashboardController@filter_user');
Route::get('/get_area_checkin/{area_id}/{user_login}', 'Partner_DashboardController@get_area_checkin');
Route::get('/get_area_checkin_3_topic/{area_id}/{user_login}', 'Partner_DashboardController@get_area_checkin_3_topic');
Route::get('/sos_data_map_organization/{user_login_organization}', 'Partner_DashboardController@map_sos_organization');
//========== สพฉ ==============//
Route::get('/sos_data_map/{user_login_organization}', 'Dashboard_1669_Controller@map_sos');
Route::get('/top5_score_unit/{filter_data}/{user_login}', 'Dashboard_1669_Controller@top5_score_unit');
Route::get('/avg_score_by_case/{filter_data}/{user_login}', 'Dashboard_1669_Controller@avg_score_by_case');
Route::get('/filter_data_command_unit', 'Dashboard_1669_Controller@filter_data_command_unit');
Route::get('/get_location_ask_more_operating_unit/', 'Sos_help_centerController@get_location_ask_more_operating_unit');
Route::post('/mutiple_delete_unit', 'Data_1669_operating_unitController@mutiple_delete_unit');
Route::post('/multiple_delete_officer', 'Data_1669_operating_unitController@multiple_delete_officer');
Route::post('check_percentage_sos', 'Sos_help_centerController@check_percentage_sos');
Route::post('verified_status_form', 'Sos_help_centerController@verified_status_form');
Route::post('create_and_delete_data_patient', 'Sos_help_centerController@create_and_delete_data_patient');
Route::get('get_data_sos_success', 'Sos_help_centerController@get_data_sos_success');
Route::get('getDataFormColor', 'Sos_help_centerController@getDataFormColor');
Route::get('/dashboard_viisos', 'Partner_DashboardController@dashboard_viisos');
Route::get('/update_status_block_user', 'Partner_DashboardController@update_status_block_user');
Route::get('/dashboard_1669_all_case_sos_show', 'Partner_DashboardController@dashboard_1669_all_case_sos_show');
Route::get('/viisos_used/{user_login_organization}', 'Partner_DashboardController@viisos_used_api');
Route::get('/API_dashboard_index_1669', 'Dashboard_1669_Controller@API_dashboard_index_1669');
Route::get('/API_dashboard_operating_officer', 'Dashboard_1669_Controller@API_dashboard_operating_officer');
Route::get('/API_dashboard_avg_score_by_case', 'Dashboard_1669_Controller@API_dashboard_avg_score_by_case');
Route::get('/API_dashboard_operating_unit', 'Dashboard_1669_Controller@API_dashboard_operating_unit');
Route::get('/API_dashboard_level_operating', 'Dashboard_1669_Controller@API_dashboard_level_operating');
Route::get('/API_dashboard_vehicle_operating', 'Dashboard_1669_Controller@API_dashboard_vehicle_operating');
Route::get('/API_dashboard_count_data_sos', 'Dashboard_1669_Controller@API_dashboard_count_data_sos');
Route::get('/API_dashboard_data_ask_to_help', 'Dashboard_1669_Controller@API_dashboard_data_ask_to_help');
Route::get('/API_dashboard_data_sos_fastest', 'Dashboard_1669_Controller@API_dashboard_data_sos_fastest');
Route::get('/API_dashboard_data_sos_slowest', 'Dashboard_1669_Controller@API_dashboard_data_sos_slowest');
Route::get('/API_dashboard_count_treatment', 'Dashboard_1669_Controller@API_dashboard_count_treatment');
Route::get('/API_dashboard_count_area_sos', 'Dashboard_1669_Controller@API_dashboard_count_area_sos');
Route::get('/API_dashboard_sos_score_best_5', 'Dashboard_1669_Controller@API_dashboard_sos_score_best_5');
Route::get('/API_dashboard_sos_score_worst_5', 'Dashboard_1669_Controller@API_dashboard_sos_score_worst_5');
Route::get('/API_dashboard_data_notify', 'Dashboard_1669_Controller@API_dashboard_data_notify');
Route::get('/API_dashboard_districts_sos', 'Dashboard_1669_Controller@API_dashboard_districts_sos');
Route::get('/API_dashboard_most_symptom_data', 'Dashboard_1669_Controller@API_dashboard_most_symptom_data');
Route::get('/API_dashboard_form_yellows_idc', 'Dashboard_1669_Controller@API_dashboard_form_yellows_idc');
Route::get('/API_dashboard_form_yellows_rc', 'Dashboard_1669_Controller@API_dashboard_form_yellows_rc');
Route::get('/API_dashboard_treatment_have_cure', 'Dashboard_1669_Controller@API_dashboard_treatment_have_cure');
Route::get('/API_dashboard_treatment_no_have_cure', 'Dashboard_1669_Controller@API_dashboard_treatment_no_have_cure');


// VOTE KAN
Route::get('/get_location_kan/{amphoe}/show_area','Vote_kan_data_stationsController@show_area');
Route::get('/get_location_kan/{amphoe}/{area}/show_tambon','Vote_kan_data_stationsController@show_tambon');
Route::get('/get_location_kan/{amphoe}/{area}/{tambon}/show_polling_station_at','Vote_kan_data_stationsController@show_polling_station_at');
Route::get('/get_data_show_score','Vote_kan_scoresController@get_data_show_score');


Route::post('/update_data_report_repair', 'Sos_mapController@update_data_report_repair');

// hospital_offices
Route::post('/create_hospital_office/excel', 'Hospital_officeController@create_hospital_office');
Route::get('/get_hospital_offices/{m_lat}/{m_lng}/{province}', 'Hospital_officeController@get_hospital_offices');
Route::get('/get_data_hospital/{province}', 'Hospital_officeController@get_data_hospital');
Route::get('/create_account_hospital/{area}/{id}/{creator}', 'Hospital_officeController@create_account_hospital');
Route::get('/create_1669_to_hospitals/{hospital_id}/{sos_1669_id}/{command_id}', 'Hospital_officeController@create_1669_to_hospitals');
Route::get('/start_get_data_sos_hospital/{user_id}', 'Sos_1669_to_hospitalController@start_get_data_sos_hospital');
Route::get('/update_status_case_hospital', 'Sos_1669_to_hospitalController@update_status_case_hospital');
Route::get('/hospital_dropdown_data', 'Hospital_officeController@dropdown_data');

Route::get('/get_data_btn_organizations', 'Sos_mapController@get_data_btn_organizations');

Route::get('/get_unit_offiecr/{sub_organization}', 'Sos_help_centerController@get_unit_offiecr');


// Privilege
Route::get('/get_code_redeem', 'PrivilegeController@get_code_redeem');
Route::post('/add_privileges', 'PrivilegeController@add_privileges');
Route::post('/create_redeem_code_excel/{privilege_id}/{amount_privilege}', 'PrivilegeController@create_redeem_code_excel');


// >>>>>> SOS PARTNER V2. <<<<<< //
    Route::post('/edit_data_sos_partners', 'Sos_partnersController@edit_data_sos_partners');
    Route::get('/check_secret_token/{secret_token}', 'Sos_partnersController@check_secret_token');
    Route::get('/click_cf_connect/{partner_id}/{partner_name}/{groupId}', 'Sos_partnersController@click_cf_connect');
    Route::get('/get_data_group_line_ower/{organization_id}', 'Sos_partnersController@get_data_group_line_ower');
    Route::get('/get_data_area/{organization_id}', 'Sos_partnersController@get_data_area');
    Route::get('/get_data_area_repair_index', 'Sos_partnersController@get_data_area_repair_index');
    Route::get('/check_secret_token_for_area/{id}/{secret_token}', 'Sos_partnersController@check_secret_token_for_area');
    Route::get('/CF_select_line_for_area/{id_area}/{id_line_group}/{type}', 'Sos_partnersController@CF_select_line_for_area');
    Route::get('/create_name_area/{name_area}/{creator}/{organization_id}', 'Sos_partnersController@create_name_area');
    Route::get('/open_area/{id}/{type}', 'Sos_partnersController@open_area');
    Route::post('/create_categorie_repair', 'Sos_partnersController@create_categorie_repair');
    Route::get('/get_data_categorie/{area_id}', 'Sos_partnersController@get_data_categorie');
    Route::get('/open_status_category/{categorie_id}/{type}', 'Sos_partnersController@open_status_category');
    Route::get('/changr_color_categorys/{color}/{categorys_id}', 'Sos_partnersController@changr_color_categorys');
    Route::get('/get_sub_categorys/{categorys_id}', 'Sos_partnersController@get_sub_categorys');
    Route::post('/add_title_category', 'Sos_partnersController@add_title_category');
    Route::get('/open_status_sub_categorys/{sub_categorys_id}/{type}', 'Sos_partnersController@open_status_sub_categorys');
    Route::get('/delete_sub_cat/{sub_cat_id}', 'Sos_partnersController@delete_sub_cat');
    Route::post('/edit_name_Categorie', 'Sos_partnersController@edit_name_Categorie');
    Route::post('/CF_ChangeGroupLine_categorie', 'Sos_partnersController@CF_ChangeGroupLine_categorie');
    Route::get('/CF_cancel_GroupLine/{categorys_id}/{user_id}', 'Sos_partnersController@CF_cancel_GroupLine');
    Route::post('/bind_groupLine_ViiFix', 'API\LineApiController@bind_groupLine_ViiFix');
    Route::get('/CF_delete_area/{area_id}', 'Sos_partnersController@CF_delete_area');
    Route::get('/check_old_sos_partner_officer', 'Sos_partner_officersController@check_old_sos_partner_officer');
    Route::get('/get_data_area_all/{sos_partner_id}', 'Sos_partnersController@get_data_area_all');
    Route::post('/map_search_by_district', 'Sos_partnersController@map_search_by_district');
    Route::post('/CF_New_Area', 'Sos_partnersController@CF_New_Area');
    Route::get('/search_polygon_area', 'Sos_partnersController@search_polygon_area');
    Route::get('/get_countryCode', 'Sos_partnersController@get_countryCode');
    Route::get('/get_phone_sos_general/{countryCode}', 'Sos_partnersController@get_phone_sos_general');
    Route::get('/get_phone_embassy/{nationalitie}/{countryCode}', 'Sos_partnersController@get_phone_embassy');
    Route::get('/test_cut_json', 'Sos_partnersController@test_cut_json');

// >>>>>> END SOS PARTNER V2. <<<<<< //

// maintain
Route::get('/get_sub_category', 'Maintain_notisController@get_sub_category');
Route::post('/submit_rating_maintain', 'Maintain_notisController@submit_rating_maintain');
Route::get('/get_data_area_maintain', 'Maintain_notisController@get_data_area_maintain');
Route::post('/create_data_maintain_admin_index', 'Maintain_notisController@create_data_maintain_admin_index'); // Create By Junior Dear --> ข้อมูลงานซ่อมในหน้า admin --route--> /viifix_repair_admin/index
Route::post('/create_timeline_maintain_admin_view', 'Maintain_notisController@create_timeline_maintain_admin_view'); // Create By Junior Dear --> ข้อมูลงานซ่อมตรงส่วนไทม์ไลน์ในหน้า view --route--> /viifix_repair_admin/view
Route::post('/change_status_maintain_admin_view', 'Maintain_notisController@change_status_maintain'); // Create By Junior Dear --> เปลี่ยนสถานะในหน้า view --route--> /viifix_repair_admin/view
Route::post('/change_priority_maintain_admin_view', 'Maintain_notisController@change_priority_maintain'); // Create By Junior Dear --> เปลี่ยนความเร่งด่วนในหน้า view --route--> /viifix_repair_admin/view
Route::post('/change_remark_admin_maintain_admin_view', 'Maintain_notisController@change_remark_admin_maintain'); // Create By Junior Dear --> เปลี่ยน remark_admin ในหน้า view --route--> /viifix_repair_admin/view
Route::post('/confirm_forward_maintain_admin_view', 'Maintain_notisController@confirm_forward_maintain'); // Create By Junior Dear --> ดำเนินการจัดซื้อขัดจ้าง ในหน้า view --route--> /viifix_repair_admin/view

Route::get('/WorkCalendar/{officer_id}', 'Maintain_notisController@WorkCalendar'); // Create By Junior Dear --> ข้อมูลตารางงานของเจ้าหน้าที่
Route::get('/getAmountMaintainDashboard', 'MaintainDashboardController@getAmountMaintainDashboard'); //Create By Junior Dear --> 4 bubble + 1 table Dashboard
Route::get('/get_5_ListMaintains', 'MaintainDashboardController@get_5_ListMaintains'); // Create By Junior Dear -->  "จำนวนการแจ้งซ่อม 5 ลำดับล่าสุด" ใน Dashboard
Route::get('/get_ListMaintains', 'MaintainDashboardController@get_ListMaintains'); // Create By Junior Dear -->  "จำนวนการแจ้งซ่อมทั้งหมด " ในหน้าที่กดจาก ... จากจำนวนการแจ้งซ่อม 5 ลำดับล่าสุด ใน Dashboard
Route::get('/get_5_FastestMaintains', 'MaintainDashboardController@get_5_FastestMaintains'); // Create By Junior Dear --> "รายการแจ้งที่เร็วสุด 5 ลำดับล่าสุด" ใน Dashboard
Route::get('/getFastestMaintains', 'MaintainDashboardController@getFastestMaintains'); // Create By Junior Dear --> "รายการแจ้งที่เร็วสุดทั้งหมด " ในหน้าที่กดจาก ... จากรายการแจ้งที่เร็วสุด 5 ลำดับล่าสุด ใน Dashboard
Route::get('/get_5_SlowestMaintains', 'MaintainDashboardController@get_5_SlowestMaintains'); // Create By Junior Dear --> "รายการแจ้งที่ช้าสุด 5 ลำดับล่าสุด" ใน Dashboard
Route::get('/get_cateChartMaintains', 'MaintainDashboardController@get_cateChartMaintains'); // Create By Junior Dear --> "กราฟแสดงการแจ้งซ่อมตามหมวดหมู่ + หมวดหมู่ย่อย" ใน Dashboard
Route::get('/get_areaAmountChartMaintains', 'MaintainDashboardController@get_areaAmountChartMaintains'); // Create By Junior Dear --> "กราฟแสดงการแจ้งแต่ละพื้นที่" ใน Dashboard
Route::get('/WorkCalendarDashboard/{partner_id}', 'MaintainDashboardController@WorkCalendarDashboard'); // Create By Junior Dear --> ข้อมูลตารางงานของ Dashboard
// END maintain

// quality_maintain
Route::post('/create_data_officer_quality_repiar_index', 'Maintain_notisController@create_data_officer_quality_repiar_index'); // Create By Junior Dear --> ข้อมูลงานซ่อมของ officer ใน index
Route::post('/create_data_officer_quality_repiar_view', 'Maintain_notisController@create_data_officer_quality_repiar_view'); // Create By Junior Dear --> ข้อมูลงานซ่อมของ officer ใน view
Route::post('/create_data_officer_quality_repiar_detail', 'Maintain_notisController@create_data_officer_quality_repiar_detail'); // Create By Junior Dear --> ข้อมูลงานซ่อมของ officer ใน detail

// material_maintain
Route::post('/get_material_maintain', 'Maintain_notisController@get_material_maintain'); // Create By Junior Dear --> ข้อมูลวัสดุ/อุปกรณ์ใน viifix_repair_material/index
Route::post('/create_material_maintain', 'Maintain_notisController@create_material_maintain'); // Create By Junior Dear --> เพิ่ม ข้อมูลวัสดุ/อุปกรณ์ใน viifix_repair_material/index

// time_repair viifix
Route::post('/create_data_time_repair', 'Maintain_notisController@create_data_time_repair'); // Create By Junior Dear --> ข้อมูลงานซ่อมของ officer ใน detail
