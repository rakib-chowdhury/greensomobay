<?php
/*****************************************************************
 ****************************FrontEnd*****************************
 ******************************************************************/
/******Auth Coonection****/
Auth::routes();
/******Home page*********/
Route::get('/', 'Frontend\FrontendController@index');
/******Logout page*******/
Route::any('/logout', 'Auth\LoginController@logout');

/*******About us, achievement, work, rules *******/
Route::get('/{type}/details', 'Frontend\FrontendController@show');

/*******Contact Us*******/
Route::get('/contact_us', 'Frontend\FrontendController@contact_us');

/*******gallery*******/
Route::get('/gallery', 'Frontend\FrontendController@gallery');

/*******contact/send_mail*******/
Route::post('/contact/send_mail', 'Frontend\FrontendController@send_mail');
/*******newsletter*******/
Route::post('/newsletter', 'Frontend\FrontendController@newsletter');

// lcoation filter
Route::get('/district/{division}', 'LocationController@getDistrictByDivision');
Route::get('/sub_district/{district}', 'LocationController@getUpazilaByDistrict');
/*
|--------------------------------------------------------------------------
| Forms Routes
|--------------------------------------------------------------------------
*/
Route::group([], function () {
    //get dist nd upz
    Route::get('/district', 'LocationController@getDistrictUpzByDivision');

    Route::get('/member_admission', 'FrontForms\MemberApplyController@show');
    Route::post('/member_admission', 'FrontForms\MemberApplyController@post');

    Route::get('/loanApplicant/{id}', 'FrontForms\LoanApplyController@show');
    Route::post('/loanApplicant', 'FrontForms\LoanApplyController@post');

    Route::get('/membersRecall/{id}', 'FrontForms\MemberResignationController@show');
    Route::post('/membersRecall', 'FrontForms\MemberResignationController@post');

    Route::post('/partialSavings', 'FrontForms\PartialSavingController@post');
    Route::get('/partialSavings/{id}', 'FrontForms\PartialSavingController@show');


    ////get member info
    Route::get('/check_member', 'Frontend\FrontendController@check_member');//ajax
    Route::post('/check_member', 'Frontend\FrontendController@check_members');//from submir
});


