<?php

namespace App\Models\Form;

use App\Models\BaseModel;
use App\Models\BaseSoftDeleteModel;

class Forms extends BaseSoftDeleteModel
{
    protected $table = 'form_forms';

    protected $fillable = [
        'name',
        'template_id',
        'category_id',
        'introduction',
        'creator',
        'created_at',
        'updated_at'
    ];

    public function template()
    {
        return $this->hasOne(FormTemplates::class, 'id', 'template_id');
    }

    public function category()
    {
        return $this->belongsTo(FormCategories::class, 'category_id', 'id');
    }
}
