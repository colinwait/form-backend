<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class Forms extends BaseModel
{
    protected $table = 'form_forms';

    public function template()
    {
        return $this->hasOne(FormTemplates::class, 'id', 'template_id');
    }
}
