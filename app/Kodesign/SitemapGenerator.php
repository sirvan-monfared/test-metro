<?php

namespace App\Kodesign;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerator
{
    protected Sitemap $generator;

    public function __construct(){
        $this->generator = Sitemap::create();
    }

    public function addLink($link, $modification_date, $priority = 1, $image_path = null, $image_title = null): static
    {
        $link = Url::create($link)
            ->setLastModificationDate($modification_date)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority($priority);

        if ($image_path) {
            $link->addImage($image_path, $image_title);
        }

        $this->generator->add($link);

        return $this;
    }

    public function write()
    {
        $this->generator->writeToFile(public_path('sitemap.xml'));
    }
}
