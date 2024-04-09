<?php

namespace App\Models;

class OrderItem
{
    protected int $id;
    protected string $name;
    protected int $qty;
    protected int $price;

    protected Course $model;

    public function __construct($id, $name, $qty, $price){
        $this->id = $id;
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->name;
    }

    public function qty(): int
    {
        return $this->qty;
    }

    public function subtotal(): float|int
    {
        return $this->qty * $this->price;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function model(): Course
    {
        if (! empty($this->model)) return $this->model;

        return Course::findOrFail($this->id);
    }
}
