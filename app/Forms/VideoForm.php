<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text',[
                'label'=>'Título',
                'rules'=>'required|min:3|max:255'
            ])
            ->add('description', 'textarea',[
                'label'=>'Descrição',
                'rules'=>'required'
            ]);
    }

}
