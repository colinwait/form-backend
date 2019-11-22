<?php


namespace App\Api\Controllers\Form;


use App\Api\ApiController;
use App\Models\Form\Forms;

class FormController extends ApiController
{
    public function index()
    {
        $forms = Forms::query()->paginate(10);
        return $this->success($forms);
    }
}
