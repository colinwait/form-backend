<?php


namespace App\Http\Controllers\Form;


use App\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Form\FormCategories;

class CategoryController extends Controller
{
    public function store()
    {
        $params = $this->withAuth();
        $params['parents'] = $params['children'] = 0;
        FormCategories::create($params);

        return redirect()->back();
    }

    public function index()
    {
        $categories = FormCategories::with('categories.parent')
            ->where('parent_id', 0)->orderBy('id')->paginate(10);

        return view('form.form.category', ['categories' => $categories]);
    }

    public function update($id)
    {
        FormCategories::where('id', $id)->update(request()->only(['name', 'parent_id']));

        return redirect()->back();
    }

    public function destroy()
    {

    }
}
