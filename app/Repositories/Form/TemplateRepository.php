<?php


namespace App\Repositories\Form;


use App\Models\Form\FormTemplates;
use App\Repositories\BaseRepository;

class TemplateRepository extends BaseRepository
{
    protected $model;

    public function __construct(FormTemplates $templates)
    {
        $this->model = $templates;
    }

    public function update($id, $data)
    {

    }

    public function show($id)
    {
        $template = $this->model->where('id', $id)->with('components')->first();

        return $template;
    }
}
