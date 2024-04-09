<?php

namespace App\Kodesign;

use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\Schema;

class BreadCrumbs
{
    protected BreadcrumbList $generator;

    protected array $list;

    public function __construct()
    {
        $this->addHome();
    }

    public function items(): array
    {
        return $this->list;
    }

    public function add($position, $title, $link = null): static
    {
        $this->list[] = [
            'position' => $position,
            'name' => $title,
            'item' => $link
        ];

        return $this;
    }

    public function withDashboard(): static
    {
        $this->addDashboard();

        return $this;
    }

    protected function addHome(): static
    {
        return $this->add(1, 'خانه', url('/'));
    }

    protected function addDashboard(): static
    {
        return $this->add(2, 'داشبورد', route('dashboard'));
    }
}
