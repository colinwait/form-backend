<?php


namespace App\Http\Controllers\Form;


use App\Api\ApiController;
use App\Models\Form\FormTemplateComponents;

class ComponentController extends ApiController
{
    protected $components;

    public function __construct(FormTemplateComponents $components)
    {
        $this->components = $components;
    }

    public function store()
    {
        $params = request()->all();
        $where = ['template_id' => $params['template_id'], 'parent_id' => $params['parent_id']];
        $max_order = FormTemplateComponents::where(['template_id' => $params['template_id'], 'parent_id' => $params['parent_id']])->max('order');
        $params['order'] = $max_order + 1;

        FormTemplateComponents::create($params);

        return redirect()->back();
    }

    public function index()
    {

    }

    public function destroy()
    {

    }

    public function update($id)
    {
        $this->components->updateSave($id, request()->all());

        return redirect()->back();
    }
}
