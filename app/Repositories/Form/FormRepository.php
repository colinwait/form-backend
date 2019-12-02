<?php


namespace App\Repositories\Form;


use App\Models\Form\Forms;
use App\Models\Form\FormTemplates;
use App\Models\Form\FormValues;
use App\Repositories\BaseRepository;
use App\Services\Form\FormComponentValueService;

class FormRepository extends BaseRepository
{
    protected $forms;
    protected $valueService;
    protected $values;

    public function __construct(Forms $forms, FormValues $values, FormComponentValueService $valueService)
    {
        $this->forms = $forms;
        $this->valueService = $valueService;
        $this->values = $values;
    }

    public function find($id)
    {
        $form = Forms::with(['template' => function ($query) use ($id) {
            $query->with(['groups' => function ($query) use ($id) {
                $query->where('parent_id', 0);
                $query->with(['components' => function ($query) use ($id) {
                    $query->with(['value' => function ($query) use ($id) {
                        $query->where('form_id', $id);
                    }])->orderBy('order', 'asc');
                }])->orderBy('order', 'asc');
            }]);
        }])->where('id', $id)->first();

        return $form;
    }

    public function update($id, $data)
    {
        $form = $this->forms->find($id);

        $this->values->updateValues($form->template_id, $id, $this->valueService->filterValue($data));
    }
}
