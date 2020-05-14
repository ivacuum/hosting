<?php namespace App\Http\Controllers;

use Ivacuum\Generic\Services\Telegram;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function store(Telegram $telegram)
    {
        $files = request()->file('files');

        foreach ($files as $file) {
            $filename = now()->format('Ymd-His') . '-' . $file->getClientOriginalName();

            \Storage::disk('temp')->putFileAs('', $file, $filename);

            $telegram->notifyAdmin("Загружен файл\n" . url("uploads/temp/{$filename}"));
        }

        session()->flash('message', 'Спасибо за загруженные файлы');

        return redirect('/up');
    }
}
