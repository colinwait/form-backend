<?php


namespace App\Api\Controllers\Form;


use App\Api\ApiController;
use App\Repositories\Form\TemplateRepository;

class TemplateController extends ApiController
{
    protected $template;

    public function __construct(TemplateRepository $template)
    {
        $this->template = $template;
    }

    public function index()
    {
        return $this->success();
    }

    public function store()
    {
        return $this->success($this->template->create(request()->all()));
    }

    public function update($id)
    {
        return $this->success($this->template->update($id, request()->all()));
    }

    public function destroy()
    {

    }

    public function show($id)
    {
        return $this->success($this->template->show($id));
    }
}
