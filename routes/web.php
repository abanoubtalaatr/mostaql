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
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Services\GoogleAnalyticsService;
use App\Services\HyperpayService;
use App\Services\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('ads/{ad}/fatorah_pay', [MyFatoorahController::class, 'pay'])->name('pay_fatorah');

Route::get('abanoub', function () {
    $payLink = new \App\Services\PayLinkService();
    $user = User::find(103);
    $response = $payLink->pay(20, $user, 'payForProject');
    dd($response);

});

//Auth::routes();
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('contact-us', ContactUs::class)->name('contact_us');
    Route::get('page/{page}', [HomeController::class, 'showPage'])->name('show_page');

    Route::get('support', function () {
        $settings = \App\Models\Setting::first();
        $support = \App\Models\Page::find(1);
        return view('livewire.user.support', compact('settings', 'support'));
    })->name('support');

    Route::get('terms', \App\Http\Livewire\User\Terms::class)->name('terms');

    Route::get('user/projects', [\App\Http\Controllers\User\ProjectController::class, 'index'])->name('projects.index');
    Route::get('user/projects/{project}', [\App\Http\Controllers\User\ProjectController::class, 'show'])->name('project.show');

    Route::group(['as' => 'user.', 'prefix' => 'user/'], function () {
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register_form');
        Route::get('edit-profile', [AuthController::class, 'showEditProfile'])->name('edit.profile');

        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login_form');
        Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
        Route::get('verify-forget-password-code/{user}', [AuthController::class, 'verifyForgetPasswordCode'])->name('verify_forget_password_code');
        Route::get('verify-register-code', [AuthController::class, 'verifyRegisterCode'])->name('verify_register_code');
        Route::post('verify-register-code', [AuthController::class, 'verifyRegisterCodePost'])->name('verify_registration_code');
        Route::post('send-verify-code', [AuthController::class, 'resendOtpCode'])->name('resend_verification_code');

        Route::get('reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('show.reset_password');

        Route::get('/payment', function (Request $request) {
            $package = \App\Models\Package::find($request->package);
            $project = \App\Models\Project::find($request->project);


            if ($package) {
                \App\Models\PackageUser::create([
                    'user_id' => \auth()->id(),
                    'package_id' => $package->id,
                    'end_at' => \Carbon\Carbon::now()->addMonths($package->period),
                ]);

                return redirect()->route('user.get_profile', \auth()->id());
            }
            if ($project) {
                $proposal = \App\Models\Proposal::find($request->proposal);
                $user = User::find($proposal->user->id);


                $proposal->update(['status_id' => 12]);
                $project->update(['status_id' => 2]);

                $userProposal = User::find($proposal->user->id);
                //        Mail::to($userProposal->email)->send(new ProposalEmail($project,'تم قبول عرضك علي مشروع'));
                $title_ar = "تم قبول عرضك";
                $content_ar = "تم قبول عرضك علي مشروع $project->title";
                $user_id = $user->id;
                $type = 'proposal';

                Notification::create([
                    'title_ar' => $title_ar,
                    'content_ar' => $content_ar,
                    'user_id' => $user_id,
                    'type' => $type
                ]);
                return redirect()->route('user.get_profile', \auth()->id());
            }

            return 'success';
        })->name('payment');

        Route::get('cancel', function () {
            return 'cancel';
        })->name('cancel');

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
            Route::get('create-project', [\App\Http\Controllers\User\ProjectController::class, 'showCreateProject'])
                ->middleware('checkFeatureAccess:1')
                ->name('create_project');


            Route::get('my-projects', [\App\Http\Controllers\User\ProjectController::class,'myProjects'])->name('my_projects');

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

            Route::get('wallet', [\App\Http\Controllers\User\WalletController::class, 'index'])->name('wallet');
            Route::get('packages', [\App\Http\Controllers\User\PackageController::class, 'index'])->name('packages');
            Route::get('contact', [UserContactController::class, 'index'])->name('contact_us');

        });/*authenticated users*/

    });

    /*
     *   Admin routes
     */

    require __DIR__.'/admin.php';
});


Route::post('contact-us', function (Request $request) {
    if ($request->email && $request->message) {
        \App\Models\Contact::create([
            'sender_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
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





