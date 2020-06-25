<?php

namespace App\Providers;

use Cmgmyr\Messenger\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
// use Braintree_Configuration;
use App;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    $environment = App::environment();
	    if(App::environment() == 'production'){
		    $this->app['request']->server->set('HTTPS',true);
	    }
        // Schema::defaultStringLength(191);

//        View::composer('user.dashboard.layout', function ($view) {
//            $all= auth()->user()->threads()->select('threads.id')->get();
//            $tids = [];
//            foreach ($all as $a) {
//                $tids[] = $a->id;
//            }
//            $unreadMessages = Message::whereIn('thread_id', $tids)->whereNull('last_read')->count();
//            dd($unreadMessages);
//        });



	    /**
	     * Brain Tree Authentication Register
	     */
	    // Braintree_Configuration::environment(env('BRAINTREE_ENV'));
	    // Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
	    // Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
	    // Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
	    // Cashier::useCurrency('eur', '€');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        // $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }
}
