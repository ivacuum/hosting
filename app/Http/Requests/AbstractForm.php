<?php namespace App\Http\Requests;

use App\User;
use Ivacuum\Generic\Http\FormRequest;

abstract class AbstractForm extends FormRequest
{
    public function isGuest(): bool
    {
        return $this->user() === null;
    }

    public function userModel(): ?User
    {
        return $this->user();
    }
}
