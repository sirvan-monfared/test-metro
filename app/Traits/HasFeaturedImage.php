<?php

namespace App\Traits;

trait HasFeaturedImage
{
    public function featuredImage(): string
    {
        return ($this->featured_image) ? $this->coverPath() : $this->defaultCoverPath();
    }

    public function coverPath(): string
    {
        return asset($this->images_root.$this->featured_image);
    }

    public function defaultCoverPath(): string
    {
        return $this->default_image ? asset($this->default_image) : asset('admin/media/svg/files/blank-image.svg');
    }

    public function hasFeaturedImage(): bool
    {
        return !! $this->featured_image;
    }
}
