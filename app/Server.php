<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'host', 'text', 'ftp_host', 'ftp_root', 'ftp_user', 'ftp_pass'];
    protected $hidden = [];
}
