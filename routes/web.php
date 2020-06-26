<?php

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

Route::get('/broadcast', function() {
    $message = \App\Model\Message::find(1);

    event(new \App\Events\NewMessage($message));
    return 'ok';
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dz', function (){
	return view('dropzone');
});


Route::post('/payWithStripe', [
    'as' => 'payWithStripe',
    'uses' => 'PaymentController@payWithStripe'
]);



Route::get('become-a-host', 'ListingController@becomeHost2')->name('become-a-host');
Route::get('become-a-host-2', 'ListingController@becomeHost')->name('become-a-host-2');
Route::get('userinfo', 'UserController@userInfo')->name('userinfo');
Route::get('invite', 'HomeController@invite')->name('invite');



Route::middleware('authUser')->group(function(){
    Route::get('/reservation-status/{bId}', [
        'as' => 'reservationStatus',
        'uses' => 'PaymentController@reservationStatus'
    ]);
    Route::post('/sendInviteEmail', [
        'as' => 'sendInviteEmail',
        'uses' => 'HomeController@sendInviteEmail'
    ]);
	
    Route::get('congrats/{id}', 'ListingController@congrats')->name('congrats');

	Route::post('/uploadDz', 'ListingController@createDz');
	Route::get('/editImages/{id}', 'ListingController@editImages');
	Route::get('/removeImages/{name}', 'ListingController@removeImages');
	Route::get('/deleteListingImages/{id}', 'ListingController@deleteListingImages');
	Route::get('/getLength', 'ListingController@getLength');
	
	
	Route::get('add-listing', 'ListingController@create')->name('add-listing');
    Route::get('room-editor/{id}', 'ListingController@edit')->name('edit-listing');
    Route::put('save-listing', 'ListingController@save')->name('save-listing');
    Route::put('update-listing/{id}', 'ListingController@update')->name('update-listing');
    Route::post('delete-image/{id}', 'ListingController@deleteImage')->name('delete-image');
    Route::get('publish-listing/{id}', 'ListingController@publish')->name('publish-listing');
    Route::get('unpublish-listing/{id}', 'ListingController@unpublish')->name('unpublish-listing');
    Route::DELETE('delete-listing/{id}', 'ListingController@delete')->name('delete-listing');

    Route::POST('notifications', 'UserController@notification')->name('notification');

    Route::any('/dashboard/messages', 'UserController@messages')->name('messages');
    //Get private messages
    Route::get('/get-conversations', 'MessagesController@getConversations')->name('user.messages.conversations');
    Route::get('/messages-with-conversation/{conversation_id}', 'MessagesController@fetchConvoMessages')->name('user.messages.fetchConvoMessages');
    Route::post('/send-message/{user_id}', 'MessagesController@sendMessage')->name('user.messages.sendMessage');
    // Route::post('dashboard/chat/contact-message', 'MessagesController@newMessage');


    Route::post('dashboard/chat-data', 'MessagesController@data');
    Route::get('dashboard/chat/new-thread/{id}', 'MessagesController@newThread')->name('start-chat'); // for testing purpose
    Route::get('dashboard/chat/start-thread/', 'MessagesController@contactHost')->name('contact-host');
    Route::POST('/update/user', 'UserController@update')->name('update-user');
    Route::POST('/update/user-pro-pic', 'UserController@updatePhoto')->name('update-user-pic');

    Route::post('/dashboard/deactivate', 'UserController@deactivateUser')->name('deactivate');
    Route::get('/dashboard', 'UserController@dashboard');
    Route::get('/dashboard/tasks', 'UserController@tasks');
    Route::get('/dashboard/account', 'UserController@account');
    Route::get('/dashboard/reviews', 'UserController@reviews')->name('reviews');
    Route::post('/dashboard/update-password', 'UserController@updatePassword')->name('update-password');
    Route::post('/dashboard/update-sms-settings', 'UserController@updateSmsSettings')->name('update-sms-settings');
    Route::post('/dashboard/send-sms', 'UserController@sendSMS')->name('send-sms');
    Route::post('/dashboard/send-verification-mail', 'UserController@sendVerifyMail')->name('send-verification-mail');
    Route::post('/dashboard/change-default-phone', 'UserController@changeDefaultPhone')->name('change-default-phone');
    Route::post('/dashboard/delete-phone', 'UserController@deletePhone')->name('delete-phone');
    Route::post('/dashboard/add-number', 'UserController@addNumber')->name('add-number');
    Route::post('/dashboard/verify-number', 'UserController@verifyNumber')->name('verify-number');
    Route::post('/dashboard/submit', 'UserController@submitVerification');
    Route::get('/dashboard/listings', 'UserController@listing')->name('my-listings');
    Route::get('/dashboard/reservations', 'UserController@reservation')->name('my-reservations');
    Route::get('/dashboard/trips', 'UserController@trips');

    //Payment Info and Method
    Route::get('/dashboard/method', 'PaymentController@paymentMethodView')->name('out-method');
    Route::post('/dashboard/save-method', 'PaymentController@savePayOutMethod')->name('save-method');
    Route::get('/dashboard/payment', 'PaymentController@paymentInMethodView')->name('in-method');
    Route::post('/dashboard/payment', 'PaymentController@savePaymentMethod')->name('in-method');
    Route::get('/dashboard/booking', 'ListingController@booking')->name('booking');
    Route::get('/dashboard/changestatus/{id}/{cardId?}', 'PaymentController@changeStatus')->name('changestatus');
    Route::get('/dashboard/confirmation/{id}', 'PaymentController@cardConfirmation')->name('confirmation');
    Route::post('/dashboard/showcheckout', 'PaymentController@showCheckout')->name('showcheckout');
    Route::get('/dashboard/cancel/{id}', 'PaymentController@cancelbooking')->name('cancelbooking');
    Route::get('/dashboard/transaction', 'HomeController@transaction')->name('transaction');
    Route::get('/dashboard/mytrips', 'HomeController@mytrips')->name('mytrips');
    Route::post('payment', 'PaymentController@index')->name('bookingProcess');
    Route::get('/dashboard/checklisting/{id}/{start}/{end}', 'ListingController@checkAvailability')->name('checkAvailability');
    Route::post('paid', 'PaymentController@sale')->name('paid');
});
Route::get('activate/{token}', 'UserController@verifyEmail')->name('user.activate');