/*
|--------------------------------------------------------------------------
| Front pages Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin/front'], function () {
    // about us, rules, achievement, current work
    Route::get('/{type}/show', 'FrontContent\AboutUsController@show');
    Route::post('/{type}/store', 'FrontContent\AboutUsController@store');
    Route::post('/{type}/update', 'FrontContent\AboutUsController@update');
    //contact us
    Route::get('/contact_us', 'FrontContent\ContactUsController@show');
    Route::post('/update/contact_us', 'FrontContent\ContactUsController@update');
    //gallery
    Route::get('/gallery', 'FrontContent\GalleryController@show');
    Route::get('/gallery/delete/{id}', 'FrontContent\GalleryController@delete');
    Route::post('/store/gallery', 'FrontContent\GalleryController@store');
});


/*
|--------------------------------------------------------------------------
| Backend   admin pages Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', ['middleware' => ['auth']]], function () {
    // branches
    Route::get('/branches', 'BranchesController@index');////show
    Route::post('/store', 'BranchesController@store');///insert
    Route::post('/branch/update', 'BranchesController@update');///update
    Route::get('/branch/{id}/delete', 'BranchesController@destroy');////delete

    // prokolpo
    Route::get('/prokolpos', 'ProkolpoController@index');////show
    Route::post('/prokolpo/store', 'ProkolpoController@store');///insert
    Route::post('/prokolpo/update', 'ProkolpoController@update');///update
    Route::get('/prokolpo/{id}/delete', 'ProkolpoController@destroy');////delete


    // employee
    Route::get('/employee', 'Employee\EmployeeController@index');//show-list
    Route::get('/employee/create', 'Employee\EmployeeController@create');
    Route::post('/employee/store', 'Employee\EmployeeController@store');
    Route::get('/employee/{id}/delete', 'Employee\EmployeeController@delete');
    Route::get('/employee/{id}/edit', 'Employee\EmployeeController@edit');
    Route::post('/employee/update', 'Employee\EmployeeController@update');
    Route::get('/employee/{id}/details', 'Employee\EmployeeController@details');////show full info

    //member
    Route::get('/member/lists/{type}', 'MemberController@lists');//show-list
    Route::get('/member/{type}/{id}/delete', 'MemberController@delete');////delete
    Route::get('/member/{type}/{id}/approved', 'MemberController@approved');////approved
    Route::get('/member/{type}/{id}/reject', 'MemberController@reject');////reject
    Route::get('/member/{type}/{id}/block', 'MemberController@block');////reject
    Route::get('/member/{type}/{id}/details', 'MemberController@details');////show full info

    //member emp rel
    Route::post('/member/assign/employee', 'Employee\EmployeeController@emp_assign');

    //deposit
    Route::get('/collect_deposit', 'AccountController@add');
    Route::post('/collect_deposit', 'AccountController@post');

    //loan
    Route::get('/collect_loan', 'AccountController@loan');
    Route::post('/collect_loan ', 'AccountController@loan_post');

    ///admin/collect_share'
    Route::get('/collect_share', 'AccountController@share');
    Route::post('/collect_share', 'AccountController@share_post');

    ///admin/return_share'
    Route::get('/return_share', 'AccountController@return_share');
    Route::post('/return_share', 'AccountController@return_share_post');

    ///admin/member_admission'
    Route::get('/member_admission/{id}', 'AccountController@member_admission');
    Route::post('/member_admission', 'AccountController@member_admission_post');


    ////SALARY
    //salary list
    Route::any('/salary', 'SalaryController@salary');
    Route::get('/add_salary', 'SalaryController@add_salary');
    Route::post('/create_salary', 'SalaryController@add_salary_post');
    ////new advance
    Route::get('/new_advance', 'SalaryController@new_advance');
    Route::post('/new_advance', 'SalaryController@new_advance_post');
    ////advance list
    Route::get('/advance', 'SalaryController@advance');
    Route::get('/advance/{id}/edit', 'SalaryController@advance_edit');
    Route::post('/advance/update', 'SalaryController@advance_edit_post');


    ////admin/loanReport'
    Route::get('/loanReport', 'ReportController@loanReport');


    ////admin/memberResignationForm'
    Route::get('/memberResignation/{type}', 'MemberController@memberResignation');
    Route::get('/memberResignation/{id}/approve/{type}', 'MemberController@memberResignation_approve');
    Route::get('/memberResignation/{id}/reject/{type}', 'MemberController@memberResignation_reject');

    ////admin/partialDepositForm'
    Route::get('/partialDeposit/{type}', 'MemberController@partialDeposit');
    Route::get('/partialDeposit/{id}/approve/{type}', 'MemberController@partialDeposit_approve');
    Route::get('/partialDeposit/{id}/reject/{type}', 'MemberController@partialDeposit_reject');

    ////admin/loanForm'
    Route::get('/loan/{type}', 'MemberController@loan');
    Route::get('/loanFrom/{id}/approve/{type}', 'MemberController@loan_approve');
    Route::get('/loanFrom/{id}/reject/{type}', 'MemberController@loan_reject');


    /////all frm message page
    Route::get('/message', function () {
        return view('frontPages.forms.message_page');
    });

    ////admin/transaction'
    Route::get('/transaction', 'AccountController@transaction');
    ////expense
    Route::get('/expense', 'AccountController@expense');
    Route::post('/expense', 'AccountController@expense_post');
    ///income
    Route::get('/income', 'AccountController@income');
    Route::post('/income', 'AccountController@income_post');
    
    /****************************************
     ********************REPORT**************
     ****************************************/
    /**field wise**/
    Route::any('/report/list/{id}', 'ReportController@lists');
    Route::any('/report/{type}/{id}', 'ReportController@lists_details');
    /**branch head or accountant wise**/
    Route::any('/report/incomeExpense', 'ReportController@incomeExpense');
    /**rakib vai**/
    Route::any('/report/showDetails', 'ReportController@show2');

    /**deposit report**/
    Route::any('/report/depositReport', 'ReportController@deposit_report');
    Route::get('/getMemeberAjax', 'ReportController@getMemeberAjax');
    //rakib
    Route::any('/report/depositReportPdf', 'ReportController@deposit_report_pdf');

});
/****admin panel Home panel******/
Route::any('/home', 'HomeController@index');
