<?php namespace App;

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
 *
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $perPage = 50;

    // Methods
    public function basename()
    {
        return "{$this->slug}.{$this->extension}";
    }

    public function breadcrumb()
    {
        return $this->title;
    }

    public function downloadPath()
    {
        return "https://ivacuum.org/d/{$this->folder()}/{$this->basename()}";
    }

    public function folder()
    {
        return implode('/', [$this->project, $this->folder]);
    }

    public function headerBasename()
    {
        return "filename*=utf-8''" . rawurlencode(htmlspecialchars_decode($this->basename()));
    }
}
