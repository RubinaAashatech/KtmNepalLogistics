<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelTrackingController;
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
Auth::routes(['register' => false,'password.request'=>false,'password.reset'=>false]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/admin', function () {
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/gallery',[App\Http\Controllers\RenderController::class,'render_gallery'])->name('gallery');

Route::prefix('/admin')->namespace('Admin')->name('admin.')->middleware(['web','auth'])->group(function () {
    //Users
    Route::get('/users/','UsersController@index')->name('users.index');
    Route::get('/users/create','UsersController@create')->name('users.create');
    Route::post('/users/store','UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}','UsersController@edit')->name('users.edit');
    Route::post('/users/update','UsersController@update')->name('users.update');
    Route::get('/users/delete/{id}','UsersController@destroy')->name('users.destroy');
    Route::get('/users/deleted','UsersController@viewDeleted')->name('users.viewDeleted');
    Route::get('/users/restore/{id}','UsersController@restore')->name('users.restore');
    Route::get('/users/deletePermanent/{id}','UsersController@permanentDestroy')->name('users.permanentDestroy');

    //Roles
    Route::get('/roles/','RolesController@index')->name('roles.index');
    Route::get('/roles/create','RolesController@create')->name('roles.create');
    Route::post('/roles/store','RolesController@store')->name('roles.store');
    Route::get('/roles/edit/{id}','RolesController@edit')->name('roles.edit');
    Route::post('/roles/update','RolesController@update')->name('roles.update');
    Route::get('/roles/delete/{id}','RolesController@destroy')->name('roles.destroy');

    //Permissions
    Route::get('/permissions/','PermissionsController@index')->name('permissions.index');
    Route::get('/permissions/create','PermissionsController@create')->name('permissions.create');
    Route::post('/permissions/store','PermissionsController@store')->name('permissions.store');
    Route::get('/permissions/edit/{id}','PermissionsController@edit')->name('permissions.edit');
    Route::post('/permissions/update','PermissionsController@update')->name('permissions.update');
    Route::get('/permissions/delete/{id}','PermissionsController@destroy')->name('permissions.destroy');

    Route::get('/sitesettings/index', 'SiteSettingController@index')->name('sitesettings.index');
    Route::post('/sitesettings/update', 'SiteSettingController@update')->name('sitesettings.update');
    
    //History
    Route::get('/application-history/','HistoriesController@application_index')->name('application-history');
    Route::get('/system-history/','HistoriesController@system_index')->name('system-history');

     //Service
     Route::get('/services/','ServiceController@index')->name('services.index');
     Route::get('/services/create','ServiceController@create')->name('services.create');
     Route::post('/services/store','ServiceController@store')->name('services.store');
     Route::get('/services/edit/{id}','ServiceController@edit')->name('services.edit');
     Route::post('/services/update','ServiceController@update')->name('services.update');
     Route::get('/services/delete/{id}','ServiceController@destroy')->name('services.destroy');

     //Client
     Route::get('/clients/','ClientController@index')->name('clients.index');
     Route::get('/clients/create','ClientController@create')->name('clients.create');
     Route::post('/clients/store','ClientController@store')->name('clients.store');
     Route::get('/clients/edit/{id}','ClientController@edit')->name('clients.edit');
     Route::post('/clients/update','ClientController@update')->name('clients.update');
     Route::get('/clients/delete/{id}','ClientController@destroy')->name('clients.destroy');

     //Image
     Route::get('/images/','ImageController@index')->name('images.index');
     Route::get('/images/create','ImageController@create')->name('images.create');
     Route::post('/images/store','ImageController@store')->name('images.store');
     Route::get('/images/edit/{id}','ImageController@edit')->name('images.edit');
     Route::post('/images/update','ImageController@update')->name('images.update');
     Route::get('/images/delete/{id}','ImageController@destroy')->name('images.destroy');

     //Ckeditor image upload
     Route::post('/upload_image','UploadImageController@upload_image')->name('upload_image');

     //Post
     Route::get('/posts/','PostController@index')->name('posts.index');
     Route::get('/posts/create','PostController@create')->name('posts.create');
     Route::post('/posts/store','PostController@store')->name('posts.store');
     Route::get('/posts/edit/{id}','PostController@edit')->name('posts.edit');
     Route::post('/posts/update','PostController@update')->name('posts.update');
     Route::get('/posts/delete/{id}','PostController@destroy')->name('posts.destroy');

     //Contact
     Route::get('/contacts/','ContactController@index')->name('contacts.index');
     Route::get('/subscriptions/','SubscriptionController@index')->name('subscriptions.index');


    //Quotations
     Route::get('/quotations/','QuotationController@index')->name('quotations.index');
     Route::post('/quotations/store','QuotationController@store')->name('quotations.store');
     Route::get('/quotations/view/{id}','QuotationController@show')->name('quotations.show');

    //  //
    //  Route::get('//','@index')->name('.index');
    //  Route::get('//create','@create')->name('.create');
    //  Route::post('//store','@store')->name('.store');
    //  Route::get('//edit/{id}','@edit')->name('.edit');
    //  Route::post('//update','@update')->name('.update');
    //  Route::get('//delete/{id}','@destroy')->name('.destroy');
});

Route::prefix('/profile')->name('profile.')->middleware(['web','auth'])->group(function () {
    Route::get('/','ProfilesController@index')->name('index');
    Route::post('/update/info','ProfilesController@updateInfo')->name('update.info');
    Route::post('/update/password','ProfilesController@updatePassword')->name('update.password');
});

Route::get('/service/{id}','RenderController@render_service')->name('render_service');
Route::get('/post/{id}','RenderController@render_posts')->name('render_posts');
Route::get('/quotation','RenderController@render_quotations')->name('render_quotations');
Route::get('/contact','RenderController@render_contact')->name('render_contact');


Route::post('/contact','Admin\ContactController@store')->name('request_contact');
Route::post('/subscription','Admin\SubscriptionController@store')->name('request_subscription');


Route::get('/track-parcel', [ParcelTrackingController::class, 'showTrackingForm'])->name('show-track-parcel');
Route::post('/track-parcel', [ParcelTrackingController::class, 'track'])->name('track-parcel');

Route::get('/admin/parcel-tracking-dashboard', [ParcelTrackingController::class, 'dashboard'])->name('admin.parcel-tracking-dashboard');

Route::prefix('logistics')->middleware(['auth'])->group(function () {

    Route::get('/customers', [ParcelTrackingController::class, 'fetchCustomers'])->name('logistics.customers.index');
    Route::get('/receivers', [ParcelTrackingController::class, 'fetchReceivers'])->name('logistics.receivers.index');
    Route::get('/tracking-updates', [ParcelTrackingController::class, 'fetchTrackingUpdates'])->name('logistics.tracking-updates.index');
    Route::get('/parcels', [ParcelTrackingController::class, 'fetchParcels'])->name('logistics.parcels.index');
    Route::get('/parcel-histories', [ParcelTrackingController::class, 'fetchParcelHistories'])->name('logistics.parcel-histories.index');

});
