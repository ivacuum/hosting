<?php namespace App\Http\Controllers\Auth;

use App\Events\ExternalIdentityFirstLogin;
use App\Events\ExternalIdentityLogin;
use App\Events\ExternalIdentityLoginError;

class Google extends Base
{
    protected $provider = 'google';

    public function index()
    {
        $this->saveUrlIntended();

        return $this->driver()->redirect();
    }

    public function callback()
    {
        $error = $this->request->input('error');

        if ($error) {
            event(new ExternalIdentityLoginError($this->provider, $this->request));

            return redirect()->action('Auth@login');
        }

        /* @var $userdata \Laravel\Socialite\Two\User */
        $userdata = $this->driver()->user();
        $identity = $this->externalIdentity($userdata);

        if ($identity->user_id) {
            \Auth::loginUsingId($identity->user_id);

            event(new ExternalIdentityLogin($identity));
            event(new \App\Events\Stats\UserSignedInWithExternalIdentity());

            return redirect()->intended('/');
        }

        if (is_null($userdata->email)) {
            $this->request->session()->flash('message', 'Мы не можем вас зарегистрировать, так как не получили от Гугла вашу электронную почту');

            return redirect()->action('Auth@login');
        }

        if (is_null($user = $this->findUserByEmail($userdata->email))) {
            $user = $this->registerUser($userdata);
        }

        if (!$identity->user_id) {
            $identity->update(['user_id' => $user->id]);
        }

        $user->activate();

        \Auth::login($user, true);

        event(new ExternalIdentityFirstLogin($identity, $user));

        return redirect()->intended('/');
    }

    /**
     * @return \Laravel\Socialite\Two\GoogleProvider
     */
    protected function driver()
    {
        return \Socialite::driver('google');
    }
}
