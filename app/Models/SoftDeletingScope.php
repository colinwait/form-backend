<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SoftDeletingScope extends \Illuminate\Database\Eloquent\SoftDeletingScope
{
    /**
     * rewrite apply method
     *
     * @time 2019年05月26日
     * @email wuyanwen@baijiayun.com
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getQualifiedDeletedAtColumn(), 0);
    }
}
