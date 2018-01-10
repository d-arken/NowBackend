@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="  display: inline-block;">Categorias </h3>
        {!! Button::primary('Novo')->asLinkTo(route('categories.create')) !!}
        <div class="row">
            {!! Table::withContents($categories->items())
            ->striped()
            ->callback('Ações',function($field,$categories){
                $linkEdit = route('categories.edit',['categories'=>$categories->id]);
                $linkShow = route('categories.show',['categories'=>$categories->id]);
                return  Button::link(Icon::create('edit'))
                ->asLinkTo($linkEdit).''

                .Button::link(Icon::create('remove'))
                ->asLinkTo($linkShow);
            })!!}
        </div>
        {!! $categories->links() !!}
    </div>
@endsection