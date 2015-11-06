<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'text'];
    protected $hidden = [];

    protected $perPage = 50;

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
