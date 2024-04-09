<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use function request;

class Filter
{
    protected Builder $builder;

    public function apply($query)
    {
        $this->builder = $query;

        foreach ($this->filterables as $filterable) {
            $method_name = Str::camel($filterable);

            $this->$method_name(request($filterable));
        }

        return $this->builder;
    }

    protected function title($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('title', 'LIKE', "%{$value}%");
    }

    protected function status($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('status', $value);
    }

    protected function fromDate($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('created_at', '>=', startOfJalaliDay(date: $value));
    }

    protected function toDate($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('created_at', '<=', endOfJalaliDay(date: $value));
    }
}
