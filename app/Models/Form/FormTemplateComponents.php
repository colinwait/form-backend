<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class FormTemplateComponents extends BaseModel
{
    protected $table = 'form_template_components';

    protected $casts = [
        'options' => 'array',
    ];
}
