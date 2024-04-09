<?php

namespace App\Filters\Entities;

use App\Filters\Filter;

class OrderFilter extends Filter
{
    protected array $filterables = ['status', 'user', 'from_date', 'to_date'];

    protected function user($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->whereHas('user', function ($query) use ($value) {
            return $query->where('name', 'LIKE', "%{$value}%")
                        ->orWhere('phone', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
        });
    }
}
