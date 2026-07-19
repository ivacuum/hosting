<?php

namespace App\Factory;

use App\Comment;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\Mail\TripPublishedMail;
use App\Domain\Life\Models\Trip;
use App\Domain\Locale;
use App\Email;
use App\User;

class EmailFactory
{
    private string|null $template = null;
    private string|null $relationType = null;

    private int|Comment|Trip|TripFactory|User|null $relation = null;
    private int|User|UserFactory|null $user = null;

    public function create(): Email
    {
        $email = $this->make();
        $email->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;

        if ($email->rel_type === new User()->getMorphClass() && $email->rel_id === null) {
            $email->rel_id = $email->user_id;
        }

        if ($this->relation instanceof TripFactory) {
            $trip = $this->relation->create();

            $email->rel_id = $trip->id;
            $email->rel_type = $trip->getMorphClass();
        }

        $email->save();

        return $email;
    }

    public function make(): Email
    {
        $email = new Email;
        $email->to = fake()->safeEmail();
        $email->clicks = 0;
        $email->locale = Locale::Rus->value;
        $email->rel_id = match (true) {
            $this->relation instanceof Comment,
            $this->relation instanceof Trip,
            $this->relation instanceof User => $this->relation->id,
            is_int($this->relation) => $this->relation,
            default => null,
        };
        $email->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
        $email->rel_type = $this->relationType;
        $email->template = $this->template ?? '';

        return $email;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withComment(int|Comment $comment): self
    {
        return clone ($this, [
            'relation' => $comment,
            'relationType' => new Comment()->getMorphClass(),
        ]);
    }

    #[\NoDiscard]
    public function withTemplate(string $template): self
    {
        return clone ($this, ['template' => class_basename($template)]);
    }

    #[\NoDiscard]
    public function withTripPublished(Trip|TripFactory|null $trip = null): self
    {
        return clone ($this, [
            'template' => class_basename(TripPublishedMail::class),
            'relation' => $trip ?? TripFactory::new(),
            'relationType' => new Trip()->getMorphClass(),
        ]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, [
            'relation' => $user instanceof User || is_int($user) ? $user : null,
            'relationType' => new User()->getMorphClass(),
            'user' => $user ?? UserFactory::new(),
        ]);
    }
}
