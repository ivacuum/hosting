<?php namespace App\Http\Controllers\Auth;

use App\Events\ExternalIdentityFirstLogin;
use App\Events\ExternalIdentityLogin;
use App\Events\ExternalIdentityLoginError;
use App\User;
use Illuminate\Support\HtmlString;

class Facebook extends Base
{
    protected $provider = 'facebook';

    public function index()
    {
        $rerequest = $this->request->input('rerequest');

        $driver = $this->driver();

        if ($rerequest) {
            $driver = $driver->reRequest();
        }

        return $driver->redirect();
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

            return redirect()->intended('/');
        }

        if (is_null($userdata->email)) {
            $this->request->session()->flash('message', $this->noEmailMessage());

            return redirect()->action('Auth@login');
        }

        if (is_null($user = $this->findUserByEmail($userdata->email))) {
            $user = $this->registerUser($userdata);
        }

        if (!$identity->user_id) {
            $identity->update(['user_id' => $user->id]);
        }

        if ($user->status === User::STATUS_INACTIVE) {
            $user->update(['status' => User::STATUS_ACTIVE]);
        }

        \Auth::login($user, true);

        event(new ExternalIdentityFirstLogin($identity, $user));

        return redirect()->intended('/');
    }

    /**
     * @return \Laravel\Socialite\Two\FacebookProvider
     */
    protected function driver()
    {
        return \Socialite::driver('facebook');
    }

    /**
     * @return \Illuminate\Support\HtmlString
     */
    protected function noEmailMessage()
    {
        return new HtmlString('<div>Мы не можем вас зарегистрировать, так как не получили от Фэйсбука вашу электронную почту. Доступ к ее адресу можно разрешить при <a class="link" href="'.action('Auth\Facebook@index', ['rerequest' => 1]).'">повторной попытке</a></div>');
    }
}
