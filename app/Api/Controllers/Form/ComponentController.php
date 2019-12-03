<?php


namespace App\Api\Controllers\Form;


use App\Api\ApiController;
use App\Models\Form\FormTemplateComponents;

class ComponentController extends ApiController
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
        $res = FormTemplateComponents::destroy(explode(',', $id));

        return $this->success($res);
    }
}
