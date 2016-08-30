<?php namespace App\Breadcrumbs;

class Breadcrumbs
{
    protected $breadcrumbs = [];

    public function get()
    {
        return $this->breadcrumbs;
    }

    public function push($title, $url = false, $image = false)
    {
        $this->breadcrumbs[] = compact('title', 'url', 'image');
    }
}
