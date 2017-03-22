<?php namespace App\Http\Controllers\Acp\Dev;

use App\Http\Controllers\Acp\Controller;
use App\Services\ImageConverter;

class Thumbnails extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function clean()
    {
        foreach (glob(public_path('uploads/temp/*')) as $filename) {
            unlink($filename);
        }

        return redirect()->action("{$this->class}@index")
            ->with('message', 'Папка очищена');
    }

    public function thumbnailsPost()
    {
        $file = $this->request->file('file');

        if (is_null($file) || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $image = (new ImageConverter)
            ->resize(2000, 1500)
            ->quality(75)
            ->convert($file->getRealPath());

        $pathinfo = pathinfo($file->getClientOriginalName());
        $filename = $pathinfo['filename'].'.'.strtolower($pathinfo['extension']);

        rename($image->getRealPath(), public_path("uploads/temp/{$filename}"));

        return ['filename' => $filename];
    }
}
