<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $dateFormat = 'U';

    public function scopeWhereLike($query, $key, $search)
    {
        return $query->where($key, 'like', '%' . $search . '%');
    }
}
