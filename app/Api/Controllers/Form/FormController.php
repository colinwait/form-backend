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

    public function detail()
    {

    }

    public function destroy($id)
    {
        $res = Forms::destroy(explode(',', $id));

        return $this->success($res);
    }

    public function update($id)
    {
        logger(request()->all());
    }
}
