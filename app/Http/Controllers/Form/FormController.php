<?php


namespace App\Http\Controllers\Form;

use App\Api\ApiController;
use App\Models\Form\Forms;

class FormController extends ApiController
{
    public function index()
    {
        $forms = Forms::query()->paginate(10);

        return view('form.form.index', ['forms' => $forms]);
    }

    public function show($id)
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

        return view('form.form.edit', ['form' => $form]);
    }
}
