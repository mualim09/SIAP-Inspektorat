<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/template/dupak', 'TemplateController@dupakTemplate');
Route::get('/template/dupak/{user_id}', 'TemplateController@dupakUser');
Route::get('/dupak/index', 'admin\DupakController@index');
Route::get('/testlama', 'admin\SptController@getLamaSpt');
Route::get('/testkode', 'admin\TestController@kodeTemuanSelect');
Route::post('/test/{uid}/{date_start}/{date_end}', 'admin\SptController@storeKuota');



//disable welcome page (reason : empty content) --> redirect to admin dashboard see : line 64-67
/*Route::get('/', function () {
    return view('welcome');
    //return redirect()->route('admin');
});*/
Auth::routes();
Route::post('/pic-update','ProfileController@profilePicUpdate')->name('pic.update');
Route::get('/get-profile','ProfileController@getData')->name('api.profile');
Route::get('/myprofile','ProfileController@edit')->name('myprofile');
Route::get('/admin/activity/useract','ProfileController@UserActivity')->name('useract');
Route::get('/admin/activity/bindex', 'ProfileController@viewActivity')->name('viewlog');
Route::get('/search-user', 'admin\UserController@search')->name('search_user');
Route::resource('/profile','ProfileController')->except('destroy');

Route::namespace('admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    	
    /*// fungsi resiko
    Route::get('/admin/resiko','ResikoController@index')->name('resikoindex');
    Route::get('/admin/resiko/getdata','ResikoController@getDataResiko');
    Route::post('/insertDataResiko','ResikoController@insertResiko');
    Route::get('/delete/{id}','ResikoController@deleteResiko')->name('deleteDataResiko');
    Route::get('/getdata/resiko/{id}','ResikoController@resikoPdf')->name('resikoPDF');*/

	
    //Kode temuan
    //Route::get('/admin/kode/select', 'KodeTemuanController@kodeTemuanSelect')->name('select_kode');
    
    //users/role/permission route
    Route::get('/admin/users/getdata','UserController@getData');
	Route::get('/admin/roles/getdata','RoleController@getData');
	Route::get('/admin/permissions/getdata','PermissionController@getData');


	Route::get('/admin/jenis-spt/getdata','JenisSptController@getData');

	Route::get('/admin/spt/getdata/{jenis_data}','SptController@getData')->name('get_data_spt'); // add jenis data variable (mensederhanakan route dengat method get agar terkumpul jadi 1, default value jenis_data = null)
	Route::get('/admin/spt/get-anggota/{id}','SptController@getAnggota')->name('get_anggota_spt');
	Route::get('/admin/spt/cetak-pdf/{id}','SptController@sptPdf')->name('spt_pdf');
	Route::get('/admin/spt/last-data-tambahan/{jenis_spt_id}', 'SptController@getLastDataTambahan')->name('last_data_tambahan');
	Route::get('/admin/spt/last-data/{jenis_data}', 'SptController@getLastData')->name('last_data');
	Route::get('/admin/spt/durasi/{start}/{end}', 'SptController@getDurasi')->name('durasi_spt_front');
	Route::get('/spt/durasi/{start}/{end}', 'SptController@getDurasi')->name('durasi_spt');

	Route::get('/admin/dupak/update-dupak/pendidikan/{user_id}', 'DupakController@updateDupakPendidikan')->name('update_dupak_pendidikan');
	
	Route::resource('/admin/roles','RoleController');
	Route::resource('/admin/permissions', 'PermissionController');
	Route::resource('/admin/users', 'UserController');
	Route::resource('/admin/jenis-spt', 'JenisSptController');
	Route::resource('/admin/spt', 'SptController');
	//Route::resource('/admin/kode', 'KodeTemuanController');
	Route::get('/spt/{id}/edit', 'SptController@edit')->name('edit_spt');

	//sertifikat auditor
	Route::get('/getdata/sertifikat-auditor/{id}', 'UserController@getdataSertifikatUsers');
	Route::post('/input/sertifikat-auditor','UserController@storeSertifikat')->name('save-sertifikat');
	Route::get('/delete/sertifikatAudito/{id}','UserController@deleteSertifikat')->name('destroy_sertifikat');

	//calendar route
	Route::get('/admin/calendar','CalendarController@index')->name('calendar');
	Route::get('/admin/calendar/holiday','CalendarController@getHoliday')->name('holiday_calendar');
	Route::post('/admin/calendar/create','CalendarController@create')->name('store_calendar');
	Route::post('/admin/calendar/update','CalendarController@update')->name('update_calendar');
	Route::post('/admin/calendar/delete','CalendarController@destroy')->name('delete_calendar');
	Route::get('/admin/calendar/user-event/{id}/change','CalendarController@userEventChange')->name('user_event_change');
	Route::post('/admin/calendar/update-user-event', 'CalendarController@updateUserEvent')->name('update_user_event');
	Route::delete('/admin/calendar/delete-user-event/{id}','CalendarController@deleteUserEvent')->name('delete_user_event');
	Route::get('/admin/calendar/pdf', 'CalendarController@calendarPdf')->name('calendar_pdf');

	Route::get('/admin/calendar/auditor','CalendarController@getSptAuditor')->name('calendar_auditor');

	//Route Lokasi
	Route::get('/admin/lokasi','LokasiController@index')->name('index_lokasi');
	Route::post('/admin/save-lokasi','LokasiController@store')->name('store_lokasi');
	Route::get('/admin/getdata-lokasi','LokasiController@getLokasiPemeriksaan')->name('get_data_lokasi');
});
Route::group(['middleware' => ['auth','permission:Access admin page']], function (){
	
	Route::get('/', function () {
    //return view('welcome');
	    return redirect()->route('admin');
	});
	Route::get('/spt/penomoran','admin\SptController@getPenomoranSpt')->name('get-penomoran');
	Route::get('/laporan-nhp/penomoran','admin\SptController@getPenomoranNhp')->name('get-penomoran-nhp');
	//Route::get('/admin','admin\DashboardController@index')->name('admin'); //sementara dimatikan, dialihkan ke index sptController
	Route::get('/admin','admin\SptController@index')->name('admin');
	Route::get('/role-details/{id}', 'admin\RoleController@getMasterDetailsSingleData')->name('api.role_single_details');
	Route::get('/role-details', 'admin\RoleController@getMasterDetailsData')->name('api.role_details');
	Route::post('/insert-detail-spt','admin\SptController@storeDetail')->name('store_detail_spt');
	Route::post('/store-session-anggota','admin\SptController@storeSessionAnggota')->name('store_session_anggota');
	Route::post('/store-detail-anggota','admin\SptController@storeDetailAnggota')->name('store_detail_anggota');
	Route::get('/admin/dupak/list', 'admin\DupakController@index')->name('list_dupak');
	Route::get('/admin/dupak/reviu', 'admin\DupakController@reviuDupak')->name('reviu_dupak');
	Route::get('/admin/dupak/getdata', 'admin\DupakController@getData')->name('data_dupak');
	Route::get('/admin/dupak/user/{id}', 'admin\DupakController@dupakUser')->name('get_dupak_user');
	Route::post('/admin/dupak/store/penunjang', 'admin\DupakController@storePenunjang')->name('store_dupak_penunjang');
	Route::get('/admin/kode/get-sub-kelompok/{id}', 'admin\KodeTemuanController@getSubKelompok')->name('api.kode_sub_kel');
	
	Route::get('/admin/jenis-spt/cari', 'admin\JenisSptController@cariJenisSpt')->name('cari_jenis_spt');
	Route::get('/admin/jenis-spt/get-radio-value/{id}', 'admin\JenisSptController@getRadioValue')->name('jenis_spt_radio');

	//session anggota SPT
	Route::get('/admin/session/anggota', 'admin\SptController@getSessionAnggota')->name('get_session_anggota');
	Route::get('/admin/session/anggota/clear', 'admin\SptController@clearSessionAnggota')->name('clear_session_anggota');
	Route::delete('/admin/session/anggota/delete/{user_id}', 'admin\SptController@deleteSessionAnggotaItem')->name('delete_session_anggota_by_id');
});

