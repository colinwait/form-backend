<?php


namespace App\Api\Controllers\Form;


use App\Api\ApiController;
use App\Models\Form\FormCategories;

class CategoryController extends ApiController
{
    public function store()
    {
        return $this->success();
    }

    public function index()
    {

    }

    public function destroy($id)
    {
        $res = FormCategories::destroy(explode(',', $id));

        return $this->success($res);
    }
}
