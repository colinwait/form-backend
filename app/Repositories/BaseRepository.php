<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function create($data)
    {
        return $this->model->create($data);
    }
}
