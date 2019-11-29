<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class FormTemplateComponents extends BaseModel
{
    protected $table = 'form_template_components';

    protected $casts = [
        'options' => 'array',
    ];

    public function value()
    {
        return $this->hasOne(FormValues::class, 'id', 'component_id');
    }

    public function components()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function getOptionsAttribute($value)
    {
        return $value ? json_decode($value, 1) : [];
    }
}
