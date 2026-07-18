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
    private int|null $userId = null;
    private int|null $relationId = null;
    private string|null $template = null;
    private string|null $relationType = null;

    private TripFactory|null $tripFactory = null;
    private UserFactory|null $userFactory = null;

    public function create(): Email
    {
        $email = $this->make();
        $email->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($email->rel_type === new User()->getMorphClass() && $email->rel_id === null) {
            $email->rel_id = $email->user_id;
        }

        if ($this->tripFactory) {
            $trip = $this->tripFactory->create();

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
        $email->rel_id = $this->relationId;
        $email->user_id = $this->userId;
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
            'relationId' => $comment instanceof Comment ? $comment->id : $comment,
            'relationType' => new Comment()->getMorphClass(),
            'tripFactory' => null,
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
        return match (true) {
            $trip instanceof Trip => clone ($this, [
                'template' => class_basename(TripPublishedMail::class),
                'relationId' => $trip->id,
                'relationType' => $trip->getMorphClass(),
                'tripFactory' => null,
            ]),
            default => clone ($this, [
                'template' => class_basename(TripPublishedMail::class),
                'relationId' => null,
                'relationType' => new Trip()->getMorphClass(),
                'tripFactory' => $trip ?? TripFactory::new(),
            ]),
        };
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return match (true) {
            $user instanceof User => clone ($this, [
                'relationId' => $user->id,
                'relationType' => $user->getMorphClass(),
                'tripFactory' => null,
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'relationId' => $user,
                'relationType' => new User()->getMorphClass(),
                'tripFactory' => null,
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'relationId' => null,
                'relationType' => new User()->getMorphClass(),
                'tripFactory' => null,
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
