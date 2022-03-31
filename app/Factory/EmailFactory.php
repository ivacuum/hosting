<?php namespace App\Factory;

use App\Comment;
use App\Domain\Locale;
use App\Email;
use Illuminate\Foundation\Testing\WithFaker;

class EmailFactory
{
    use WithFaker;

    private $template;
    private $relationId;
    private $relationType;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Email;
        $model->to = $this->faker->safeEmail;
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
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
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
