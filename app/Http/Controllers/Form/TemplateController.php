<?php


namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Form\FormTemplates;
use App\Repositories\Form\TemplateRepository;

class TemplateController extends Controller
{
    protected $template;

    public function __construct(TemplateRepository $template)
    {
        $this->template = $template;
    }

    public function index()
    {
        $templates = FormTemplates::query()->orderByDesc('created_at')->paginate(10);

        return view('form.template.index', ['templates' => $templates]);
    }

    public function store()
    {
        $template = FormTemplates::create($this->withAuth());

        return redirect('/form/templates/' . $template->id);
    }

    public function update($id)
    {
        return $this->success($this->template->update($id, request()->all()));
    }

    public function destroy($id)
    {

    }

    public function show($id)
    {
        $template = FormTemplates::with(['groups' => function ($query) use ($id) {
            $query->where('parent_id', 0);
            $query->with('components')->orderBy('order', 'asc');
        }])->where('id', $id)->first();

        return view('form.template.edit', ['template' => $template]);
    }
}
