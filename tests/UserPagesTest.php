<?php namespace Tests;

class UserPagesTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->be(\App\User::find(1));
    }

    public function testPageGallery()
    {
        $this->get('/gallery')->assertStatus(200);
    }

    public function testPageGalleryUpload()
    {
        $this->get('/gallery/upload')->assertStatus(200);
    }

    public function testPageMy()
    {
        $this->get('/my')->assertStatus(200);
    }

    public function testPageMyPassword()
    {
        $this->get('/my/password')->assertStatus(200);
    }

    public function testPageMyProfile()
    {
        $this->get('/my/profile')->assertStatus(200);
    }

    public function testPageMySettings()
    {
        $this->get('/my/settings')->assertStatus(200);
    }

    public function testPageNotifications()
    {
        $this->get('/notifications')->assertStatus(200);
    }

    public function testPageTorrentsAdd()
    {
        $this->get('/torrents/add')->assertStatus(200);
    }

    public function testPageTorrentsMy()
    {
        $this->get('/torrents/my')->assertStatus(200);
    }
}
