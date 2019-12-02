<?php

namespace App\Models\Form;

use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;

class FormValues extends BaseModel
{
    protected $table = 'form_values';

    public function updateValues($template_id, $form_id, $data)
    {
        $this->where(['template_id' => $template_id, 'form_id' => $form_id])->delete();

        $values = [];
        foreach ($data as $component_id => $datum) {
            $values[] = [
                'component_id' => $component_id,
                'template_id'  => $template_id,
                'form_id'      => $form_id,
                'value'        => $datum,
                'created_at'   => time(),
                'updated_at'   => time(),
                'creator'      => auth()->user()->id ?? 0,
            ];
        }

        $this->insert($values);
    }
}
