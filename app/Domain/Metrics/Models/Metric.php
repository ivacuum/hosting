<?php

namespace App\Domain\Metrics\Models;

use App\Domain\Metrics\Policy\MetricPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(MetricPolicy::class)]
class Metric extends \Ivacuum\Generic\Models\Metric {}
