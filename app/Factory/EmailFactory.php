<?php

namespace App\Factory;

use App\Comment;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\Mail\TripPublishedMail;
use App\Domain\Life\Models\Trip;
use App\Domain\Locale;
use App\Email;

class EmailFactory
{
    private int|null $relationId = null;
    private string|null $template = null;
    private string|null $relationType = null;

    public function create()
    {
        $model = $this->make();
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
        $model->user_id = UserFactory::new()->create()->id;
        $model->rel_type = $this->relationType;
        $model->template = $this->template ?? '';

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withTripPublished(Trip|TripFactory|null $trip = null)
    {
        $factory = clone $this;
        $factory->template = class_basename(TripPublishedMail::class);
        $factory->relationType = (new Trip)->getMorphClass();

        $factory->relationId = match (true) {
            $trip instanceof Trip => $trip->id,
            $trip instanceof TripFactory => $trip->create()->id,
            default => TripFactory::new()->create()->id,
        };

        return $factory;
    }

    public function withCommentId(int $id)
    {
        $factory = clone $this;
        $factory->relationId = $id;
        $factory->relationType = (new Comment)->getMorphClass();

        return $factory;
    }

    public function withTemplate(string $template)
    {
        $factory = clone $this;
        $factory->template = class_basename($template);

        return $factory;
    }
}
