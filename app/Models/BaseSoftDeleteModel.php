<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseSoftDeleteModel extends BaseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeletingScope);
    }
}
