<?php


namespace App\Services\Form;


use Illuminate\Support\Arr;

class FormComponentValueService
{
    public function filterValue($data)
    {
        $data = Arr::except($data, ['_method', '_token']);
        $new_data = [];
        foreach ($data as $key => $value) {
            $id = ltrim($key, 'component_');
            $new_data[$id] = $value;
        }

        return $new_data;
    }
}
