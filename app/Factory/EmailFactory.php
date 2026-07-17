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

    public function create()
    {
        $model = $this->make();
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($model->rel_type === new User()->getMorphClass() && $model->rel_id === null) {
            $model->rel_id = $model->user_id;
        }

        if ($this->tripFactory) {
            $trip = $this->tripFactory->create();

            $model->rel_id = $trip->id;
            $model->rel_type = $trip->getMorphClass();
        }

        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Email;
        $model->to = fake()->safeEmail();
        $model->clicks = 0;
        $model->locale = Locale::Rus->value;
        $model->rel_id = $this->relationId;
        $model->user_id = $this->userId;
        $model->rel_type = $this->relationType;
        $model->template = $this->template ?? '';

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withComment(int|Comment $comment)
    {
        $factory = clone $this;

        if ($comment instanceof Comment) {
            $factory->relationId = $comment->id;
        } else {
            $factory->relationId = $comment;
        }

        $factory->relationType = new Comment()->getMorphClass();

        return $factory;
    }

    public function withTemplate(string $template)
    {
        return clone ($this, ['template' => class_basename($template)]);
    }

    public function withTripPublished(Trip|TripFactory|null $trip = null)
    {
        $factory = clone $this;
        $factory->template = class_basename(TripPublishedMail::class);
        $factory->relationType = new Trip()->getMorphClass();

        if ($trip instanceof Trip) {
            $factory->relationId = $trip->id;
        } else {
            $factory->tripFactory = $trip ?? TripFactory::new();
        }

        return $factory;
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        $factory->relationId = $factory->userId;
        $factory->relationType = new User()->getMorphClass();

        return $factory;
    }
}
