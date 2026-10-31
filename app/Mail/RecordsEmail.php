<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait RecordsEmail
{
    public Email $email;

    public function email(MorphMany $email, User $user): Email
    {
        /** @var Email $model */
        $model = $email->make();
        $model->to = $user->email;
        $model->locale = $user->locale;
        $model->user_id = $user->id;
        $model->template = class_basename(static::class);
        $model->save();

        return $model;
    }
}