Route::get('rooms/{id}', 'ListingController@view')->name('room');


Route::get('disconnect/{provider}', 'Auth\RegisterController@disconnect')->name('disconnect');
Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');



Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog/{slug}', 'BlogController@view')->name('blog-single');
Route::get('blog/preview/{id}', 'BlogController@preview')->name('blog-preview');
Route::get('blog/redirect/{id}', 'BlogController@redirect');

Route::get('Mind', 'ListingController@mind')->name('Mind');
Route::get('search-json', 'ListingController@searchJson')->name('search-json');
Route::get('/search/{arg1?}/{arg2?}/{arg3?}/{lat?}/{lng?}', [
    'as' => 'search',
    'uses' => 'ListingController@searchListings'
]);
Route::post('/filterJson', [
    'as' => 'searchListingsFilter',
    'uses' => 'ListingController@searchListingsFilter'
]);



Route::get('checkout', 'HomeController@checkout')->name('checkout');
Route::get('about', 'HomeController@about')->name('about');
Route::get('press', 'HomeController@press')->name('press');

Route::get('terms-of-services', 'HomeController@tos')->name('tos');
Route::get('our-standards', 'HomeController@ourStandards')->name('standards');
Route::get('host-and-guest-ethics', 'HomeController@guest')->name('guest');
Route::get('ambassadors', 'HomeController@ambassadors')->name('ambassadors');
Route::get('public-profile/{user_id}', 'HomeController@publicProfile')->name('publicProfile');


