<?php

namespace App\Models;

use App\Models\Component;
use Vector\Spider\Models\WebPage as ModelsWebPage;

class WebPage extends ModelsWebPage
{
    public function components()
    {
        return $this->hasMany(Component::class, 'slug_id');
    }
}
