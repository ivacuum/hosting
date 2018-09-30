<?php namespace Tests;

class UserPagesTest extends TestCase
{
    /**
     * @dataProvider userPages200
     * @param string $url
     */
    public function testUserPages200($url)
    {
        $this->be(\App\User::find(1));

        $this->get($url)->assertStatus(200);
    }

    public function userPages200()
    {
        return [
            ['/gallery'],
            ['/gallery/upload'],
            ['/my'],
            ['/my/password'],
            ['/my/settings'],
            ['/my/trips'],
            ['/my/trips/create'],
            ['/notifications'],
            ['/torrents/add'],
            ['/torrents/my'],
        ];
    }
}
