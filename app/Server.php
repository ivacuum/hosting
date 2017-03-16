<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['title', 'host', 'text', 'ftp_host', 'ftp_root', 'ftp_user', 'ftp_pass'];
    protected $hidden = ['ftp_pass'];

    public function breadcrumb()
    {
        return "{$this->title} {$this->host}";
    }
}
