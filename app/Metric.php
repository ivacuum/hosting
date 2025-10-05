<?php

namespace App;

use App\Policies\MetricPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Ivacuum\Generic\Models\Metric as BaseMetric;

#[UsePolicy(MetricPolicy::class)]
class Metric extends BaseMetric {}
