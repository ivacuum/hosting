<?php

namespace App\Http\Controllers;

use App\Domain\SessionKey;
use App\Domain\Telegram\Action\NotifyAdminViaTelegramAction;

class UploadController
{
    public function __invoke(NotifyAdminViaTelegramAction $notifyAdminViaTelegram)
    {
        $files = request()->file('files');

        foreach ($files as $file) {
            $filename = now()->format('Ymd-His') . '-' . $file->getClientOriginalName();

            \Storage::disk('temp')->putFileAs('', $file, $filename);

            $notifyAdminViaTelegram->execute("Загружен файл\n" . url("uploads/temp/{$filename}"));
        }

        session()->flash(SessionKey::FlashMessage, 'Спасибо за загруженные файлы');

        return redirect('/up');
    }
}
