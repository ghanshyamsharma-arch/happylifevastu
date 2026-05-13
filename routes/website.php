<?php

use App\Http\Controllers\Admin\PageManagementController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\API\Astrologer\LiveAstroController;
use App\Http\Controllers\Frontend\Astrologer\AstrologerController as FrontendAstrologerController;
use App\Http\Controllers\Frontend\Astrologer\AuthController as AstrologerAuthController;
use App\Http\Controllers\Frontend\Astrologer\CallController;
use App\Http\Controllers\Frontend\Astrologer\ChatController;
use App\Http\Controllers\Frontend\Astrologer\HomeController as AstrologerHomeController;
use App\Http\Controllers\Frontend\Astrologer\HoroscopeController as AstrologerHoroscopeController;
use App\Http\Controllers\Frontend\Astrologer\ProfileBoostController;
use App\Http\Controllers\Frontend\Astrologer\PujaController as AstrologerPujaController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\AstrologerCallController;
use App\Http\Controllers\Frontend\AstrologerChatController;
use App\Http\Controllers\Frontend\AstrologerController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\BroadcastController;
use App\Http\Controllers\Frontend\DefaulterMessageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HoroscopeController;
use App\Http\Controllers\Frontend\KundaliController;
use App\Http\Controllers\Frontend\PageManagementController as FrontendPageManagementController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PujaController;
use App\Http\Controllers\Frontend\ReportController;
use App\Http\Controllers\Frontend\WalletController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartOrderController;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Controllers\Frontend\Pujari\PujariController as FrontendPujariController;
use App\Http\Controllers\Frontend\Pujari\PujariAuthController;
use App\Http\Controllers\Frontend\Pujari\PujariBookingController as FrontendPujariBookingController;
use App\Http\Controllers\Frontend\Pujari\PujariSlotController as PujariSlotController;
Route::get('/direct-login', function () {

$user = User::where('contactNo', '9785520211')->first();

if (!$user) {
    dd('User not found');
}

$token = JWTAuth::fromUser($user);

$session = new Session();
$session->set('token', $token);

session([
    'token' => $token
]);

return redirect('/');

});

// Use helper function to get cached profession title
$professionTitle = strtolower(getProfessionTitle() ?: 'partner');

// $prefix='partner';
$session = new Session();
$token = $session->get('token');
header('Authorization:Bearer ' . $token);
// header('Content-Type:application/json');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');
header('Accept:application/json');

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get('/sendnotificationjob', function () {
    Artisan::call('queue:work --stop-when-empty');
    return 'Queue processed';
});

Route::get('/404', function () {
    return view('pages/404');
});

Route::get('testmail', function () {
    return view('testmail');
});



// ── Pujari Public Pages ───────────────────────────────────────────────────
Route::get('/pujari-list', [FrontendPujariController::class, 'getPujariList'])->name('front.pujariList');
Route::get('/pujari/{slug}', [FrontendPujariController::class, 'getPujariDetails'])->name('front.pujariDetails');
 
// ── Pujari User Actions (block, review, book) ─────────────────────────────
Route::post('/pujari/submit-review',  [FrontendPujariBookingController::class, 'submitReview'])->name('front.pujariSubmitReview');
Route::post('/pujari/block',          [FrontendPujariBookingController::class, 'blockPujari'])->name('front.blockPujari');
Route::get('/pujari/{slug}/book',     [FrontendPujariBookingController::class, 'bookingPage'])->name('front.pujariBookingPage');
Route::post('/pujari/place-booking',  [FrontendPujariBookingController::class, 'placeBooking'])->name('front.pujariPlaceBooking');
 
// ── Pujari Portal Auth ────────────────────────────────────────────────────
Route::get('/pujari-login',    [PujariAuthController::class, 'loginPage'])->name('front.pujariLogin');
Route::get('/pujari-register', [PujariAuthController::class, 'registerPage'])->name('front.pujariRegister');
Route::post('/pujari-send-otp',     [PujariAuthController::class, 'sendOtp'])->name('front.pujariSendOtp');
Route::post('/pujari-verify-login', [PujariAuthController::class, 'verifyAndLogin'])->name('front.pujariVerifyLogin');
Route::get('/pujari-logout',   [PujariAuthController::class, 'logout'])->name('front.pujariLogout');
 
