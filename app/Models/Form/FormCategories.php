<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class FormCategories extends BaseModel
{
    protected $table = 'form_categories';

    protected $fillable = [
        'name',
        'parent_id',
        'parents',
        'children',
        'creator',
        'created_at',
        'updated_at'
    ];

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
