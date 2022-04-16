<?php namespace App\Factory;

use App\Domain\IssueStatus;
use App\Issue;
use Illuminate\Foundation\Testing\WithFaker;

class IssueFactory
{
    use WithFaker;

    private const PAGES = [
        '/',
        '/about',
        '/life/kaluga',
        '/en/japanese',
    ];

    private $userId;
    private IssueStatus $status = IssueStatus::Open;

    private ?UserFactory $userFactory = null;
    private ?CommentFactory $commentFactory = null;

    public function closed()
    {
        return $this->withStatus(IssueStatus::Closed);
    }

    public function create()
    {
        $model = $this->make();
        $model->save();

        $this->commentFactory
            ?->withIssueId($model->id)
            ->withUserId($model->user_id)
            ->create();

        return $model;
    }

    public function make()
    {
        $model = new Issue;
        $model->name = $this->faker->name;
        $model->page = $this->faker->randomElement(self::PAGES);
        $model->text = $this->faker->sentence(20);
        $model->email = $this->faker->safeEmail;
        $model->title = $this->faker->optional(0.6, 'Default title')->words(4, true);
        $model->status = $this->status;
        $model->user_id = $this->userId;

        if ($this->userFactory && !$model->user_id) {
            $model->user_id = $this->userFactory->withEmail($model->email)->create()->id;
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withComment(CommentFactory $commentFactory = null)
    {
        $factory = clone $this;
        $factory->commentFactory = $commentFactory ?? CommentFactory::new();

        return $factory;
    }

    public function withStatus(IssueStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }

    public function withUser(UserFactory $userFactory = null)
    {
        $factory = clone $this;
        $factory->userFactory = $userFactory ?? UserFactory::new();

        return $factory;
    }
}
