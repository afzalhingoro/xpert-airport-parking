<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\BackendticketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompaniesProductPriceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\customer\HomeController as CustomerHomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\EmailNewController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailTemplatesController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\front\BookingController as FrontBookingController;
use App\Http\Controllers\front\CustomerController as FrontCustomerController;
use App\Http\Controllers\front\HomeController as FrontHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ParsedEmailsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache and optimization cleared successfully!';
});
Route::get('/test-email', [EmailController::class, 'testEmail']);
/*
|-----------923265343534---------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/updateapp', function () {
    \Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
});

Route::get('get-external-bookings', [FrontHomeController::class, 'getExternalBookings']);
Route::get('get-agent', [FrontHomeController::class, 'getAgents']);
Route::post('contact-us-submit', [FrontHomeController::class, 'contactussubmit']);
Route::get('/', [FrontHomeController::class, 'index'])->name('main');
Route::get('/send_email_test', [EmailNewController::class, 'send_email']);

Route::get('/send_gmail_test', [EmailController::class, 'sendTestGmail']);


Route::get('/search', [FrontHomeController::class, 'search'])->name('search');
Route::get('/manchester-airport-parking', [FrontHomeController::class, 'heathrow_airport_parking'])->name('heathrow_airport_parking');
Route::post('/result', [FrontHomeController::class, 'getSearchResult'])->name('searchresult');
Route::get('/aphinfo', [FrontHomeController::class, 'getAphInfo'])->name('aphinfo');
Route::get('/resultfortravelez', [FrontHomeController::class, 'getSearchResultForTravelez'])->name('resultfortravelez'); //return json response
Route::get('/result', [FrontHomeController::class, 'getSearchResult'])->name('searchresult');
Route::post('/booking', [FrontHomeController::class, 'addBookingForm'])->name('addBookingForm');
Route::get('terminal-01', [FrontHomeController::class, 'terminal_01'])->name('heathrow.terminal-01');
Route::get('terminal-02', [FrontHomeController::class, 'terminal_02'])->name('heathrow.terminal.02');
Route::get('terminal-03', [FrontHomeController::class, 'terminal_03'])->name('heathrow.terminal.03');
Route::get('terminal-04', [FrontHomeController::class, 'terminal_04'])->name('heathrow.terminal.04');
Route::get('terminal-05', [FrontHomeController::class, 'terminal_05'])->name('heathrow.terminal.05');
Route::get('/blog', [FrontHomeController::class, 'blogs'])->name('blog');
Route::get('blog/{slug}', [FrontHomeController::class, 'blog_detail'])->name('blog_detail');
Route::post('/loadinfo', [FrontHomeController::class, 'loadinfo'])->name('loadinfo');
Route::get('/booking/incomplete/{id}', [FrontHomeController::class, 'addBookingFormincomplete'])->name('addBookingForm2');
Route::post('/checkBooking', [FrontBookingController::class, 'checkBooking'])->name('checkBooking');
Route::post('/checkCarWash', [FrontBookingController::class, 'checkCarWash'])->name('checkCarWash');
Route::post('/booking/checkout', [FrontBookingController::class, 'checkout'])->name('checkout');
Route::post('/booking/incomplete/booking/checkout', [FrontBookingController::class, 'checkout'])->name('checkout1');
Route::post('/booking/payout', [FrontBookingController::class, 'paymentwithstripe'])->name('paymentwithstripe');
Route::post('/booking/incomplete/booking/payout', [FrontBookingController::class, 'paymentwithstripe'])->name('paymentwithstripe');
Route::post('/booking/paymentfailed', [FrontBookingController::class, 'paymentfailed'])->name('paymentfailed');
Route::get('/booking/thankyou/{id}', [FrontBookingController::class, 'thanyou'])->name('thankyou');
Route::post('/booking/paymentwithPayzone', [FrontBookingController::class, 'paymentwithPayzone'])->name('paymentwithPayzone');
Route::post('/booking/updatePricing', [FrontBookingController::class, 'updatePricing'])->name('updatePricing');
Route::get('/c-register', [CustomerLoginController::class, 'register_customer'])->name('c-register');
Route::get('/support', [TicketsController::class, 'index'])->name('support');
Route::post('/store', [TicketsController::class, 'store'])->name('submit-ticket');
Route::post('/submit-reply', [TicketsController::class, 'submit_reply'])->name('submit-reply');
Route::post('/addNote', [BackendticketController::class, 'addNote'])->name('addNote');
Route::post('/search-ticket', [TicketsController::class, 'search_ticket'])->name('search_ticket');
Route::post('/ticket/list', [TicketsController::class, 'ticket_list'])->name('ticket_list');
Route::get('/ticket/view/{id}', [TicketsController::class, 'view'])->name('view-ticket');
Route::get('/manage-booking', [FrontBookingController::class, 'manage_booking'])->name('manage_booking');
Route::post('/booking-search', [FrontBookingController::class, 'booking_search'])->name('booking_search');
Route::post('/reSendEmailBooking', [FrontBookingController::class, 'reSendEmailBooking'])->name('reSendEmailBooking');
Route::get('airport-parking', [FrontHomeController::class, 'airportparkingpage'])->name('airportparking');
// Route::get('airport-parking', [FrontHomeController::class, 'airportparkingpageredirect'])->name("airportparking");
Route::get('rewards-and-loyalty', [FrontHomeController::class, 'rewards_and_loyalty'])->name('rewards_and_loyalty');
Route::get('car-safety', [FrontHomeController::class, 'car_safety'])->name('car_safety');
Route::get('about-us', [FrontHomeController::class, 'about_us'])->name('about_us');
Route::get('latest-news', [FrontHomeController::class, 'latest_news'])->name('latest_news');
Route::get('choose-us', [FrontHomeController::class, 'choose_us'])->name('choose-us');
Route::get('faqs', [FrontHomeController::class, 'faqs'])->name('faqs');
Route::get('reviews', [FrontHomeController::class, 'reviews'])->name('reviews');
Route::get('airport-guide', [FrontHomeController::class, 'airport_guide'])->name('airport_guide');
Route::get('airport-types', [FrontHomeController::class, 'airport_types'])->name('airport_types');
Route::post('/subscribe_user', [FrontHomeController::class, 'subscribe_user'])->name('subscribe_user');
Route::post('/subscribe_user_and_discount', [FrontHomeController::class, 'subscribe_user_and_discount'])->name('subscribe_user_and_discount');
Route::get('/airport-transfer', [FrontHomeController::class, 'airporttransfer'])->name('airporttransfer');
Route::get('/lounges', [FrontHomeController::class, 'lounges'])->name('lounges');
Route::get('/feedback', [FrontHomeController::class, 'feedback'])->name('feedback');
Route::post('/feedback', [FrontHomeController::class, 'store'])->name('submit-feedback');
Route::get('/contact-us', [FrontHomeController::class, 'contact'])->name('contact-us');

Route::get('all-airport', [FrontHomeController::class, 'allairport']);
Route::get('/author', [FrontHomeController::class, 'author'])->name('author');

//admin routes

 Route::get('/admin/settings/offDays', [SettingsController::class, 'offDays'])->name("offDays");
 
Route::get('/admin/settings/offDays/create', [SettingsController::class, 'offDaysCreate'])->name('offDaysCreate');
Route::get('/admin/settings/offDays/edit/{id}', [SettingsController::class, 'offDaysEdit'])->name('offDaysEdit');
Route::post('/admin/settings/offDays/save', [SettingsController::class, 'offDaysSave'])->name('offDaysSave');
Route::post('/admin/settings/offDays/update', [SettingsController::class, 'offDaysUpdate'])->name('offDaysUpdate');
Route::delete('/admin/settings/offDays/{id}', [SettingsController::class, 'destroyOffDays'])->name('destroyOffDays');

Route::get('/admin', [dashboard::class, 'index']);

Route::get('/admin/coming-soon', function () {
    return view('admin.coming_soon');
})->name('coming-soon');
Route::get('/admin/agent_statistic', [InvoicesController::class, 'agent_statis'])->name('agent.statis');
Route::get('/admin/agent_statistics', [InvoicesController::class, 'agent_statis_search'])->name('agent.statis.search');

Route::get('/admin/company/setPlan', [CompaniesProductPriceController::class, 'setPlan'])->name('setPlan');
Route::get('/admin/company/delPlan/{id}', [CompaniesProductPriceController::class, 'delPlan'])->name('delPlan');
Route::get('/admin/company/viewEditPlan', [CompaniesProductPriceController::class, 'viewEditPlan'])->name('viewEditPlan');
Route::get('/admin/company/getPlanPrices/{id}', [CompaniesProductPriceController::class, 'getPlanPrices'])->name('getPlanPrices');
Route::get('/admin/company/valetPlan', [CompaniesProductPriceController::class, 'valetPlan'])->name('valetPlan');
Route::post('/admin/company/updateValetProductPrices', [CompaniesProductPriceController::class, 'updateValetProductPrices'])->name('updateValetProductPrices');
Route::get('/admin/company/getTerminals/{id}', [CompanyController::class, 'getTerminalsByAirportId'])->name('getterminals');
Route::get('/admin/company/getPlanView/{id}/{plan_type}/{agent_id}', [CompaniesProductPriceController::class, 'getProductPricePlanView'])->name('getplanview');
Route::get('/admin/company/getCompanySetPlanView/{id}/{year}/{month}/{plan_type}/{agent_id}', [CompaniesProductPriceController::class, 'getCompanySetPlanView'])->name('getCompanySetPlanView');
Route::get('/admin/booking/add', [BookingController::class, 'create'])->name('add-booking');
Route::get('/admin/booking/add', [BookingController::class, 'create'])->name('add-booking');
Route::post('/admin/booking/get-quote', [BookingController::class, 'getQuote'])->name('getQuote');
Route::get('/admin/booking/incomplete', [BookingController::class, 'incomplete_Booking'])->name('incomplete_Booking');
Route::get('/admin/booking/departure', [BookingController::class, 'departure_Booking'])->name('departure_Booking');
Route::get('/admin/booking/valet', [BookingController::class, 'valet_Booking'])->name('valet_Booking');
Route::get('/admin/booking/arrival', [BookingController::class, 'arrival_Booking'])->name('arrival_Booking');
Route::get('/admin/booking/pickup', [BookingController::class, 'pickup_bookings'])->name('pickup.bookings');
Route::get('/admin/booking/not/picked/returned', [BookingController::class, 'notPickedReturnedReport'])->name('not.picked.returned');
Route::get('/admin/booking/parsed_emails_report', [BookingController::class, 'parsed_emails_report'])->name('parsed.emails.report');
Route::get('/admin/booking/export/filtered/data', [BookingController::class, 'exportFilteredData'])->name('export.filtered.data');
Route::get('/admin/booking/net/earning', [BookingController::class, 'netEarnings'])->name('net.earnings');
Route::get('/admin/booking/gross/earning', [BookingController::class, 'grossEarnings'])->name('gross.earnings');
Route::get('/admin/booking/bookinghistroy', [BookingController::class, 'bookinghistroy'])->name('bookinghistroy');
Route::get('/admin/banner/banner_list', [SettingsController::class, 'bannerlist'])->name('banner_list');
Route::post('/admin/banner/banner_list', [SettingsController::class, 'UploadBannerList'])->name('upload_banner_list');
Route::get('/admin/tickets/getNewMessages', [BackendticketController::class, 'getNewMessages'])->name('getNewMessages');
Route::get('/admin/reports/airport_commission_report', [InvoicesController::class, 'ParkingzoneDeailCommissionReport'])->name('airport_commission_report');
Route::get('/admin/reports/CompanyCommissionReport', [InvoicesController::class, 'CompanyCommissionReport'])->name('company_report');
Route::get('/admin/reports/CompanyReportExcelPZ', [InvoicesController::class, 'CompanyReportExcelPZ'])->name('companypz_report_excel');
Route::get('/admin/reports/CompanyReportExcel', [InvoicesController::class, 'CompanyReportExcel'])->name('company_report_excel');
Route::get('/admin/reports/invoiceOperationExcel', [InvoicesController::class, 'invoiceOperationExcel'])->name('invoice_operation_report_excel');
Route::get('/admin/reports/invoiceOperation', [InvoicesController::class, 'invoiceOperation'])->name('invoice_commission_report');
Route::get('/admin/dsp/dsp', [BookingController::class, 'dsp'])->name('dsp');
Route::get('/admin/dsp/dspview', [BookingController::class, 'dspview'])->name('dspview');
Route::get('/admin/myticket', [BackendticketController::class, 'myticket'])->name('myticket');
Route::get('/admin/myticket/view/{id}', [BackendticketController::class, 'myticketview'])->name('myticketview');
Route::get('/admin/booking', [BookingController::class, 'index'])->name('booking');
Route::get('/admin/allBookings', [BookingController::class, 'allBookings'])->name('allBookings');
Route::get('/admin/booking/external', [BookingController::class, 'externalBooking'])->name('external_booking');
Route::get('/admin/booking/update/type', [BookingController::class, 'bookingUpdatePickupReturnStatus'])->name('booking.update.pickup.return.status');
Route::get('admin/booking_agent', [BookingController::class, 'booking_agent'])->name('booking_agent');
Route::post('/admin/booking/incomplete', [BookingController::class, 'search'])->name('Incomplete');
Route::get('/admin/ticket/updateTicketStatus/{id}', [BackendticketController::class, 'updateTicketStatus'])->name('updateTicketStatus');
Route::post('/admin/ticket/assignTicket', [BackendticketController::class, 'assignTicket'])->name('assignTicket');
Route::get('/admin/daily_report', [BookingController::class, 'daily_report'])->name('daily_report');
Route::get('/admin/daywisereport', [BookingController::class, 'daywisereport'])->name('day_wise_Booking');
Route::get('/admin/capacity/report', [BookingController::class, 'overnightreport'])->name('capacity.report');
Route::get('/admin/supplier/segregation/report', [BookingController::class, 'supplierSegregationReport'])->name('supplier.segregation.report');
Route::get('/admin/reports/company_departure_commission_report', [InvoicesController::class, 'CompanyDepartureCommissionReport'])->name('company_departure_report');
Route::get('/admin/reports/CompanyDepartureReportExcel', [InvoicesController::class, 'departureReport'])->name('company_departure_report_excel');
Route::get('/admin/reports/CompanyDepartureDetailReportExcel', [InvoicesController::class, 'returnReport'])->name('company_arrival_report_excel');
Route::get('/admin/invoices', [InvoicesController::class, 'searchForm'])->name('searchForm');
Route::post('/admin/invoices', [InvoicesController::class, 'searchForm'])->name('searchFormSubmit');
Route::get('/admin/exportinvoice', [InvoicesController::class, 'invoicesDetailInvoice'])->name('invoicesDetailInvoice');
Route::get('/admin/invoicesummery', [InvoicesController::class, 'invoiceSummery'])->name('invoiceSummery');
Route::get('/admin/booking_card', [BookingController::class, 'printcards'])->name('print-card');
Route::get('/admin/show_card/{id}', [BookingController::class, 'show_card'])->name('show_card');
Route::get('/admin/print_card_pdf', [BookingController::class, 'print_card_pdf'])->name('print_card_pdf');
Route::post('/admin/booking/admin_add_booking', [BookingController::class, 'store'])->name('admin_add_booking');
Route::post('/admin/booking/add/createPaymentLink', [BookingController::class, 'stripePaymentLink'])->name('createPaymentLink');
Route::post('/admin/booking/cancelFormAction', [BookingController::class, 'cancelFormAction'])->name('cancelFormAction');
Route::post('/admin/company/updateProductPrices/', [CompaniesProductPriceController::class, 'updateProductPrices']);
Route::post('/admin/company/setCompanyPlanPrices/', [CompaniesProductPriceController::class, 'setCompanyPlanPrices']);
Route::get('/admin/settings/seo-setting', [SettingsController::class, 'seo_setting'])->name('seo_setting');
Route::get('/admin/settings/social-setting', [SettingsController::class, 'social_setting'])->name('social_setting');
Route::get('/admin/settings/company-setting', [SettingsController::class, 'company_setting'])->name('company_setting');
Route::get('/admin/settings/email-setting', [SettingsController::class, 'email_setting'])->name('email_setting');
Route::get('/admin/settings/homepage-setting', [SettingsController::class, 'homepage_setting'])->name('homepage_setting');
Route::get('/admin/settings/service-page-setting', [SettingsController::class, 'services_page_setting'])->name('services_page_setting');
Route::get('/admin/settings/general-setting', [SettingsController::class, 'general_setting'])->name('general_setting');
Route::get('/admin/settings/footer-setting', [SettingsController::class, 'footer_setting'])->name('footer_setting');
Route::get('/admin/settings/analytics-setting', [SettingsController::class, 'analytics_setting'])->name('analytics_setting');
Route::post('/admin/settings/update', [SettingsController::class, 'update'])->name('settings.update');
Route::post('/admin/settings/updateModuleSettings', [SettingsController::class, 'updateModuleSettings'])->name('settings.updateModuleSettings');
Route::post('/admin/booking/sendEmailBooking', [BookingController::class, 'sendEmailBooking'])->name('booking.sendEmailBooking');
Route::post('/admin/booking/showdetail', [BookingController::class, 'showdetail'])->name('bookingdetail.show');
Route::post('/admin/booking/cancelForm', [BookingController::class, 'cancelForm'])->name('bookingdetail.cancelForm');
Route::post('/admin/booking/refundForm', [BookingController::class, 'refundForm'])->name('bookingdetail.refundForm');
Route::post('/admin/booking/transferBooking', [BookingController::class, 'transferBooking'])->name('transferBooking');
Route::get('/admin/booking/cancelNotShow/{id}', [BookingController::class, 'cancelNotShow'])->name('cancelNotShow');
Route::get('/admin/role/create', [RoleController::class, 'create'])->name('roleCreate');
Route::get('/admin/role/getMenusByIdjson/{id}', [RoleController::class, 'getMenusByIdjson'])->name('getMenusByIdjson');
Route::get('/admin/role/getRolesDD', [RoleController::class, 'getRolesDD'])->name('getRolesDD');
Route::post('/admin/role/updateMenuSortOrder', [RoleController::class, 'updateMenuSortOrder'])->name('updateMenuSortOrder');
Route::post('/admin/role/createRole', [RoleController::class, 'createRole'])->name('createRole');
Route::post('/admin/role/creat_clone', [RoleController::class, 'creat_clone'])->name('creat_clone');
Route::post('/admin/role/insertMenu', [RoleController::class, 'insertMenu'])->name('insertMenu');
Route::post('/admin/role/getEdata', [RoleController::class, 'getEdata'])->name('getEdata');
Route::post('/admin/role/delMenu', [RoleController::class, 'delMenu'])->name('delMenu');
Route::post('/admin/booking/update/{id}', [BookingController::class, 'update'])->name('admin_update_booking');
Route::get('/admin/booking/edit/{id}', [BookingController::class, 'edit'])->name('edit_booking_form');
Route::post('/admin/temporary/booking/save', [BookingController::class, 'storeTemporaryBookings'])->name('temporary.bookings.save');
Route::get('/admin/booking/transferBooking/{id}', [BookingController::class, 'transferBookingForm'])->name('transferBookingForm');
Route::put('/admin/users/update/{airports}', [UserController::class, 'update_user'])->name('update_user');

//register
Route::get('/admin/users/create', [UserController::class, 'register_form'])->name('register_form');
Route::get('/admin/users/edits/{id}', [UserController::class, 'edit_register_form'])->name('edit_register_forms');

Route::post('/admin/users/create', [UserController::class, 'register'])->name('registerstore');
Route::get('/admin/users', [UserController::class, 'index'])->name('user_list');
Route::get('/admin/api-client', [UserController::class, 'api_client'])->name('api_client');
Route::get('/admin/api-client-register', [UserController::class, 'register_api_client'])->name('register_api_client');
//
Route::post('/admin/users/{id}', [UserController::class, 'deleteapiclient'])->name('deleteapiclient');
Route::get('/admin/users/edit/{id}', [UserController::class, 'edit_api_client'])->name('edit_api_client');

Route::post('/admin/api-client-register', [UserController::class, 'storeapiclient'])->name('storeapiclient');

Route::post('/api-client/update/{id}', [UserController::class, 'editapiclient'])->name('updateapiclient');


Route::delete('/admin/users/{id}', [UserController::class, 'delete'])->name('delete_user');
Route::get('/admin/users/getPermissions/{role_name}', [UserController::class, 'getRolesPermissions'])->name('getRolesPermissions');
Route::get('/admin/booking/booking_report_pdf', [BookingController::class, 'admin_booking_report_pdf'])->name('admin_booking_report_pdf');
Route::get('/admin/booking/booking_report_excel', [BookingController::class, 'admin_booking_report_excel'])->name('admin_booking_report_excel');
Route::get('/admin/booking/booking_report_excel_agent', [BookingController::class, 'admin_booking_report_excel_agent'])->name('admin_booking_report_excel_agent');
Route::get('/admin/booking/booking_report_pdf_agent', [BookingController::class, 'booking_report_pdf_agent'])->name('admin_booking_report_pdf_agent');
Route::get('/admin/send_sms/{number}/{ref}', [SMSController::class, 'send_sms'])->name('send_sms');
Route::get('/admin/parsed_emails', [ParsedEmailsController::class, 'index'])->name('parsed_emails');
Route::get('/admin/parsed_emails/view/{id}', [ParsedEmailsController::class, 'view'])->name('parsed_emails_view');
Route::get('/admin/export_subscriber_excel', [SubscribersController::class, 'export_subscriber_excel'])->name('export_subscriber_excel');
Route::get('/admin/export_customer_excel', [CustomerController::class, 'export_customer_excel'])->name('export_customer_excel');

Route::resource('/admin/airport', AirportController::class);
Route::resource('/admin/company', CompanyController::class);
Route::resource('/admin/agent', PartnersController::class);
Route::resource('/admin/awards', AwardsController::class);
Route::resource('/admin/company/plan', CompaniesProductPriceController::class);
Route::resource('/admin/pages', PagesController::class);
Route::resource('/admin/faqs', FaqsController::class);
Route::resource('/admin/reviews', ReviewsController::class);
Route::resource('/admin/subscribers', SubscribersController::class);
Route::resource('/admin/customers', CustomerController::class);
Route::resource('/admin/discounts', DiscountsController::class);
Route::resource('/admin/emails', EmailTemplatesController::class);

Route::get('/customer-login', [CustomerLoginController::class, 'index'])->name('customer-login');
Route::get('/forget-customer-pasword', [CustomerLoginController::class, 'forget_customer_pasword'])->name('forget-customer-pasword');
Route::post('/send-reset-password-email', [CustomerLoginController::class, 'sendResetPasswordEmail'])->name('send.reset.link');
Route::get('/change-password', [CustomerLoginController::class, 'change_password'])->name('change-password');
Route::get('/customer/admin', [CustomerHomeController::class, 'index'])->name('customer-admin');
Route::get('/customer/admin/manage-booking', [CustomerHomeController::class, 'manage_booking'])->name('customer-manage-booking');
Route::get('/customer/admin/manage-history', [CustomerHomeController::class, 'booking_history'])->name('customer-manage-history');
Route::get('/customer/admin/support-tickets', [CustomerHomeController::class, 'support_tickets'])->name('customer-support-tickets');
Route::get('/customer/admin/view-tickets/{id}', [CustomerHomeController::class, 'viewTicket'])->name('customer.ticket.view');
Auth::routes();

// customer routes
Route::group(['prefix' => 'customers'], function () {
    Route::post('/register', [FrontCustomerController::class, 'save'])->name('post_register');
    Route::post('/login', [FrontCustomerController::class, 'loginCheck'])->name('post_login');
    Route::get('logout', [FrontCustomerController::class, 'logout'])->name('logout');
    Route::post('/forget-password', [FrontCustomerController::class, 'submitForgetPassword'])->name('post_forget_password');
    Route::post('/reset-password', [FrontCustomerController::class, 'submitResetPassword'])->name('post_reset_password');
});

Route::group(['prefix' => 'customers/password'], function () {
    Route::post('password/email', [FrontCustomerController::class, 'sendResetLinkEmail'])->name('customer.password.email');
    Route::get('reset/{token}', [FrontCustomerController::class, 'showResetForm'])->name('customer.password.reset');
    Route::post('password/reset', [FrontCustomerController::class, 'reset'])->name('customer.password.update');
});

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('adminLogout');
Route::get('{page}', [FrontHomeController::class, 'static_page'])->name('static_page');
Route::get('/{slug}', [FrontHomeController::class, 'pages'])->name("page");
Route::get('/admin/agentbooking', [BookingController::class, 'agentbooking'])->name('agentbooking');
Route::get('/cron/incomplete', [CronController::class, 'index'])->name('cron_incomplete');
Route::get('/cron/incompletesms', [CronController::class, 'sendsms_incomplete'])->name('cron_incomplete_sms');
Route::get('/cron/mailchimp', [CronController::class, 'sendmails_mailchimp'])->name('mailchimp');

Route::group(['prefix' => 'review'], function () {
    Route::post('submit', [ReviewController::class, 'submitReview'])->name('review.submit');
    Route::post('services', [ReviewController::class, 'submitReview'])->name('review.service');
});

Route::group(['prefix' => 'file'], function () {
    Route::get('read/email', [ReviewController::class, 'readEmails'])->name('read.email');
});

Route::get('/cron/mailchimp', [CronController::class, 'sendmails_mailchimp'])->name('mailchimp');

Route::post('receive/payment/webhook', [WebhookController::class, 'receivePayment'])->name('webhook.receive.payment');