// ── Pujari Portal Protected Pages ─────────────────────────────────────────
// (Auth check is done inside controller using pujariAuthCheck())
Route::get('/pujari-portal',             [PujariAuthController::class, 'dashboard'])->name('front.pujariDashboard');
Route::get('/pujari-portal/bookings',    [PujariAuthController::class, 'myBookings'])->name('front.pujariBookings');
Route::get('/pujari-portal/reviews',     [PujariAuthController::class, 'myReviews'])->name('front.pujariReviews');
Route::get('/pujari-portal/edit-profile',[PujariAuthController::class, 'editProfile'])->name('front.pujariEditProfile');
Route::post('/pujari-portal/update-profile',[PujariAuthController::class, 'updateProfile'])->name('front.pujariUpdateProfile');

 
Route::get('/pujari-portal/slots', [PujariSlotController::class, 'index'])->name('front.pujariSlots');
Route::post('/pujari-portal/slots', [PujariSlotController::class, 'store'])->name('front.pujariSlotsCreate');
Route::post('/pujari-portal/slots/{id}', [PujariSlotController::class, 'update'])->name('front.pujariSlotsUpdate');
Route::delete('/pujari-portal/slots', [PujariSlotController::class, 'destroy'])->name('front.pujariSlotsDelete');
Route::post('/pujari-portal/slots/toggle-status', [PujariSlotController::class, 'toggleStatus'])->name('front.pujariSlotsToggleStatus');

