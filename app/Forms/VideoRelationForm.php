<?php

namespace App\Forms;

use App\Models\Category;
use App\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {

        $this->add('categories','entity',[
            'label'=>'Categorias pertencentes',
            'class'=> Category::class,
            'property'=>'name',
            'selected'=> $this->model ? $this->model->categories->pluck('id') : null,
            'multiple'=>'true',
            'attr'=>[
                'name'=>'categories[]'
            ],
            'rules'=>'required|exists:categories,id'
        ])->add('serie_id','entity',[
            'label'=> 'Série',
            'class'=> Serie::class,
            'property'=>'title',
            'empty_value'=>'Selecione a série',
            'rules'=>'nullable|exists:series,id'
        ]);


    }
}