Route::group(['middleware' => ['auth','permission:Edit Signed SPT']], function(){
	Route::post('spt/update-nomor/{id}','admin\SptController@updateNomorSpt')->name('update_nomor_spt_front');
	Route::post('/admin/spt/update-nomor/{id}','admin\SptController@updateNomorSpt')->name('update_nomor_spt');

	Route::post('spt/upload-scan/{id}','admin\SptController@uploadScanSpt')->name('upload_scan_spt_front');
	Route::post('/admin/spt/upload-scan/{id}','admin\SptController@uploadScanSpt')->name('upload_scan_spt');
});

Route::group(['middleware'=>['auth','permission:Sign SPT']], function(){
	Route::get('spt/get-processing-spt','admin\SptController@getProcessingSpt')->name('get-processing-spt');
	Route::post('spt/sign-reject', 'admin\SptController@signOrRejectSpt')->name('sign-reject-spt');
});
Route::group(['middleware' => ['auth']], function(){
	Route::get('spt/myspt','admin\SptController@mySpt')->name('my-spt');
	Route::get('spt/myspt/{id}','admin\SptController@InputTemuan')->name('input_kode_laporan');
	Route::get('/admin/spt/myspt/{id}','SptController@InputTemuan')->name('input_kode_laporan_front');
});

Route::group(['middleware'=>['auth','permission:Edit SPT']], function(){
	Route::post('spt/{id}', 'admin\SptController@update')->name('update_spt_front');
	Route::post('/admin/spt/{id}', 'admin\SptController@update')->name('update_spt');
	Route::delete('spt/delete-anggota/{id}','admin\SptController@deleteAnggota')->name('delete_anggota_front');
	Route::delete('/admin/spt/delete-anggota/{id}','SptController@deleteAnggota')->name('delete_anggota');
});


//Route::get('/home', 'HomeController@index')->name('home');
/*Route::get('/admin/users/getdata','admin\UserController@getData');
Route::get('/admin/roles/getdata','admin\RoleController@getData');
Route::get('/admin/permissions/getdata','admin\PermissionController@getData');
Route::resource('/admin/roles','admin\RoleController');
Route::resource('/admin/permissions', 'admin\PermissionController');
Route::resource('/admin/users', 'admin\UserController');*/
Route::group(['prefix'=>'admin', 'namespace' => 'admin'], function () {
	//this route will prefixed admin/ in the url bar (eg: admin/spt) and controller namespace will be admin\ (eg: admin\SptController)

	//spt route


	//kepegawaian route


	//fungsi resiko
    Route::get('resiko','ResikoController@index')->name('resikoindex');
    Route::get('resiko/getdata','ResikoController@getDataResiko');
    Route::post('/insertDataResiko','ResikoController@insertResiko');
    Route::get('/delete/{id}','ResikoController@deleteResiko')->name('deleteDataResiko');
    Route::get('/getdata/resiko/{id}','ResikoController@resikoPdf')->name('resikoPDF');

    //Kode temuan
    Route::get('kode/select', 'KodeTemuanController@kodeTemuanSelect')->name('select_kode');
    Route::resource('kode', 'KodeTemuanController');

});