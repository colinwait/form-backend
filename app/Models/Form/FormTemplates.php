<?php

namespace App\Models\Form;

use App\Models\BaseSoftDeleteModel;
use App\Models\Traits\AddCreatorTrait;

class FormTemplates extends BaseSoftDeleteModel
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
