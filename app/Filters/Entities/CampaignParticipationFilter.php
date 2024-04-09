<?php

namespace App\Filters\Entities;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CampaignParticipationFilter extends Filter
{
    protected array $filterables = ['campaign', 'user', 'from_date', 'to_date'];


    public function campaign($value): Builder|false
    {
        if (! $value) return false;

        return $this->builder->where('campaign_id', $value);
    }

    protected function user($value)
    {
        if (!$value) return false;

        $this->builder->whereHas('user', function ($query) use ($value) {
            return $query->where('name', 'LIKE', "%{$value}%")
                        ->orWhere('phone', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
        });
    }
}
