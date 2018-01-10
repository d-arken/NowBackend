<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoUploadForm extends Form
{
    public function buildForm()
    {
        $this->add('thumb','file', [
            'requied'=>false,
            'label'=>'Thumbnail',
            'rules'=>'image|max:2048'
        ])
            ->add('file','file',[
                'requied'=>false,
                'label'=>'Arquivo de vídeo',
                'rules'=>'mimetypes:video/mp4'
            ])->add('duration','text',[
                'label'=>'Duração (minutos)',
                'rules'=>'required|integer|min:1'
            ]);
    }
}
