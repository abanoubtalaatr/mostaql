<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Advertiser\BillingController;
use App\Http\Controllers\Advertiser\CampController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\AdController as UserAdController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TaskController as UserTaskController;
use App\Http\Livewire\Admin\Admins\Create as AdminCreate;
use App\Http\Livewire\Admin\Admins\Edit as AdminEdit;
use App\Http\Livewire\Admin\Admins\Index as AdminIndex;
use App\Http\Livewire\Admin\Category\Create as CategoryCreate;
use App\Http\Livewire\Admin\Category\Edit as CategoryEdit;
use App\Http\Livewire\Admin\Category\Index as CategoryIndex;
use App\Http\Livewire\Admin\Discount\Create as DiscountCrate;
use App\Http\Livewire\Admin\Discount\Delete as DiscountDelete;
use App\Http\Livewire\Admin\Discount\Edit as DiscountEdit;
use App\Http\Livewire\Admin\Discount\Index as DiscountIndex;
use App\Http\Livewire\Admin\Library\Create as LibraryCreate;
use App\Http\Livewire\Admin\Library\Delete as LibraryDelete;
use App\Http\Livewire\Admin\Library\Edit as LibraryEdit;
use App\Http\Livewire\Admin\Library\Index as LibraryIndex;
use App\Http\Livewire\Admin\Pages\Create as PagesCreate;
use App\Http\Livewire\Admin\Pages\Delete as PagesDelete;
use App\Http\Livewire\Admin\Pages\Edit as PagesEdit;
use App\Http\Livewire\Admin\Pages\Index as PagesIndex;
use App\Http\Livewire\Admin\Partner\Create as PartnerCreate;
use App\Http\Livewire\Admin\Partner\Delete as PartnerDelete;
use App\Http\Livewire\Admin\Partner\Edit as PartnerEdit;
use App\Http\Livewire\Admin\Partner\Index as PartnerIndex;
use App\Http\Livewire\Admin\PaybackRequest\Index as PaybackRequestsIndex;
use App\Http\Livewire\Admin\PaybackRequest\Pay as PaybackRequestsPay;
use App\Http\Livewire\Admin\Role\Create as RoleCreate;
use App\Http\Livewire\Admin\Role\Edit as RoleEdit;
use App\Http\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Livewire\Admin\Settings as SettingsIndex;
use App\Http\Livewire\Admin\Slider\Create as SliderCreate;
use App\Http\Livewire\Admin\Slider\Delete as SliderDelete;
use App\Http\Livewire\Admin\Slider\Edit as SliderEdit;
use App\Http\Livewire\Admin\Slider\Index as SliderIndex;
use App\Http\Livewire\Front\ContactUs;
use App\Http\Livewire\User\Category\Index as UserCategoryIndex;
use App\Http\Livewire\User\Library\Index as UserLibraryIndex;
use App\Http\Livewire\User\Library\Show as UserShowLibrary;
use App\Http\Livewire\User\PaybackRequests\Index as WalletIndex;
use App\Models\Ad;
use App\Models\Discount;
use App\Models\User;
use App\Services\GoogleAnalyticsService;
use App\Services\HyperpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('ads/{ad}/fatorah_pay', [MyFatoorahController::class, 'pay'])->name('pay_fatorah');

Route::get('abanoub', function () {
    $filter = "ga:pagePath=@/" . 'ad/47';
    $google_data = GoogleAnalyticsService::getAdOperatingSystems($filter);

    //sync data (delete old data for ads)
    $oldData = AdDevices::where('ad_id', 47)->where('key', 'operating_system')->get();

    foreach ($oldData as $data) {
        $data->delete();
    }

    foreach ($google_data as $data) {
        AdDevices::create([
            'ad_id' => 47,
            'key' => $data['key'],
            'name' => $data['name'],
            'count' => $data['count'],
        ]);
    }
});

Route::get('my_fatoorah_view', function () {
    return view('payment.my_fatorah');
});

