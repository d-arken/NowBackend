<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $rulesThumbFile = 'image|max:2048';
        $rulesThumbFile = $id ? $rulesThumbFile : "required|$rulesThumbFile";

        $this
            ->add('title', 'text',[
                'label'=>'Título',
                'rules'=>'required|min:3|max:255'
            ])
            ->add('description', 'textarea',[
                'label'=>'Descrição',
                'rules'=>'required|min:3|max:255'
            ])->add('thumb_file', 'file',[
                'required'=> $id ? false : true,
                'label'=>'Thumbnail',
                'rules'=> $rulesThumbFile,
            ]);


    }
}
