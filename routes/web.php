<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CcaController;
use App\Http\Controllers\ConvenFeeController;
use App\Http\Controllers\DyteController;
use App\Http\Controllers\EndCategoryController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CronjobController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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

Route::get('admin', [AdminController::class, 'index'])->name('login');
Route::post('admin', [AuthController::class, 'index'])->name('login.store');

Route::prefix('admin')->group(function () {
    Route::get('forget-password', [AdminController::class, 'forget'])->name('admin.forget');
});
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile', [AdminController::class, 'profile_update'])->name('profile_update_admin');
    Route::get('join-request', [AdminController::class, 'join_request'])->name('join_request');
    Route::get('join-request/view/{id}', [AdminController::class, 'join_request_view'])->name('join_request.view');
    Route::get('join-request/create/{id}', [AdminController::class, 'join_request_create'])->name('join_request.create');
    Route::post('join-request/accept', [AdminController::class, 'join_request_accept'])->name('join_request.accept');
    Route::post('join-request/reject', [AdminController::class, 'join_request_reject'])->name('join_request.reject');
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('endcategory', EndCategoryController::class);
    Route::resource('experts', ExpertController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('conven_fee', ConvenFeeController::class);
    Route::resource('video', VideoController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('refund', RefundController::class);
    Route::resource('policy', PolicyController::class);
    Route::get('expert_verify/{id}', [ExpertController::class, 'expert_verify'])->name('expert.verify');
    Route::get('expert_reenter/{id}', [ExpertController::class, 'expert_reenter'])->name('expert.edit');
    Route::get('bookings', [CartController::class, 'index'])->name('bookings');
    Route::get('sessions/{url}/{id}', [SlotController::class, 'index'])->name('sessions');
    // Route::get('sessions/closed', [SlotController::class, 'index'])->name('closed-sessions');
    // Route::get('sessions/cancel', [SlotController::class, 'index'])->name('cancel-sessions');
    Route::get('verification-pending', [ExpertController::class, 'pending_to_accept'])->name('pending_to_accept');
    Route::get('expert-statics', [AdminController::class, 'expert_statics'])->name('expert-statics');
    Route::get('get_excel_expert', [ExpertController::class, 'export'])->name('expert.export');
    Route::get('get_excel_client', [UserController::class, 'export'])->name('user.export');
    Route::get('subscribers', [AdminController::class, 'subscribers'])->name('subscribers');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('financial-report', [AdminController::class, 'financial_report'])->name('financial_report');
    Route::get('user-sessions/{id}', [CartController::class, 'usersessions'])->name('usersessions.show');
    Route::get('contact-details', [AdminController::class, 'contact_details']);
    Route::post('contact-details', [AdminController::class, 'save_contact_details']);
    Route::get('reschedule/{id}', [AdminController::class, 'reschedule'])->name('reschedule.admin');
    Route::put('reschedule/{id}', [AdminController::class, 'update_reschedule'])->name('reschedule.update.admin');
    Route::get('cancel-booking/{id}', [AdminController::class, 'cancel_booking'])->name('cancel_booking.admin');
    Route::post('cancel-booking/{id}', [AdminController::class, 'cancel_booking_store'])->name('cancel_booking.store');
    Route::get('session-details/{id}', [SlotController::class, 'show'])->name('session_details.admin');
    Route::get('logout', [AdminController::class, 'logout']);
    Route::delete('account-close', [ExpertController::class, 'destroy'])->name('close_account_expert');
    Route::post('mark_completed/{id}', [ExpertController::class, 'mark_completed'])->name('mark_completed.admin');
    Route::get('gallery-image', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('gallery-image', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery-image/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::put('gallery-image/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::get('admin-expert-edit', [ExpertController::class, 'expert_edit'])->name('expert_edit.admin');
    Route::post('admin-expert-edit/{id}', [ExpertController::class, 'expert_update_admin'])->name('expert_update.admin');
    Route::get('expert-calendar', [ExpertController::class, 'calendar'])->name('calendar.admin');
    Route::get('sessions-report', [AdminController::class, 'session_reports'])->name('session_reports');
    Route::get('user-sessions', [AdminController::class, 'user_sessions'])->name('user_sessions');
    Route::post('sessions_report_exports', [ExportController::class, 'sessions_report_exports'])->name('sessions_report_exports');
    Route::post('user_sessions_exports', [ExportController::class, 'user_sessions_exports'])->name('user_sessions_exports');
    Route::get('open_slots', [AdminController::class, 'open_slots'])->name('open_slots');
});

Route::prefix('export')->middleware(['auth'])->group(function () {
    Route::get('sessions', [ExportController::class, 'sessions'])->name('export.sessions');
});
Route::prefix('expert')->middleware(['auth', 'isExpert'])->group(function () {
    Route::get('dashboard', [ExpertController::class, 'dashboard'])->name('expert.dashboard');
    Route::get('expert_close_request', [ExpertController::class, 'expert_close_request'])->name('expert_close_request');
    Route::get('calendar', [ExpertController::class, 'calendar'])->name('calendar');
    Route::post('mark_completed/{id}', [ExpertController::class, 'mark_completed'])->name('mark_completed');
    Route::get('schedules/{url}/{id}', [ExpertController::class, 'schedules'])->name('schedules');
    Route::get('setting', [ExpertController::class, 'edit'])->name('setting.expert');
    Route::put('setting', [ExpertController::class, 'update'])->name('expert.update');
    Route::resource('slot', SlotController::class);
    Route::post('join-call', [DyteController::class, 'join_call']);
    Route::get('join-call', [DyteController::class, 'join_call']);
    Route::get('plans', [ExpertController::class, 'plans'])->name('plans');
    Route::post('purchase-plans', [ExpertController::class, 'purchase_plan'])->name('purchase_plan');
    Route::get('export-sessions/{url}/{id}', [ExportController::class, 'sessions_export'])->name('export.sessions');
    Route::get('export-edit', [ExpertController::class, 'expert_edit'])->name('expert_edit');
    Route::post('export-edit/{id}', [ExpertController::class, 'expert_update'])->name('expert_update');
    Route::get('myleads', [ExpertController::class, 'myleads'])->name('myleads');
    Route::get('/transactions', [ExpertController::class, 'expert_wallet'])->name('expert_wallet');
    Route::get('/photos', [ExpertController::class, 'add_photos'])->name('expert_photos');
    Route::post('/photos', [ExpertController::class, 'save_photo'])->name('expert_photos.store');
    Route::get('/reviews', [ExpertController::class, 'reviews'])->name('expert_reviews');
    Route::get('/profile', [ExpertController::class, 'profile'])->name('expert_profile');
});
Route::post('expert/slot-delete', [SlotController::class, 'destroy']);
Route::middleware('auth')->group(function () {
    Route::post('/send-message', [PusherController::class, 'sendMessage'])->name('send-message');
    Route::post('/receive', [PusherController::class, 'receive'])->name('receive_message');
    Route::get('/chat', [PusherController::class, 'chat'])->name('chat');
});
Route::prefix('user')->middleware(['auth', 'isUser'])->group(function () {
    Route::get('setting', [UserController::class, 'edit'])->name('setting');
    Route::put('setting', [UserController::class, 'update'])->name('user.update');
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('consultation-schedules', [UserController::class, 'consultation'])->name('consultation.schedules');
    Route::post('consultation-schedules', [UserController::class, 'join_meet']);
    Route::get('join-call', [DyteController::class, 'join_call']);
    Route::get('make-schedule/{id}', [UserController::class, 'make_schedule'])->name('make_schedule');
    Route::post('make-schedule/{id}', [UserController::class, 'save_schedule'])->name('make_schedule.update');
    Route::get('reschedule/{id}', [UserController::class, 'reschedule'])->name('reschedule');
    Route::post('reschedule/{id}', [UserController::class, 'update_reschedule'])->name('reschedule.update');
    Route::put('cancel_booking/{id}', [UserController::class, 'cancel_booking'])->name('cancel_booking');
    Route::get('packages', [UserController::class, 'mypackages'])->name('mypackages');
    Route::get('mypayments', [UserController::class, 'mypayments'])->name('mypayments');
});
Route::prefix('ajax')->middleware('auth')->group(function () {
    Route::post('get_sub_category', [AjaxController::class, 'get_sub_category']);
    Route::post('get_events', [AjaxController::class, 'get_events']);
    Route::post('get_payment_details', [AjaxController::class, 'get_payment_details']);
    Route::post('lead/assign', [ExpertController::class, 'assign_lead'])->name('assign_lead');
});
Route::prefix('ajax')->group(function () {
    Route::post('get_sub_category_question', [AjaxController::class, 'get_sub_category_question']);
    Route::post('get_end_category_question', [AjaxController::class, 'get_end_category_question']);
    Route::post('getCityByState', [AjaxController::class, 'getCityByState']);
    Route::post('get_packages', [AjaxController::class, 'get_packages']);
    Route::post('get_slot', [AjaxController::class, 'get_slot']);
    Route::post('get_posts', [AjaxController::class, 'get_posts']);
    Route::post('get_slot_count', [AjaxController::class, 'get_slot_count']);
    Route::post('get_packages', [AjaxController::class, 'get_packages']);
    Route::post('slot/create', [SlotController::class, 'store'])->name('slot.create');
    Route::post('getslot', [AjaxController::class, 'test']);
    Route::post('send_otp', [AjaxController::class, 'send_otp']);
    Route::post('validate_otp', [AjaxController::class, 'validate_otp']);
    Route::post('set_password', [AjaxController::class, 'set_password']);
    Route::post('getexpert_by_category ', [AjaxController::class, 'getexpert_by_category']);
    Route::post('get_client_details ', [AjaxController::class, 'get_client_details']);
    Route::post('get_mobile_number ', [AjaxController::class, 'get_mobile_number']);
    Route::post('get_chats', [AjaxController::class, 'get_chats'])->name('get_chats');
    Route::post('handlegalleryimage', [AjaxController::class, 'handlegalleryimage'])->name('handlegalleryimage');
    Route::post('request-call-back', [HomeController::class, 'send_callback_request'])->name('send_callback_request');
    Route::post('send-otp', [HomeController::class, 'send_otp'])->name('send_otp');
    Route::post('verify-otp', [HomeController::class, 'verify_otp'])->name('verify_otp');
    Route::post('/leads/show-details', [ExpertController::class, 'show_lead_details'])->name('leads.show');
    Route::post('send_otps', [ExpertController::class, 'send_otps'])->name('send_otps');
    Route::post('verify_otps', [ExpertController::class, 'verify_otps'])->name('verify_otps');
    Route::post('expert/create/save', [ExpertController::class, 'store'])->name('expert.save');
});


Route::get('/', [HomeController::class, 'index']);
Route::get('about', [HomeController::class, 'about']);
Route::post('subscribe', [HomeController::class, 'subscribe']);
Route::any('thank-you', [HomeController::class, 'subscribe']);
Route::get('subscribe', [HomeController::class, 'subscribe_show']);
Route::get('expert-thank-you', [HomeController::class, 'expert_fill_thank_you'])->name('expert.thankyou');
Route::get('gallery', [GalleryController::class, 'index']);
Route::get('counselling/{slug?}', [HomeController::class, 'counselling']);
Route::get('coaching', [HomeController::class, 'coaching']);
Route::get('counsellers', [HomeController::class, 'counsellers']);
Route::post('counselling-contact-Us', [HomeController::class, 'contactUs'])->name('contactForm');
Route::get('coaches', [HomeController::class, 'coaches']);
Route::get('self-help', [HomeController::class, 'self_heleper']);
Route::get('contact-us', [HomeController::class, 'contact']);
Route::get('blogs', [HomeController::class, 'blogs']);
Route::get('blogs', [HomeController::class, 'blogs']);
Route::get('videos', [HomeController::class, 'videos']);
Route::get('ask', [HomeController::class, 'ask']);
Route::post('contact-us', [HomeController::class, 'save_ask']);
Route::get('csr', [HomeController::class, 'csr']);
Route::get('forgot-password', [HomeController::class, 'forgot_password']);
Route::get('employee-engagement-programme', [HomeController::class, 'eep']);
Route::get('mental-health-assessments', [HomeController::class, 'mental_health_assessments'])->name('mental_health_assessments');
Route::post('mental-health-contact', [HomeController::class, 'mental_health_contact'])->name('mental_health_contact');
Route::get('opening-position', [HomeController::class, 'opening_position']);
Route::get('expert-talk', [HomeController::class, 'expert_talk']);
Route::get('meditation', [HomeController::class, 'mediation']);
Route::get('sprituality', [HomeController::class, 'sprituality']);
Route::get('expert-join', [HomeController::class, 'expert_join']);
Route::get('join-as', [HomeController::class, 'join_as']);
Route::get('signup-user', [HomeController::class, 'signup_user']);
Route::post('signup-user', [HomeController::class, 'signup_user_store'])->name('signup_user.store');
Route::get('signup', [HomeController::class, 'signup']);
Route::post('signup', [HomeController::class, 'signup_store'])->name('signup.store');
Route::get('login', [HomeController::class, 'login']);
Route::get('find-expert', [HomeController::class, 'find_expert']);
Route::post('find-expert', [HomeController::class, 'find_expert_save'])->name('find_expert.store');
Route::post('login', [HomeController::class, 'login_auth'])->name('user.login');
Route::resource('cart', CartController::class);
Route::get('book-now/{url}', [HomeController::class, 'book_now']);
Route::get('payment-response/{id}', [CcaController::class, 'payment_response']);
Route::post('response_payment_handler', [CcaController::class, 'ccAvenueResponse'])->name('response_payment_handler');
Route::get('checkout', [CartController::class, 'show']);
Route::get('logout', [HomeController::class, 'logout']);
Route::post('logout', [HomeController::class, 'logout'])->name('logout');
Route::get('faqs', [HomeController::class, 'faqs'])->name('faq.findex');
Route::get('reminder', [CronjobController::class, 'reminder'])->name('reminder');
Route::post('checkout', [CcaController::class, 'make_payment']);
Route::get('policy/{url}', [HomeController::class, 'policy']);
Route::get('profile/{url}', [ExpertController::class, 'show']);
Route::get('article/{url}', [HomeController::class, 'show_blog']);
Route::get('success-registration/{id}', [HomeController::class, 'success_registration']);
Route::post('expert/create', [ExpertController::class, 'create'])->name('expert.register');

Route::post('join-request/create/{id}', [AdminController::class, 'join_request_store'])->name('join_request.store');
Route::get('/leads', [ExpertController::class, 'leads'])->name('leads');
Route::post('/review', [ExpertController::class, 'save_reivew'])->name('review.store');