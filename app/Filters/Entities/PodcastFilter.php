<?php

namespace App\Filters\Entities;

use App\Filters\Filter;

class PodcastFilter extends Filter
{
    protected array $filterables = ['title', 'status', 'from_date', 'to_date'];
}
