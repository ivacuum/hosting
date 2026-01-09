<?php

namespace App\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class VkProvider extends AbstractProvider implements ProviderInterface
{
    protected $accessTokenResponse;
    protected $fields = ['screen_name', 'photo'];
    protected $revoke = false;
    protected $scopes = ['email'];
    protected $version = '5.131';

    #[\Override]
    public function getAccessTokenResponse($code)
    {
        return $this->accessTokenResponse = parent::getAccessTokenResponse($code);
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

    #[\Override]
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
                'v' => $this->version,
                'fields' => implode(',', $this->fields),
                'access_token' => $token,
            ]]
        );

        return json_decode($response->getBody(), true)['response'][0];
    }

    protected function mapUserToObject(array $user)
    {
        return new User()
            ->setRaw($user)
            ->map([
                'id' => \Arr::get($user, 'id'),
                'name' => trim(\Arr::get($user, 'first_name') . ' ' . \Arr::get($user, 'last_name')),
                'email' => \Arr::get($this->accessTokenResponse, 'email'),
                'avatar' => \Arr::get($user, 'photo'),
                'nickname' => \Arr::get($user, 'screen_name'),
            ]);
    }
}
