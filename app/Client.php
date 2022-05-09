<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|Domain[] $domains
 *
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $perPage = 50;

    protected $attributes = [
        'text' => '',
    ];

    // Relations
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    // Methods
    public function breadcrumb()
    {
        return $this->name;
    }
}
