<?php

namespace App\Filters\Entities;

use App\Filters\Filter;

class UserFilter extends Filter
{
    protected array $filterables = ['name', 'phone', 'email', 'from_date', 'to_date'];

    public function name($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('name', 'LIKE', "%{$value}%");
    }

    public function phone($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('phone', 'LIKE', "%{$value}%");
    }

    public function email($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('email', 'LIKE', "%{$value}%");
    }
}
