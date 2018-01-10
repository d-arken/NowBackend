<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {

        $id=$this->getData('id');

        $this
            ->add('name', 'text',[
                'label'=>'Nome',
                'rules'=>'required|max:255'
            ])
            ->add('email', 'email',[
                'label'=>'E-mail',
                'rules'=>"required|max:255|email|unique:users,email,$id"
            ])
            ->add('password', 'password',[
                'label'=>'Senha',
                'rules'=>"max:12",
                'placeholder'=>'Preencha para alterar'
            ]);
    }
}