Route::prefix('admin')->group(function (){

    /*
	 * Booking Route for admin
	 * */
    Route::get('/bookings', [
        'as' => 'admin.bookings',
        'uses' => 'Admin\BookingController@getAll'
    ]);
    Route::post('/bookings/refund', [
        'as' => 'admin.bookings.refund',
        'uses' => 'Admin\BookingController@refund'
    ]);
    Route::post('/bookings/release', [
        'as' => 'admin.bookings.release',
        'uses' => 'Admin\BookingController@release'
    ]);
    Route::post('/bookings/cancel', [
        'as' => 'admin.bookings.cancel',
        'uses' => 'Admin\BookingController@cancelBooking'
    ]);
    /*
	 * Transactions Route for admin
	 * */
    Route::get('/transactions', [
        'as' => 'admin.transactions',
        'uses' => 'Admin\TransactionController@getAll'
    ]);

    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::resource('admin', 'Admin\AdminController');
    Route::post('changeAdminPass', 'Admin\AdminController@changePassword')->name('admin.changePassword');
    Route::DELETE('delete/{id}', 'Admin\AdminController@destroy');
    Route::post('ban/{id}', 'Admin\AdminController@ban');
    Route::get('edit/{id}', 'Admin\AdminController@editProfile')->name('admin.update.profile');


    Route::get('/users/{id}/edit', 'Admin\UserController@edit')->name('admin.users.edit');
    Route::PATCH('/users/update/{id}', 'Admin\UserController@update')->name('admin.users.update');
    Route::post('/users/change-password', 'Admin\UserController@changePassword')->name('admin.users.changePassword');
    Route::get('/users/delete/{id}', 'Admin\UserController@destroy')->name('admin.users.delete');
    Route::POST('/users/ban/{id}', 'Admin\UserController@ban')->name('admin.users.ban');
    Route::get('/users/create', 'Admin\UserController@create')->name('admin.users.create');
    Route::POST('/users/store', 'Admin\UserController@store')->name('admin.users.store');
    Route::get('/users', 'Admin\UserController@index')->name('admin.user.list');

    Route::get('/', 'Admin\AdminController@home')->name('admin.dashboard');
    Route::resource('currency', 'Admin\CurrencyController');
    Route::resource('listing', 'Admin\ListingController');
    /* Email Routes */
    Route::resource('campaigns', 'Admin\EmailCampaignController', ['as' => 'admin.email']);

    Route::resource('templates', 'Admin\EmailTemplateController', ['as' => 'admin.email']);
    Route::get('templates/{id}/raw', 'Admin\EmailTemplateController@row')->name('admin.email.raw');


	/*
	 * Spark Post Emails Templates Urls
	 * */
	Route::get('spark-template' , 'SparkController@index')->name('spark_template');
	Route::get('assign-template' , 'SparkController@assigntemplate')->name('assign_template');
	Route::post('save-template' , 'SparkController@save_template')->name('save_template');
	Route::get('edit-template/{emailist_id}' , 'SparkController@edit_template')->name('edit_template');
	Route::post('update-template' , 'SparkController@update_template')->name('update_template');


});

Route::get('/fixPhone', function (){
    $users = \App\User::all();
    foreach ($users as $user) {
        $phone = $user->phoneNumber;
        if (!$phone) {
            $user->phoneNumber()->save(new \App\Model\PhoneNumber());
        }
    }
    echo 'done';
});
Route::get('/test', function () {
    $filename = '2017/04/1.jpg';
    $name = blog_img($filename);
    echo '<img src="' . blog_img($name . '-1440x583.' . $ext) . '">';
});
Route::get('/regenerate-thumb', function () {
    $profiles = \App\Model\UserProfile::all();
    foreach($profiles as $profile)
    {

        $path = base_path() . '/public/images/user/';
        $img_name = $profile->avatar;
        if(strlen($img_name) > 4 && file_exists($path . $img_name)) {
            Image::make($path . $img_name)->fit(270, 270)->save($path . $img_name);
            Image::make($path . $img_name)->fit(120, 120)->save($path . 's_' . $img_name);
            Image::make($path . $img_name)->fit(70, 70)->save($path . 'a_' . $img_name);
        }
    }
    echo 'Done';
});
//Route::get('/fixPhoto', function (){
//    $users = \App\User::all();
//
//    foreach ($users as $user) {
//
//        $img_name = $user->profile->avatar;
//
//        $path = base_path() . '/public/images/user/';
//        if(strlen($img_name) > 3 && file_exists($path . $img_name)) {
//            \Image::make($path . $img_name)->fit(100, 100)->save($path . 's_' . $img_name);
//        }
//    }
//    echo 'done';
//});

//Brain tree Payment Test
Route::post('addOrder', 'PaymentController@addOrder')->name('addOrder');
Route::post('checkout', 'PaymentController@sale')->name('checkout');

Route::get('releaseescrow', 'PaymentController@releaseescrow');
Route::post('password/reset', ['as' => 'passwordReset', 'uses' => 'HomeController@passwordReset']);
Route::get('password/reset/{token}', ['as' => 'passwordResetForm', 'uses' => 'HomeController@passwordResetForm']);
Route::post('password/reset/{token}', ['as' => 'savePasswordReset', 'uses' => 'HomeController@savePasswordReset']);
Route::post('ambassador/save', ['as' => 'saveAmbassador', 'uses' => 'HomeController@saveAmbassador']);
Route::get('/cronSetTransactionStatus', [
    'as' => 'cronSetTransactionStatus',
    'uses' => 'HomeController@cronSetTransactionStatus'
]);
