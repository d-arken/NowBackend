@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar série</h3>
            @php $icon = Icon::create('edit') @endphp
            {!! form($form->add('salvar','submit',[
                           'attr' => ['class'=>'btn btn-primary btn-block'],
                           'label' => $icon,
                       ]))
            !!}
        </div>
    </div>
@endsection