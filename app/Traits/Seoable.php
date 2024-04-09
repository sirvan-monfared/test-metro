<?php
namespace App\Traits;

trait Seoable {
    public function seoTitle()
    {
        return $this->seo['seo__title'] ?? $this->title;
    }

    public function seoDescription()
    {
        return $this->seo['seo__description'] ?? $this->description;
    }

    public function seoKeywords()
    {
        return $this->seo['seo__keywords'] ?? $this->keywords;
    }

    public function seoSchema()
    {
        return $this->seo['seo__schema'] ?? $this->schema;
    }

    public function getSeoTitleProperty()
    {
        return data_get($this->seo, 'seo__title');
    }

    public function getSeoDescriptionProperty()
    {
        return data_get($this->seo, 'seo__description');
    }

    public function getSeoKeywordsProperty()
    {
        return data_get($this->seo, 'seo__keywords');
    }

    public function getSeoSchemaProperty()
    {
        return data_get($this->seo, 'seo__schema');
    }
}
