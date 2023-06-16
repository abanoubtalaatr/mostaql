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
use App\Http\Livewire\Front\ContactUs;
use App\Http\Livewire\User\Category\Index as UserCategoryIndex;
use App\Http\Livewire\User\Library\Index as UserLibraryIndex;
use App\Http\Livewire\User\Library\Show as UserShowLibrary;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

            // this for edit proposal amount
            if ($request->note == 'EditProposal') {

                //will calculate the price from the beings
                // proposal will edit teh price and dues
                // and project price
                // also then update the status of request
                $proposal = \App\Models\Proposal::find($request->proposal);
                $total = $proposal->price + $request->amount;
                $settings = \App\Models\Setting::first();
                $proposal->update([
                    'price' => $total,
                    'dues' =>$total - ($total / $settings->platform_dues),
                ]);

                $project->update([
                    'price' => $total,
                ]);

                $requestRow = \App\Models\ProposalEditRequest::where('owner_id', auth()->id())
                    ->where('project_id', $project->id)
                    ->where('proposal_id', $proposal->id)
                    ->first();

                $requestRow->update(['status' => 'accept']);

                return redirect(route('user.proposal_requests_edit'));
            }

            // this for subscribe in package
            if ($package) {
                \App\Models\PackageUser::create([
                    'user_id' => \auth()->id(),
                    'package_id' => $package->id,
                    'end_at' => \Carbon\Carbon::now()->addMonths($package->period),
                ]);
                session()->flash('message', 'تم الاشتراك ف الباقة بنجاح');
                return redirect()->route('user.get_profile', \auth()->id());

            }

            // pay for start with in the project
            if ($project) {
                $proposal = \App\Models\Proposal::find($request->proposal);
                $user = User::find($proposal->user->id);


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

                \App\Models\Wallet::create([
                    'amount' => $request->amount,
                    'user_id' => $proposal->user->id,
                    'can_withdraw' => 0,
                    'project_id' => $project->id,
                    'reason_ar' => 'حجز المبلغ لحين تنفيذ المشروع'
                ]);

                $proposal->update(['status_id' => 12]);
                $project->update(['status_id' => 2,'paid' => 1]);
                session()->flash('message', 'تم دفع المبلغ');
                return redirect()->route('user.get_profile', \auth()->id());
            }
            //this for recharge the wallet
            if ($request->wallet == true) {
                $user = User::find(auth()->id());
                $user->update(['wallet' => $user->wallet + $request->amount]);
                session()->flash('message', 'تم شحن المحفظة بنجاح');

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

            Route::get('edit-project/{project}', [\App\Http\Controllers\User\ProjectController::class, 'showEditProject'])
                ->name('edit_project');


            Route::get('my-projects', [\App\Http\Controllers\User\ProjectController::class, 'myProjects'])->name('my_projects');

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

            Route::post('rating', [\App\Http\Controllers\User\RatingController::class, 'store'])->name('rating');

            Route::post('request-withdrawal', [\App\Http\Controllers\User\WalletController::class, 'storeRequest'])
                ->name('request_withdrawal');

            Route::post('recharge', [\App\Http\Controllers\User\WalletController::class, 'recharge'])->name('recharge');

            // proposals
            Route::get('my-proposals', [\App\Http\Controllers\User\ProposalController::class, 'index'])->name('my_proposals');
            Route::get('proposals/{proposal}', [\App\Http\Controllers\User\ProposalController::class, 'show'])->name('show.proposal');
            Route::get('projects/{project}/proposal/{proposal}/edit', [\App\Http\Controllers\User\ProposalController::class, 'editProposal']);
            Route::get('proposal-requests', [\App\Http\Controllers\User\ProposalController::class, 'proposalRequestEdit'])->name('proposal_requests_edit');

        });/*authenticated users*/

    });

    /*
     *   Admin routes
     */

    require __DIR__ . '/admin.php';
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





