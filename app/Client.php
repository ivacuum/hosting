<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'text'];
    protected $hidden = [];
    protected $perPage = 50;

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function breadcrumb()
    {
        return $this->name;
    }
}
