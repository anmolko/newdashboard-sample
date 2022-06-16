<?php

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

Auth::routes();

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::any('/register', function() {
    abort(404);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact-us', 'App\Http\Controllers\FrontController@contact')->name('contact');
Route::post('/contact-us', 'App\Http\Controllers\FrontController@contactStore')->name('contact.store');


Route::get('/', 'App\Http\Controllers\FrontController@index')->name('home');

//blog
Route::get('blog/search/', 'App\Http\Controllers\FrontController@searchBlog')->name('searchBlog');

Route::get('blog/{slug}','App\Http\Controllers\FrontController@blogSingle')->name('blog.single');
Route::get('service/{slug}','App\Http\Controllers\FrontController@serviceSingle')->name('service.single');
Route::get('/service','App\Http\Controllers\FrontController@service')->name('service.frontend');
Route::get('/blog/categories/{slug}', 'App\Http\Controllers\FrontController@blogCategories')->name('blog.category');
Route::get('/blog', 'App\Http\Controllers\FrontController@blogs')->name('blog.frontend');
Route::get('/faq', 'App\Http\Controllers\FrontController@faq')->name('faq.frontend');
Route::get('/request-quote', 'App\Http\Controllers\FrontController@getQuote')->name('get-quote');
Route::post('/request-quote', 'App\Http\Controllers\FrontController@quoteStore')->name('get-quote.store');

Route::get('/domain-registration', 'App\Http\Controllers\FrontController@domainRegistration')->name('domain.frontend');
Route::get('/career', 'App\Http\Controllers\FrontController@career')->name('career.frontend');
Route::post('/career', 'App\Http\Controllers\FrontController@careerStore')->name('career.store');
Route::get('/career/{slug}', 'App\Http\Controllers\FrontController@careerSingle')->name('career.single');
Route::get('/packages', 'App\Http\Controllers\FrontController@package')->name('package.frontend');
Route::post('/packages', 'App\Http\Controllers\FrontController@packageStore')->name('package.store');
Route::get('/works', 'App\Http\Controllers\FrontController@work')->name('work.frontend');

Route::get('/privacy-policy', 'App\Http\Controllers\FrontController@privacy')->name('privacy.frontend');
Route::get('/terms-condition', 'App\Http\Controllers\FrontController@terms')->name('term.frontend');


//end blog

Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //signed-in user routes
    Route::get('/profile/{slug?}', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::get('/filemanager', 'App\Http\Controllers\HomeController@filemanager')->name('filemanager');
    Route::get('/profile/edit/{slug}', 'App\Http\Controllers\UserController@profileEdit')->name('profile.edit');
    Route::post('/profile/socials/', 'App\Http\Controllers\UserController@socialsUpdate')->name('profile.socials');
    Route::put('/profile/{id}/update', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::post('/user-image/update/', 'App\Http\Controllers\UserController@imageupdate')->name('user.imageupdate');
    Route::post('/profile/oldpassword', 'App\Http\Controllers\UserController@checkoldpassword')->name('user.oldpassword');
    Route::post('/profile/password', 'App\Http\Controllers\UserController@profilepassword')->name('user.password');
    Route::post('/user/removeaccount', 'App\Http\Controllers\UserController@removeAccount')->name('user.removeaccount');
    //end of signed-in user routes

    Route::get('/user-management', 'App\Http\Controllers\UserController@alluser')->name('alluser');
    Route::get('/user-management/create', 'App\Http\Controllers\UserController@create')->name('user.create');
    Route::post('/user-management/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::delete('/user-management/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    Route::patch('/status/update/{id}', 'App\Http\Controllers\UserController@statusupdate')->name('user-status.update');
    Route::patch('/role/update/{id}', 'App\Http\Controllers\UserController@roleupdate')->name('user-type.update');

    Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
    Route::delete('/contact/{id}', 'App\Http\Controllers\ContactController@destroy')->name('contact.destroy');
    Route::get('/contact/edit/{slug}', 'App\Http\Controllers\ContactController@edit')->name('contact.edit');

    //Blog categories
    Route::get('/blog-category', 'App\Http\Controllers\BlogCategoryController@index')->name('blogcategory.index');
    Route::get('/blog-category/create', 'App\Http\Controllers\BlogCategoryController@create')->name('blogcategory.create');
    Route::post('/blog-category', 'App\Http\Controllers\BlogCategoryController@store')->name('blogcategory.store');
    Route::put('/blog-category/{category}', 'App\Http\Controllers\BlogCategoryController@update')->name('blogcategory.update');
    Route::delete('/blog-category/{category}', 'App\Http\Controllers\BlogCategoryController@destroy')->name('blogcategory.destroy');
    Route::get('/blog-category/{category}/edit', 'App\Http\Controllers\BlogCategoryController@edit')->name('blogcategory.edit');
    //End of Blog categories


    //Blog
    Route::get('/blogs', 'App\Http\Controllers\BlogController@index')->name('blog.index');
    Route::get('/blogs/create', 'App\Http\Controllers\BlogController@create')->name('blog.create');
    Route::post('/blogs', 'App\Http\Controllers\BlogController@store')->name('blog.store');
    Route::put('/blogs/{blogs}', 'App\Http\Controllers\BlogController@update')->name('blog.update');
    Route::delete('/blogs/{blogs}', 'App\Http\Controllers\BlogController@destroy')->name('blog.destroy');
    Route::get('/blogs/{blogs}/edit', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
    Route::patch('/blogs/{id}/update', 'App\Http\Controllers\BlogController@updateStatus')->name('blog-status.update');

    //End Blog

    Route::get('/dashboard-settings', 'App\Http\Controllers\SettingController@index')->name('settings.index');
    Route::get('/dashboard-settings/create', 'App\Http\Controllers\SettingController@create')->name('settings.create');
    Route::post('/dashboard-settings', 'App\Http\Controllers\SettingController@store')->name('settings.store');
    Route::put('/dashboard-settings/{settings}', 'App\Http\Controllers\SettingController@update')->name('settings.update');
    Route::delete('/dashboard-settings/{settings}', 'App\Http\Controllers\SettingController@destroy')->name('settings.destroy');
    Route::get('/dashboard-settings/{settings}/edit', 'App\Http\Controllers\SettingController@edit')->name('settings.edit');
    Route::post('/dashboard-settings/theme-mode', 'App\Http\Controllers\SettingController@themeMode')->name('settings.theme');
    Route::put('/dashboard-settings/privacy-policy/{settings}', 'App\Http\Controllers\SettingController@privacyPolicy')->name('settings.privacy');
    Route::put('/dashboard-settings/terms-conditions/{settings}', 'App\Http\Controllers\SettingController@termsConditions')->name('settings.terms');
    Route::put('/dashboard-settings/status/{settings}', 'App\Http\Controllers\SettingController@siteStatus')->name('settings.status');

    //for menu
    Route::get('/manage-menus/{slug?}', 'App\Http\Controllers\MenuController@index')->name('menu.index');
    Route::post('/create-menu', 'App\Http\Controllers\MenuController@store')->name('menu.store');
    Route::get('/add-service-to-menu','App\Http\Controllers\MenuController@addService')->name('menu.service');
    Route::get('add-post-to-menu','App\Http\Controllers\MenuController@addPost')->name('menu.post');
    Route::get('add-custom-link','App\Http\Controllers\MenuController@addCustomLink')->name('menu.custom');
    Route::get('/update-menu','App\Http\Controllers\MenuController@updateMenu')->name('menu.updateMenu');
    Route::post('/update-menuitem/{id}','App\Http\Controllers\MenuController@updateMenuItem')->name('menu.updatemenuitem');
    Route::get('/delete-menuitem/{id}/{key}/{in?}/{inside?}','App\Http\Controllers\MenuController@deleteMenuItem')->name('menu.deletemenuitem');
    Route::get('/delete-menu/{id}','App\Http\Controllers\MenuController@destroy')->name('menu.delete');

    //Call actions
    Route::get('/call-actions', 'App\Http\Controllers\CallActionController@index')->name('call-actions.index');
    Route::get('/call-actions/create', 'App\Http\Controllers\CallActionController@create')->name('call-actions.create');
    Route::post('/call-actions', 'App\Http\Controllers\CallActionController@store')->name('call-actions.store');
    Route::put('/call-actions/{actions}', 'App\Http\Controllers\CallActionController@update')->name('call-actions.update');
    Route::delete('/call-actions/{actions}', 'App\Http\Controllers\CallActionController@destroy')->name('call-actions.destroy');
    Route::get('/call-actions/{actions}/edit', 'App\Http\Controllers\CallActionController@edit')->name('call-actions.edit');

    //services
    Route::get('/services', 'App\Http\Controllers\ServiceController@index')->name('services.index');
    Route::get('/services/create', 'App\Http\Controllers\ServiceController@create')->name('services.create');
    Route::post('/services', 'App\Http\Controllers\ServiceController@store')->name('services.store');
    Route::put('/services/{service}', 'App\Http\Controllers\ServiceController@update')->name('services.update');
    Route::delete('/services/{service}', 'App\Http\Controllers\ServiceController@destroy')->name('services.destroy');
    Route::get('/services/{service}/edit', 'App\Http\Controllers\ServiceController@edit')->name('services.edit');

    //our work
    Route::get('/our-work', 'App\Http\Controllers\OurWorkController@index')->name('our-work.index');
    Route::get('/our-work/create', 'App\Http\Controllers\OurWorkController@create')->name('our-work.create');
    Route::post('/our-work', 'App\Http\Controllers\OurWorkController@store')->name('our-work.store');
    Route::put('/our-work/{work}', 'App\Http\Controllers\OurWorkController@update')->name('our-work.update');
    Route::delete('/our-work/{work}', 'App\Http\Controllers\OurWorkController@destroy')->name('our-work.destroy');
    Route::get('/our-work/{work}/edit', 'App\Http\Controllers\OurWorkController@edit')->name('our-work.edit');

    //work category
    Route::get('/work-category', 'App\Http\Controllers\OurWorkCategoryController@index')->name('work-category.index');
    Route::get('/work-category/create', 'App\Http\Controllers\OurWorkCategoryController@create')->name('work-category.create');
    Route::post('/work-category', 'App\Http\Controllers\OurWorkCategoryController@store')->name('work-category.store');
    Route::put('/work-category/{category}', 'App\Http\Controllers\OurWorkCategoryController@update')->name('work-category.update');
    Route::delete('/work-category/{category}', 'App\Http\Controllers\OurWorkCategoryController@destroy')->name('work-category.destroy');
    Route::get('/work-category/{category}/edit', 'App\Http\Controllers\OurWorkCategoryController@edit')->name('work-category.edit');

    //career
    Route::get('/career', 'App\Http\Controllers\CareerController@index')->name('career.index');
    Route::get('/career/create', 'App\Http\Controllers\CareerController@create')->name('career.create');
    Route::post('/career', 'App\Http\Controllers\CareerController@store')->name('career.store');
    Route::put('/career/{careers}', 'App\Http\Controllers\CareerController@update')->name('career.update');
    Route::delete('/career/{careers}', 'App\Http\Controllers\CareerController@destroy')->name('career.destroy');
    Route::get('/career/{careers}/edit', 'App\Http\Controllers\CareerController@edit')->name('career.edit');
    Route::patch('/career/{status}/update', 'App\Http\Controllers\CareerController@updateStatus')->name('career-status.update');

    //project plan
    Route::get('/project-plan', 'App\Http\Controllers\ProjectPlanController@index')->name('project-plan.index');
    Route::get('/project-plan/create', 'App\Http\Controllers\ProjectPlanController@create')->name('project-plan.create');
    Route::post('/project-plan', 'App\Http\Controllers\ProjectPlanController@store')->name('project-plan.store');
    Route::put('/project-plan/{plan}', 'App\Http\Controllers\ProjectPlanController@update')->name('project-plan.update');
    Route::delete('/project-plan/{plan}', 'App\Http\Controllers\ProjectPlanController@destroy')->name('project-plan.destroy');
    Route::get('/project-plan/{plan}/edit', 'App\Http\Controllers\ProjectPlanController@edit')->name('project-plan.edit');

    //FAQ
    Route::get('/faq', 'App\Http\Controllers\FaqController@index')->name('faq.index');
    Route::get('/faq/create', 'App\Http\Controllers\FaqController@create')->name('faq.create');
    Route::post('/faq', 'App\Http\Controllers\FaqController@store')->name('faq.store');
    Route::put('/faq/{plan}', 'App\Http\Controllers\FaqController@update')->name('faq.update');
    Route::delete('/faq/{faq}', 'App\Http\Controllers\FaqController@destroy')->name('faq.destroy');
    Route::get('/faq/{faq}/edit', 'App\Http\Controllers\FaqController@edit')->name('faq.edit');


    //Testimonial
    Route::get('/testimonials', 'App\Http\Controllers\TestimonialController@index')->name('testimonials.index');
    Route::get('/testimonials/create', 'App\Http\Controllers\TestimonialController@create')->name('testimonials.create');
    Route::post('/testimonials', 'App\Http\Controllers\TestimonialController@store')->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', 'App\Http\Controllers\TestimonialController@update')->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', 'App\Http\Controllers\TestimonialController@destroy')->name('testimonials.destroy');
    Route::get('/testimonials/{testimonial}/edit', 'App\Http\Controllers\TestimonialController@edit')->name('testimonials.edit');

    //Consumer plan
    Route::get('/customer-package', 'App\Http\Controllers\ProjectPlanController@packageIndex')->name('package.index');
    Route::delete('/customer-package/{package}', 'App\Http\Controllers\ProjectPlanController@packageDestroy')->name('package.destroy');
    Route::patch('/package/{id}/status', 'App\Http\Controllers\ProjectPlanController@updateStatus')->name('package-status.update');

    //Career response
    Route::get('/career-response', 'App\Http\Controllers\CareerController@responseIndex')->name('career-response.index');
    Route::delete('/career-response/{response}', 'App\Http\Controllers\CareerController@responseDestroy')->name('career-response.destroy');
    Route::patch('/career-response/{id}/status', 'App\Http\Controllers\CareerController@responseStatus')->name('career-status.update');

    //Quote response
    Route::get('/quote/{quotes}/edit', 'App\Http\Controllers\ContactController@editResponse')->name('quote.edit');
    Route::get('/quote-response', 'App\Http\Controllers\ContactController@responseIndex')->name('quote-response.index');
    Route::delete('/quote-response/{response}', 'App\Http\Controllers\ContactController@responseDestroy')->name('quote-response.destroy');

    Route::post('/mark-as-read', 'App\Http\Controllers\NotificationController@markNotification')->name('markNotification');
    Route::get('/quote-response/{name}', 'App\Http\Controllers\NotificationController@sendToQuote')->name('service.quote');
    Route::get('/career-response/{name}', 'App\Http\Controllers\NotificationController@sendToCareerResponse')->name('career.response');

});


Route::get('/{page}', 'App\Http\Controllers\FrontController@page')
    ->name('page');
