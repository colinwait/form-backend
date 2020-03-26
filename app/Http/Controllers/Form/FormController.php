<?php


namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Form\FormCategories;
use App\Models\Form\Forms;
use App\Models\Form\FormTemplates;
use App\Repositories\Form\FormRepository;

class FormController extends Controller
{
    protected $form;

    public function __construct(FormRepository $form)
    {
        $this->form = $form;
    }

    public function index()
    {
        $forms = Forms::query()->with('category')->orderByDesc('created_at')->paginate(10);

        $categories = FormCategories::all();

        $templates = FormTemplates::all();

        return view('form.form.index', ['forms' => $forms, 'categories' => $categories, 'templates' => $templates]);
    }

    public function store()
    {
        $form = Forms::create($this->withAuth());

        return redirect('/form/forms/' . $form->id);
    }

    public function show($id)
    {
        $form = $this->form->find($id);

        return view('form.form.edit', ['form' => $form, 'edit' => true]);
    }

    public function update($id)
    {
        $this->form->update($id, request()->all());

        return redirect()->back()->with('form-message', 'success');
    }

    public function showDetail($id)
    {
        $form = $this->form->find($id);

        return view('form.form.edit', ['form' => $form, 'edit' => false]);
    }
}
