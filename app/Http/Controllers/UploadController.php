<?php namespace App\Http\Controllers;

use Ivacuum\Generic\Services\Telegram;

class UploadController
{
    public function __invoke(Telegram $telegram)
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
