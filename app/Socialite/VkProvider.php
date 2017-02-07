<?php namespace App\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class VkProvider extends AbstractProvider implements ProviderInterface
{
    protected $access_token_response;
    protected $fields = ['screen_name', 'photo'];
    protected $revoke = false;
    protected $scopes = ['email'];
    protected $version = '5.59';

    public function getAccessTokenResponse($code)
    {
        return $this->access_token_response = parent::getAccessTokenResponse($code);
    }

    public function revoke()
    {
        $this->revoke = true;

        return $this;
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://oauth.vk.com/authorize', $state);
    }

    protected function getCodeFields($state = null)
    {
        $fields = parent::getCodeFields($state);

        $fields['v'] = $this->version;

        if ($this->revoke) {
            $fields['revoke'] = 1;
        }

        return $fields;
    }

    protected function getTokenUrl()
    {
        return 'https://oauth.vk.com/access_token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://api.vk.com/method/users.get', ['query' => [
                'access_token' => $token,
                'fields'       => implode(',', $this->fields),
                'v'            => $this->version,
            ]]
        );

        return json_decode($response->getBody(), true)['response'][0];
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'       => array_get($user, 'id'),
            'nickname' => array_get($user, 'screen_name'),
            'name'     => trim(array_get($user, 'first_name') . ' ' . array_get($user, 'last_name')),
            'email'    => array_get($this->access_token_response, 'email'),
            'avatar'   => array_get($user, 'photo'),
        ]);
    }
}