//Auth::routes();
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::get('ads/sucess/{ad}', function (Request $request, $id) {
        $paid_ad = Ad::where('id', $id)->first();
        if (!$paid_ad) {
            return;
        }

        if ($paid_ad->update(['payment_id' => $request['id'], 'remaining_budget' => $paid_ad->budget, 'status' => 'reviewing', 'payment_info' => $request->all()])) {
            return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
        }

        return 'success payment';
    });

    Route::get('ads/fail', function (Request $request) {
        return ' fail, Please try again';
    })->name('payment.error');

    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('contact-us', ContactUs::class)->name('contact_us');
    Route::get('page/{page}', [HomeController::class, 'showPage'])->name('show_page');


//    Route::get('short-link/{shortLink}', [ShortLinkController::class, 'show'])->name('short_link.show');
    Route::get('ad/{ad}/{utm?}', [LibraryController::class, 'showAd'])->name('show_ad');
    Route::get('library/{library}/{utm?}', [LibraryController::class, 'show'])->name('show_library');

//    Route::get('ad/{ad}/{utm?}/visit-ad', [LibraryController::class, 'showAd'])->name('show_ad');
//    Route::get('library/{library}/{utm?}/visit-library', [LibraryController::class, 'show'])->name('show_library');

    Route::post('/ad/{ad}/increase-clicks', [LibraryController::class, 'increaseClicks'])->name('increase_clicks_of_ad');
    Route::get('support', function () {
        $settings = \App\Models\Setting::first();
        $support = \App\Models\Page::find(1);
        return view('livewire.user.support', compact('settings','support'));
    })->name('support');

    Route::get('terms', \App\Http\Livewire\User\Terms::class)->name('terms');

    Route::group(['as' => 'user.', 'prefix' => 'user/'], function () {
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register_form');
        Route::get('edit-profile', [AuthController::class, 'showEditProfile'])->name('edit.profile');

        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login_form');
        Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
        Route::get('verify-forget-password-code/{user}', [AuthController::class, 'verifyForgetPasswordCode'])->name('verify_forget_password_code');
        Route::get('verify-register-code', [AuthController::class, 'verifyRegisterCode'])->name('verify_register_code');
        Route::post('verify-register-code', [AuthController::class, 'verifyRegisterCodePost'])->name('verify_registration_code');
        Route::post('send-verify-code', [AuthController::class, 'resendOtpCode'])->name('resend_verification_code');

        Route::get('reset-password/{token}', [AuthController::class,'showResetPassword'])->name('show.reset_password');
        /**Confirm payment */
        Route::get('payment/status/web', function (Request $request) {
            $payment_service = new HyperpayService;
            $response = $payment_service->getPaymentStatus(request('id'));
            $paid_ad = Ad::where('checkout_id', $response['ndc'])->first();
            if ($response['result']['code'] != '000.100.112') {
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-failed');
                return $response['result']['description'] . ' - ' . $response['result']['code'];
            }

            if (!$paid_ad) {
                return;
            }

            if ($paid_ad->update(['payment_id' => $response['id'], 'remaining_budget' => $paid_ad->budget, 'status' => 'reviewing', 'payment_info' => $response])) {
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
            }

        })->name('confirm_pay_ad');
        /**Confirm payment */

        Route::get('success_payment', function () {
            return 'success';
        })->name('success_pay');

        Route::get('ads/{ad}/pay', [UserAdController::class, 'pay'])->name('pay_ad');

        Route::get('ads/{ad}/fatorah_pay', [MyFatoorahController::class, 'pay'])->name('pay_fatorah');
        Route::get('ads/sucess/{ad}', function (Request $request, $id) {
            $paid_ad = Ad::where('id', $id)->first();
            if (!$paid_ad) {
                return;
            }

            if ($paid_ad->update([
                'payment_id' => $request['id'],
                'remaining_budget' => $paid_ad->budget,
                'discount_info_ar' => session()->get('discount_info_ar') ?? null,
                'discount_info_en' => session()->get('discount_info_en') ?? null,
                'status' => 'reviewing',
                'payment_info' => $request->all()
            ])) {
                if (session()->has('user_discount')) {
                    $discount = Discount::where('discount_code', session()->get('discount_code'))->first();
                    if ($discount) {
                        $discount->update([
                            'number_of_times' => $discount->number_of_times -= 1,
                            'number_of_times_is_used' => $discount->number_of_times_is_used += 1,
                        ]);
                    }
                }
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
            }

            return 'success payment';
        })->name('fatorah_sucess');

        Route::get('ads/fail/{id}', function (Request $request, $id) {
            $paid_ad = Ad::where('id', $id)->first();
            return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-failed');
        })->name('fatorah_error');

        Route::get('all-users', [\App\Http\Controllers\User\UserController::class, 'index'])->name('all_users');

        Route::group(['middleware' => 'auth'], function () {
            Route::get('notifications', [NotificationController::class, 'userNotification'])->name('notifications.index');
            Route::get('chats', [\App\Http\Controllers\User\ChatController::class, 'index'])->name('chats');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');

            Route::get('profile/{user}', \App\Http\Livewire\User\Profile::class)->name('get_profile');
            Route::get('my-favourite', [AuthController::class, 'showMyFavourite'])->name('my_favourite');

            Route::get('edit-profile', [AuthController::class, 'showEditProfile'])->name('edit_profile');
            //            Route::get('favourites/{favourite}/delete', Fa::class)->name('delete_discount');

            //project
//            Route::get('/projects/create', \App\Http\Livewire\User\Project\Create::class);
//            Route::post('save-profile', [AuthController::class, 'saveProfile'])->name('save_profile');
            Route::get('create-project', [\App\Http\Controllers\User\ProjectController::class, 'showCreateProject'])->name('create_project');
            Route::get('projects', [\App\Http\Controllers\User\ProjectController::class, 'index'])->name('projects.index');
            Route::get('projects/{project}', [\App\Http\Controllers\User\ProjectController::class, 'show'])->name('project.show');

            Route::get('my-proposals', [\App\Http\Controllers\User\ProposalController::class, 'index'])->name('my_proposals');
            Route::get('proposals/{proposal}', [\App\Http\Controllers\User\ProposalController::class, 'show'])->name('show.proposal');

            Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
            Route::get('ads', [UserAdController::class, 'index'])->name('ads');
            Route::get('ads/create', [UserAdController::class, 'create'])->name('create_ad');
            Route::get('ads/{ad}/edit', [UserAdController::class, 'edit'])->name('edit_ad');
            Route::get('ads/{ad}/show', [UserAdController::class, 'show'])->name('show_ad');
            Route::get('ads/{ad}/stats', [UserAdController::class, 'stats'])->name('ad_stats');


            Route::get('category/{category}/libraries', UserLibraryIndex::class)->name('library');
            Route::get('category', UserCategoryIndex::class)->name('category');
            Route::get('library/{library}', UserShowLibrary::class)->name('library.show');

            Route::get('wallet', [\App\Http\Controllers\User\WalletController::class,'index'])->name('wallet');
            Route::get('packages',[\App\Http\Controllers\User\PackageController::class, 'index'])->name('packages');
            Route::get('contact', [UserContactController::class, 'index'])->name('contact_us');

        });/*authenticated users*/

    });


    //Admin
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login_form');

        Route::group(['middleware' => 'auth:admin'], function () {

            // admins
            Route::get('admins', AdminIndex::class)->name('admins.index');
            Route::get('admins/{admin}/edit', AdminEdit::class)->name('admins.edit');
            Route::get('/admins/create', AdminCreate::class)->name('admins.create');

            Route::get('billing', \App\Http\Livewire\Admin\Billing\Index::class)->name('billing.index');
            Route::get('users', \App\Http\Livewire\Admin\Users\Index::class)->name('users.index');
            Route::get('users/{user}/stats', \App\Http\Livewire\Admin\Users\Stats::class)->name('user_stats');
            Route::get('users/{user}/user_library_stats', \App\Http\Livewire\Admin\Users\LibraryStats::class)->name('user_library_stats');
            Route::get('users/{user}/ad/{ad}/stats', \App\Http\Livewire\Admin\Users\UserAdStats::class)->name('user_ad_stats');
            Route::get('users/{user}/library', \App\Http\Livewire\Admin\Users\UserLibraryStats::class)->name('user_single_library_stats');


            Route::get('ads/{ad}/stats', [UserAdController::class, 'adminStats'])->name('ad_stats');
            Route::get('ads/{ad}/soldiers', [UserAdController::class, 'adminAdSoldiers'])->name('ad_soldiers');
            Route::get('users/{user}/edit', \App\Http\Livewire\Admin\Users\Edit::class)->name('users.edit');


            Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::get('advertisements/new', \App\Http\Livewire\Admin\Ads\Create::class)->name('new_ads');
            Route::get('advertisements', \App\Http\Livewire\Admin\Ads\Index::class)->name('ads');
            Route::get('advertisements/{advertisement}/edit', \App\Http\Livewire\Admin\Ads\Edit::class)->name('advertisements.edit');

            Route::get('ads/{ad}/edit', [UserAdController::class, 'editStatus'])->name('ads.edit');
            Route::post('ads/{ad}/update', [UserAdController::class, 'saveEditStatus'])->name('ads.update');

            Route::resource('task', AdminTaskController::class);
            Route::get('contact', [AdminContactController::class, 'index'])->name('contact_us');
            Route::get('contact/{contact}', [AdminContactController::class, 'show'])->name('contact.show');
            Route::put('contact/{contact}', [AdminContactController::class, 'update'])->name('contact.update');

            Route::get('slider/index', SliderIndex::class)->name('slider');
            Route::get('slider/create', SliderCreate::class)->name('create_slider');
            Route::get('slider/{slider}/edit', SliderEdit::class)->name('edit_slider');
            Route::get('slider/{slider}/delete', SliderDelete::class)->name('delete_slider');

            Route::get('discount/index', DiscountIndex::class)->name('discount');
            Route::get('discount/create', DiscountCrate::class)->name('create_discount');
            Route::get('discount/{discount}/edit', DiscountEdit::class)->name('edit_discount');
            Route::get('discount/{discount}/delete', DiscountDelete::class)->name('delete_discount');


            Route::get('role/index', RoleIndex::class)->name('role');
            Route::get('role/create', RoleCreate::class)->name('create_role');
            Route::get('role/{role}/edit', RoleEdit::class)->name('edit_role');

            Route::get('page/index', PagesIndex::class)->name('pages.index');
            Route::get('page/create', PagesCreate::class)->name('pages.create');
            Route::get('page/{page}/edit', PagesEdit::class)->name('pages.edit');
            Route::get('page/{page}/delete', PagesDelete::class)->name('pages.delete');

            Route::get('category', CategoryIndex::class)->name('category');
            Route::get('category/create', CategoryCreate::class)->name('category.create');
            Route::get('category/{category}', CategoryEdit::class)->name('category.edit');
            Route::get('category/{category}/delete', CategoryIndex::class)->name('category.delete');

            Route::get('medals', App\Http\Livewire\Admin\Medal\Index::class)->name('medals');
            Route::get('medals/create', \App\Http\Livewire\Admin\Medal\Create::class)->name('medal.create');
            Route::get('medals/{medal}', \App\Http\Livewire\Admin\Medal\Edit::class)->name('medal.edit');
            Route::get('medals/{medal}/delete', \App\Http\Livewire\Admin\Medal\Index::class)->name('medal.delete');

            Route::get('countries', \App\Http\Livewire\Admin\Country\Index::class)->name('countries');
            Route::get('countries/create', \App\Http\Livewire\Admin\Country\Create::class)->name('country.create');
            Route::get('countries/{country}', \App\Http\Livewire\Admin\Country\Edit::class)->name('country.edit');
            Route::get('countries/{country}/delete', \App\Http\Livewire\Admin\Country\Index::class)->name('country.delete');


            Route::get('cities', \App\Http\Livewire\Admin\City\Index::class)->name('cities');
            Route::get('cities/create', \App\Http\Livewire\Admin\City\Create::class)->name('city.create');
            Route::get('cities/{city}', \App\Http\Livewire\Admin\City\Edit::class)->name('city.edit');
            Route::get('cities/{city}/delete', \App\Http\Livewire\Admin\City\Index::class)->name('city.delete');


            Route::get('skills', \App\Http\Livewire\Admin\Skill\Index::class)->name('skills');
            Route::get('skills/create', \App\Http\Livewire\Admin\Skill\Create::class)->name('skill.create');
            Route::get('skills/{skill}', \App\Http\Livewire\Admin\Skill\Edit::class)->name('skill.edit');
            Route::get('skills/{skill}/delete', \App\Http\Livewire\Admin\Skill\Index::class)->name('skill.delete');

            Route::get('features', \App\Http\Livewire\Admin\Feature\Index::class)->name('features');
            Route::get('features/create', \App\Http\Livewire\Admin\Feature\Create::class)->name('feature.create');
            Route::get('features/{feature}', \App\Http\Livewire\Admin\Feature\Edit::class)->name('feature.edit');
            Route::get('features/{feature}/delete', \App\Http\Livewire\Admin\Feature\Index::class)->name('feature.delete');

            Route::get('packages', \App\Http\Livewire\Admin\Package\Index::class)->name('packages');
            Route::get('packages/create', \App\Http\Livewire\Admin\Package\Create::class)->name('package.create');
            Route::get('packages/{package}', \App\Http\Livewire\Admin\Package\Edit::class)->name('package.edit');
            Route::get('packages/{packages}/delete', \App\Http\Livewire\Admin\Package\Index::class)->name('package.delete');


            Route::get('money', \App\Http\Livewire\Admin\Money\Index::class)->name('money');
            Route::get('money/create', \App\Http\Livewire\Admin\Money\Create::class)->name('money.create');
            Route::get('money/{money}', \App\Http\Livewire\Admin\Money\Edit::class)->name('money.edit');
            Route::get('money/{money}/delete', \App\Http\Livewire\Admin\Money\Index::class)->name('money.delete');


            Route::get('library', LibraryIndex::class)->name('library');
            Route::get('library/create', LibraryCreate::class)->name('library.create');
            Route::get('library/{library}', LibraryEdit::class)->name('library.edit');
            Route::get('library/{library}/delete', LibraryDelete::class)->name('library.delete');


            Route::get('partner/index', PartnerIndex::class)->name('partner');
            Route::get('partner/create', PartnerCreate::class)->name('create_partner');
            Route::get('partner/{partner}/edit', PartnerEdit::class)->name('edit_partner');
            Route::get('partner/{partner}/delete', PartnerDelete::class)->name('delete_partner');

            Route::get('settings', SettingsIndex::class)->name('settings');


            Route::get('payback_requests', PaybackRequestsIndex::class)->name('payback_requests');
            Route::get('payback_requests/{paybackRequest}/pay', PaybackRequestsPay::class)->name('payback_requests.pay');
        });
    });
});


Route::post('contact-us', function (Request $request){
   if($request->email && $request->message) {
       \App\Models\Contact::create([
           'sender_name' => auth()->user()->first_name .' '. auth()->user()->last_name,
           'sender_email' => $request->email,
           'message' => $request->message,
       ]);
       return redirect('/ar/support');
   }
    return redirect('/ar/support');

})->middleware('auth')->name('user.contact_us');

Route::get('email/verify/{id}/{hash}', function ($id) {

    $user = User::findOrFail($id);

    $user->markEmailAsVerified();

    return redirect('/ar/user/login');

})->name('verification.verify')->middleware('signed');





