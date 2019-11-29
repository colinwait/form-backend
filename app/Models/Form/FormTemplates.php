<?php

namespace App\Models\Form;

use App\Models\BaseModel;
use App\Models\Traits\AddCreatorTrait;

class FormTemplates extends BaseModel
{
    use AddCreatorTrait;

    protected $table = 'form_templates';

    protected $fillable = [
        'name',
        'introduction',
        'creator',
        'created_at',
        'updated_at',
    ];

    public function groups()
    {
        return $this->hasMany(FormTemplateComponents::class, 'template_id', 'id');
    }
}
