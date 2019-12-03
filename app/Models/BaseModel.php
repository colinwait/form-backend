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

    public function updateSave($id, $params)
    {
        $model = $this->query()->find($id);

        foreach ($params as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                continue;
            }
            $model->$key = $value;
        }

        $model->save();
    }
}
