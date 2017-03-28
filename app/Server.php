<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Сервер
 *
 * @property integer $id
 * @property string  $title
 * @property string  $host
 * @property string  $text
 * @property string  $ftp_host
 * @property string  $ftp_user
 * @property string  $ftp_pass
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Server extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $hidden = ['ftp_pass'];

    // Methods
    public function breadcrumb()
    {
        return "{$this->title} {$this->host}";
    }
}
