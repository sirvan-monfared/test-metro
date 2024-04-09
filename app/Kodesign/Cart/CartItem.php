<?php

namespace App\Kodesign\Cart;

use App\Models\Course;

class CartItem {
    public string $rowId;
    public int $id;
    public string $name;
    public int $qty;
    public int $price;
    public mixed $model;
    public array $options;

    public function __construct($id, $name, $price, $model, $qty = 1, array $options = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = intval($price);
        $this->model = $model;
        $this->options = $options;
        $this->qty = $qty;
        $this->rowId = $this->generateRowId($id, $options);
    }

    public function model()
    {
        if (! is_null($this->model)) {
            return $this->model;
        }

        $this->model = Course::find($this->id);
    }

    public function toArray(): array
    {
        return [
            'rowId'    => $this->rowId,
            'id'       => $this->id,
            'name'     => $this->name,
            'qty'      => $this->qty,
            'price'    => $this->price,
            'model'    => $this->model
        ];
    }

    protected function generateRowId($id, array $options): string
    {
        ksort($options);

        return md5($id.serialize($options));
    }
}
