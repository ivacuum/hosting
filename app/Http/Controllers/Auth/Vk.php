<?php namespace App\Http\Controllers\Auth;

use App\Events\ExternalIdentityFirstLogin;
use App\Events\ExternalIdentityLogin;
use App\Events\ExternalIdentityLoginError;
use App\Socialite\VkProvider;
use App\User;
use Illuminate\Support\HtmlString;

class Vk extends Base
{
    protected $provider = 'vk';

    public function index(VkProvider $vk)
    {
        $revoke = $this->request->input('revoke');

        if ($revoke) {
            $vk = $vk->revoke();
        }

        $this->saveUrlIntended();

        return $vk->redirect();
    }

    public function callback(VkProvider $vk)
    {
        $error = $this->request->input('error');

        if ($error) {
            event(new ExternalIdentityLoginError($this->provider, $this->request));

            return redirect()->action('Auth@login');
        }

        /* @var $userdata \Laravel\Socialite\Two\User */
        $userdata = $vk->user();
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
     * @return \Illuminate\Support\HtmlString
     */
    protected function noEmailMessage()
    {
        return new HtmlString('<div>Мы не можем вас зарегистрировать, так как не получили от ВК вашу электронную почту. Доступ к ее адресу можно разрешить при <a class="link" href="'.action('Auth\Vk@index', ['revoke' => 1]).'">повторной попытке</a></div>');
    }
}
