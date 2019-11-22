<?php


namespace App\Models\Traits;


trait AddCreatorTrait
{
    public function setCreatorAttribute($value)
    {
        $this->attributes['creator'] = auth()->user()->id ?? 2;
    }
}
