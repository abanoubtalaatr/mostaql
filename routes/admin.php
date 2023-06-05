<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\User\AdController as UserAdController;
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
use Illuminate\Support\Facades\Route;

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

        Route::get('payback-requests', PaybackRequestsIndex::class)->name('payback_requests');
        Route::get('payback-requests/{paybackRequest}/pay', PaybackRequestsPay::class)->name('payback_requests.pay');

        Route::get('projects', \App\Http\Livewire\Admin\Project\Index::class)->name('projects.index');
        Route::get('projects/{project}', \App\Http\Livewire\Admin\Project\Show::class)->name('projects.show');
        Route::get('settings', SettingsIndex::class)->name('settings');
    });
});
