<?php

namespace App\Models\Form;

use App\Models\BaseSoftDeleteModel;

class FormTemplateComponents extends BaseSoftDeleteModel
{
    protected $table = 'form_template_components';

    protected $fillable = [
        'name',
        'key',
        'template_id',
        'parent_id',
        'type',
        'order',
        'is_require',
        'placeholder',
        'options',
        'remark',
        'creator'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function value()
    {
        return $this->hasOne(FormValues::class, 'component_id', 'id');
    }

    public function components()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function getOptionsAttribute($value)
    {
        return $value ? json_decode($value, 1) : [];
    }

    public function setRemarkAttribute($value)
    {
        $this->attributes['remark'] = $value ?: '';
    }
}
