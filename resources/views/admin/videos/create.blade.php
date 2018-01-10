@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @component('admin.videos.tabs-component')
                <div class="col-md-12">
            <h3>Novo Vídeo</h3>
            @php $icon = Icon::create('floppy-disk') @endphp
            {!! form($form->add('salvar','submit',[
                           'attr' => ['class'=>'btn btn-primary btn-block'],
                           'label' => $icon,
                       ]))
            !!}
                </div>
            @endcomponent
        </div>
    </div>
@endsection