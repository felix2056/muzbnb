<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;


class CustomAuth
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $url = url()->previous();
        $urlArr = explode('/', $url);
        $urlPrevious = $urlArr[count($urlArr) -1];
        if($urlPrevious == 'method') {
//            \Auth::user()->saveRecipientId();
            \PaymentRails\Configuration::publicKey(env('PAYMENT_RAILS_ACCESS_KEY'));
            \PaymentRails\Configuration::privateKey(env('PAYMENT_RAILS_SECRET_KEY'));
            \PaymentRails\Configuration::environment(env('PAYMENT_RAILS_ENVIRONMENT'));
            $recipients = \PaymentRails\Recipient::search(['email' => \Auth::user()->email]);
            if(isset($recipients) && count($recipients) > 0) {
                foreach ($recipients as $recipient) {
                    $recipient_id = $recipient->id;
                }
                $user = User::find(\Auth::user()->id);
                $user->recipient_id = $recipient_id;
                $user->update();
            }
        }

        $this->authenticate($guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }
}