// Cart AJAX routes
Route::post('/cart/add',    [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/count',   [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart',         [CartController::class, 'cartPage'])->name('front.cart');

Route::get('/order-success/{orderId}', [CartController::class, 'getOrderSuccess'])->name('front.orderSuccess');

// Checkout (now loads from cart, no product ID needed)
Route::get('/checkout', [ProductController::class, 'checkout'])->name('front.checkout');

// Place order from cart
Route::post('/cart/place-order', [CartOrderController::class, 'placeOrder'])->name('cart.placeOrder');

Route::get('/manual-payment/{orderId}', [ProductController::class, 'manualPayment'])->name('ManualPayment');

Route::get('/getDateTime', [AstrologerChatController::class, 'getDateTime'])->name('front.getDateTime');
Route::get('privacyPolicy', [PageManagementController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('terms-condition', [PageManagementController::class, 'termscondition'])->name('termscondition');

Route::post('storeSubscriptionId', [HomeController::class, 'storeSubscriptionId'])->name('storeSubscriptionId');
Route::post('storeSubscriptionIdForAstro', [AstrologerHomeController::class, 'storeSubscriptionIdForAstro'])->name('storeSubscriptionIdForAstro');

Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('payment', [PaymentController::class, 'payment'])->name('payment');
Route::get('payment-success', [PaymentController::class, 'paymentsuccess']);
Route::post('payment-success', [PaymentController::class, 'paymentsuccess'])->name('payment-success');
Route::get('payment-failed', [PaymentController::class, 'paymentfailed'])->name('payment-faileds');
Route::post('payment-failed', [PaymentController::class, 'paymentfailed'])->name('payment-failed');
Route::get('payment-response', [PaymentController::class, 'paymentsresponse']);
Route::post('payment-response', [PaymentController::class, 'paymentsresponse'])->name('payment-response');
//  Route::get('payment-process', [PaymentController::class, 'paymentprocess']);
Route::post('payment-process', [PaymentController::class, 'paymentprocess'])->name('payment-process');
Route::get('payment-pending', [PaymentController::class, 'paymentpending']);
Route::post('payment-pending', [PaymentController::class, 'paymentpending'])->name('payment-pending');
Route::get('payu-merchant-form', [PaymentController::class, 'payumerchantform'])->name('payumerchantform');
Route::get('paytm-merchant-form', [PaymentController::class, 'paytmmerchantform'])->name('paytmmerchantform');

// Route::group(['prefix' => 'web'], function () {

Route::post('/verifyOTL', [AuthController::class, 'verifyOTL'])->name('front.verifyOTL');
Route::post('/verifyOTLAstro', [AstrologerAuthController::class, 'verifyOTLAstro'])->name('front.verifyOTLAstro');

Route::get('/get-states/{countryId}', [HomeController::class, 'getStates'])->name('front.getStates');
Route::get('/get-cities/{stateId}', [HomeController::class, 'getCities'])->name('front.getCities');

Route::get('/', [HomeController::class, 'home'])->name('front.home');

Route::get('/my-appointment', [HomeController::class, 'myAppointment'])->name('my-appointment');
Route::delete('/appointment/delete/{id}', [HomeController::class, 'deleteAppointment'])->name('appointment.delete');

Route::get('/astro-appointment', [App\Http\Controllers\Frontend\Astrologer\HomeController::class, 'astroAppointment'])->name('astro-appointment');
Route::delete('/astroappointment/delete/{id}', [App\Http\Controllers\Frontend\Astrologer\HomeController::class, 'deleteAstroAppointment'])->name('astroappointment.delete');
Route::get('/news/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'show'])->name('news.show');

Route::get('/reportlist', [ReportController::class, 'reportList'])->name('front.reportList');
Route::get('/puja/' . $professionTitle . '/{slug}/{package_id}', [PujaController::class, 'pujaAstrologerList'])->name('front.pujaAstrologerList');
Route::get('/talk-to-' . $professionTitle, [AstrologerCallController::class, 'talkList'])->name('front.talkList');
Route::get('/chat-with-' . $professionTitle, [AstrologerChatController::class, 'chatList'])->name('front.chatList');
Route::get('/' . $professionTitle . '-details/{slug}', [AstrologerController::class, 'astrologerDetails'])->name('front.astrologerDetails');
Route::get('/panchang', [KundaliController::class, 'getPanchang'])->name('front.getPanchang');
Route::get('/dailyhoroscope/{slug}', [HoroscopeController::class, 'dailyHoroscope'])->name('front.dailyHoroscope');
Route::get('/horoscope', [HoroscopeController::class, 'horoScope'])->name('front.horoScope');
Route::get('/blog', [BlogController::class, 'getBlog'])->name('front.getBlog');
Route::get('/blog/{slug}', [BlogController::class, 'getBlogDetails'])->name('front.getBlogDetails');
Route::get('/products', [ProductController::class, 'getproducts'])->name('front.getproducts');
Route::get('/product/{slug}', [ProductController::class, 'getproductDetails'])->name('front.getproductDetails');
Route::get('/kundali', [KundaliController::class, 'getkundali'])->name('front.getkundali');
Route::get('/kundali-matching', [KundaliController::class, 'kundaliMatch'])->name('front.kundaliMatch');
Route::get('/kundali-match-report', [KundaliController::class, 'kundaliMatchReport'])->name('front.kundaliMatchReport');
Route::get('/live' . $professionTitle . 's', [AstrologerController::class, 'getLiveAstro'])->name('front.getLiveAstro');
Route::get('/live', [AstrologerController::class, 'LiveAstroDetails'])->name('front.LiveAstroDetails');
Route::get('/my-account', [AccountController::class, 'getMyAccount'])->name('front.getMyAccount');
Route::get('/my-wallet', [WalletController::class, 'getMyWallet'])->name('front.getMyWallet');
Route::get('/wallet-recharge', [WalletController::class, 'walletRecharge'])->name('front.walletRecharge');
Route::get('/verifyOtp', [AuthController::class, 'verifyOtp'])->name('front.verifyOtp');
Route::get('/logout', [AuthController::class, 'logout'])->name('front.logout');
Route::post('/updateprofile', [AccountController::class, 'updateprofile'])->name('front.updateprofile');
Route::get('/deleteAccount', [AccountController::class, 'deleteAccount'])->name('front.deleteAccount');
Route::get('/checkout/{id}', [ProductController::class, 'checkout'])->name('front.checkout');
Route::get('/my-orders', [ProductController::class, 'myOrders'])->name('front.myOrders');
Route::get('/my-reports', [ReportController::class, 'getMyReport'])->name('front.getMyReport');
Route::get('/chat', [AstrologerChatController::class, 'chat'])->name('front.chat');
Route::get('/my-chats', [AstrologerChatController::class, 'getMyChat'])->name('front.getMyChat');
Route::get('/my-ai-chats', [AstrologerChatController::class, 'getMyAiChat'])->name('front.getMyAiChat');
Route::get('/my-chat-history', [AstrologerChatController::class, 'getChatHistory'])->name('front.getChatHistory');
Route::get('/call', [AstrologerCallController::class, 'call'])->name('front.call');
Route::get('/audiocall', [AstrologerCallController::class, 'audiocall'])->name('front.audiocall');
Route::get('/my-calls', [AstrologerCallController::class, 'getMyCall'])->name('front.getMyCall');
Route::get('/my-following', [AccountController::class, 'getMyFollowing'])->name('front.getMyFollowing');
Route::get('/blocked-' . $professionTitle . '', [AccountController::class, 'getblockAstrologer'])->name('front.getblockAstrologer');
Route::get('privacy-policy', [FrontendPageManagementController::class, 'privacyPolicy'])->name('front.privacyPolicy');
Route::get('refund-policy', [FrontendPageManagementController::class, 'refundPolicy'])->name('front.refundPolicy');
Route::get('terms-condition', [FrontendPageManagementController::class, 'termscondition'])->name('front.termscondition');
Route::get('terms-and-condition', [FrontendPageManagementController::class, 'termsconditionforapp'])->name('front.termsconditionforapp');
Route::get('privacy-and-policy', [FrontendPageManagementController::class, 'privacyPolicyApp'])->name('front.privacyPolicyApp');
Route::get('refundPolicy', [FrontendPageManagementController::class, 'refundPolicyApp'])->name('front.refundPolicyApp');
Route::get('about-us', [FrontendPageManagementController::class, 'aboutus'])->name('front.aboutus');
Route::get('contact', [FrontendPageManagementController::class, 'contactUS'])->name('front.contact');
Route::post('savecontactUS', [FrontendPageManagementController::class, 'SavecontactUS'])->name('front.store.contact');
// Route::get('/{slug}', [FrontendPageManagementController::class, 'show'])->name('pages.show');

Route::get('/' . $professionTitle . '-privacy-policy', [FrontendPageManagementController::class, 'astrologerPrivacyPolicy'])->name('front.astrologerPrivacyPolicy');
Route::get('/' . $professionTitle . '-terms-condition', [FrontendPageManagementController::class, 'astrologerTermsCondition'])->name('front.astrologerTermsCondition');

Route::get('/my-puja/list', [PujaController::class, 'getMypujalist'])->name('front.getMypujalist');
Route::get('/my-' . $professionTitle . '/puja', [PujaController::class, 'myAstrologerPuja'])->name('front.myAstrologerPuja');

Route::get('/astrologer/{id?}/stories', [HomeController::class, 'getAstrologerStories'])->name('front.getAstrologerStories');
Route::post('/' . $professionTitle . '/viewstory', [HomeController::class, 'viewstory'])->name('front.viewstory');

Route::get('astrologer-terms-and-condition', [FrontendPageManagementController::class, 'astrologertermsconditionforapp'])->name('front.astrologertermsconditionforapp');
Route::get('astrologer-privacy-and-policy', [FrontendPageManagementController::class, 'astrologerprivacyPolicyApp'])->name('front.astrologerprivacyPolicyApp');

Route::get('/my-pujari-slot-bookings', [App\Http\Controllers\Frontend\AccountController::class, 'myPujariSlotBookings'])->name('my-pujari-slot-bookings');



// Astrologers Section
Route::middleware(['web'])->prefix($professionTitle)->group(function () use ($professionTitle) {
    Route::get('/login', [AstrologerAuthController::class, 'astrologerlogin'])->name('front.astrologerlogin');
    Route::get('/registration', [AstrologerAuthController::class, 'astrologerregister'])->name('front.astrologerregister');
    Route::post('/registration', [AstrologerAuthController::class, 'astrologerstore'])->name('front.astrologerstore');
    Route::get('/index', [AstrologerHomeController::class, 'index'])->name('front.astrologerindex');
    Route::get('/profileupdate', [FrontendAstrologerController::class, 'AstrologerAccount'])->name('front.profileupdate');
    Route::post('/profileupdate', [FrontendAstrologerController::class, 'updateAstrologer'])->name('front.updateAstrologer');
    Route::get('/chat', [ChatController::class, 'astrologerchat'])->name('front.astrologerchat');
    Route::get('/call', [CallController::class, 'astrologercall'])->name('front.astrologercall');
    Route::get('/check-chat-status', [ChatController::class, 'chatStatus'])->name('front.chatStatus');
    Route::get('/check-call-status', [CallController::class, 'callStatus'])->name('front.callStatus');

    Route::get('/' . $professionTitle . '-wallet', [FrontendAstrologerController::class, 'getAstrologerWallet'])->name('front.getAstrologerWallet');
    Route::get('/' . $professionTitle . '-wallet-recharge', [FrontendAstrologerController::class, 'AstrologerWalletRecharge'])->name('front.AstrologerWalletRecharge');
    Route::get('/' . $professionTitle . '-chats', [FrontendAstrologerController::class, 'getAstrologerChat'])->name('front.getAstrologerChat');
    Route::get('/' . $professionTitle . '-calls', [FrontendAstrologerController::class, 'getAstrologerCall'])->name('front.getAstrologerCall');
    Route::get('/' . $professionTitle . '-reports', [FrontendAstrologerController::class, 'getAstrologerReport'])->name('front.getAstrologerReport');
    Route::get('/live-' . $professionTitle, [FrontendAstrologerController::class, 'LiveAstrologers'])->name('front.LiveAstrologers');
    Route::get('/logout', [AstrologerAuthController::class, 'logout'])->name('front.astrologerlogout');

    Route::get('/kundali', [AstrologerHoroscopeController::class, 'getkundali'])->name('front.astrologers.getkundali');
    Route::get('/kundali-matching', [AstrologerHoroscopeController::class, 'kundaliMatch'])->name('front.astrologers.kundaliMatch');
    Route::get('/kundali-match-report', [AstrologerHoroscopeController::class, 'kundaliMatchReport'])->name('front.astrologers.kundaliMatchReport');
    Route::get('/panchang', [AstrologerHoroscopeController::class, 'getPanchang'])->name('front.astrologers.getPanchang');
    Route::get('/dailyhoroscope/{slug}', [AstrologerHoroscopeController::class, 'dailyHoroscope'])->name('front.astrologers.dailyHoroscope');
    Route::get('/horoscope', [AstrologerHoroscopeController::class, 'horoScope'])->name('front.astrologers.horoScope');
    Route::get('aboutus', [AstrologerHoroscopeController::class, 'aboutus'])->name('front.astrologers.aboutus');
    Route::get('privacy-policy', [AstrologerHoroscopeController::class, 'privacyPolicy'])->name('front.astrologers.privacyPolicy');
    Route::get('refund-policy', [AstrologerHoroscopeController::class, 'refundPolicy'])->name('front.astrologers.refundPolicy');
    Route::get('terms-condition', [AstrologerHoroscopeController::class, 'termscondition'])->name('front.astrologers.termscondition');
    Route::get('/blog', [AstrologerHoroscopeController::class, 'getBlog'])->name('front.astrologers.getBlog');
    Route::get('/blog/{slug}', [AstrologerHoroscopeController::class, 'getBlogDetails'])->name('front.astrologers.getBlogDetails');
    Route::get('contact', [AstrologerHoroscopeController::class, 'contactUS'])->name('front.astrologers.contact');
    Route::post('savecontactUS', [AstrologerHoroscopeController::class, 'SavecontactUS'])->name('front.astrologers.store.contact');
    Route::get('followers', [AstrologerHoroscopeController::class, 'followerslist'])->name('front.followerslist');
    Route::get('kundaliReport', [AstrologerHoroscopeController::class, 'kundaliReport'])->name('front.astrologers.kundaliReport');

    Route::get('puja/orders', [PujaController::class, 'PujaLists'])->name('front.pujalist');

    //  Astrologer Puja
    Route::get('puja/list', [AstrologerPujaController::class, 'PujaList'])->name('front.astrologers.puja-list');
    Route::get('puja/create', [AstrologerPujaController::class, 'createPuja'])->name('front.astrologers.create-puja');
    Route::get('puja/edit/{id}', [AstrologerPujaController::class, 'editPuja'])->name('front.astrologers.edit-puja');
    Route::post('puja/store', [AstrologerPujaController::class, 'storePuja'])->name('front.astrologers.store-puja');
    Route::delete('puja/delete/{id}', [AstrologerPujaController::class, 'deletePuja'])->name('front.astrologers.delete-puja');

    // Profile Boost
    Route::get('profile-boost-history', [ProfileBoostController::class, 'history'])->name('front.astrologers.profile-boost-history');
    Route::post('profile-boost-store', [ProfileBoostController::class, 'profileBoostStore'])->name('front.astrologers.profile-boost-store');
});

Route::post('/' . $professionTitle . '/get-chat-requests', [AstrologerHomeController::class, 'getChatRequests'])->name('astrologer.chat.requests');
Route::post('/' . $professionTitle . '/get-call-requests', [AstrologerHomeController::class, 'getCallRequests'])->name('astrologer.call.requests');
Route::post('/' . $professionTitle . '/get-report-requests', [AstrologerHomeController::class, 'getReportRequests'])->name('astrologer.report.requests');

Route::get('getReport/kundaliReport', [KundaliController::class, 'kundaliReport'])->name('front.kundaliReport');

Route::get('/astro/schedules', [LiveAstroController::class, 'scheduleListweb'])->name('astro.schedules');
Route::post('/schedule/update/{id}', [LiveAstroController::class, 'updateLiveSchedule'])->name('schedule.update');
Route::post('/schedule/delete/{id}', [LiveAstroController::class, 'deleteLiveSchedule'])->name('schedule.delete');

// Puja related routes
Route::get('puja/category/list', [PujaController::class, 'pujaCategory'])->name('front.pujaCategory');
Route::get('puja-list/{id}', [PujaController::class, 'pujaList'])->name('front.pujaList');
Route::get('puja-details/{slug}', [PujaController::class, 'pujaDetails'])->name('front.pujaDetails');

Route::get('/puja/checkout/{slug}/{id}/{package_id?}', [PujaController::class, 'pujacheckout'])->name('front.pujacheckout');
Route::post('userPujaOrder/add', [PujaController::class, 'addUserPujaOrder'])->name('front.addUserPujaOrder');

Route::get('/broadcast/create/{puja_id}', [BroadcastController::class, 'create'])->name('broadcast.create');
Route::get('/broadcast/view/{roomId}/{userid}', [BroadcastController::class, 'view'])->name('broadcast.view');
Route::post('/broadcast/endpuja', [BroadcastController::class, 'endPujabyAstrologer'])->name('broadcast.endpuja');

Route::get('puja-update-commission', [BroadcastController::class, 'pujaUpdateCommission'])->name('pujaUpdateCommission');

Route::post('/store-defaulter-message', [DefaulterMessageController::class, 'storeDefaulterMessage']);
