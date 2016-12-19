<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

/**
 * Файлы для скачивания
 *
 * @property integer $id
 * @property string  $project
 * @property string  $folder
 * @property string  $title
 * @property string  $slug
 * @property integer $size
 * @property string  $extension
 * @property integer $downloads
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class File extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public function basename()
    {
        return "{$this->slug}.{$this->extension}";
    }

    public function downloadPath()
    {
        return "http://ivacuum.org/d/{$this->project}/{$this->folder}/{$this->basename()}";
    }

    public function headerBasename()
    {
        return "filename*=utf-8''" . rawurlencode(htmlspecialchars_decode($this->basename()));
    }

    public function localizedSize()
    {
        return (new Utilities\Size())->localized($this->size);
    }
}
